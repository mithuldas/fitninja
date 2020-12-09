<?php

require_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/autoloader.php' ;
require ROOT_DIR . '/vendor/autoload.php';

use \Firebase\JWT\JWT;

class Session {

  public $id;
  public $nextSessionId;
  public $sequence;
  public $uid; // uid of the trainee who purchased the product (user_products.uid)

  public $scheduledDateTime;
  public $scheduledDateTimeLocal;
  public $plannedTrainers;
  public $plannedTrainees;
  public $filledTrainers;
  public $filledTrainees;
  public $dateCreated;
  public $notes;
  public $assignments=[];
  public $startURL;
  public $joinURL;
  public $status;
  public $nextSessionScheduled;
  public $activity;
  public $completed; // completion flag (either null for not complete or Y for completed)

  function __construct($id, $conn) { // construct a session object (i.e a row in the session table, given an id )
    $this->id = $id;
    $this->initSessionData($conn);
    $this->setAttributes($conn);
    $this->setNextSessionId($conn);
    $this->setNextSessionScheduledStatus($conn);
    $this->setScheduledDateTimeLocal($this->scheduledDateTime);
  }

  function initSessionData($conn){
    $sql = "select * from sessions s, user_products up, products p,
    users u where s.user_product_id=up.id and up.product_id=p.id and up.uid=u.uid and s.id='".$this->id."';";

    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
        $this->productName=$row['name'];
        $this->uid=$row['uid'];
        $this->sequence=$row['sequence'];
        $this->scheduledDateTime=$row['sch_dt_tm'];
        $this->plannedTrainers=$row['planned_trainers'];
        $this->plannedTrainees=$row['planned_trainees'];
        $this->filledTrainers=$row['filled_trainers'];
        $this->filledTrainees=$row['filled_trainees'];
        $this->notes=$row['notes'];
        $this->dateCreated=$row['creation_dt'];
        $this->completed=$row['completed'];
        // activity name
        $this->activity = Activity::getName($row['activity_type_id'], $conn);
      }
    }

    $this->setAssignments($conn);
  }

  function setAttributes($conn){
    $sql="select s.id, sad.attribute_name, sa.attribute_value, sa.valid_from, sa.valid_to from sessions s, session_attributes sa, session_attribute_definitions sad where s.id=sa.session_id and sa.attribute_id=sad.attribute_id and sysdate() BETWEEN sa.valid_from and IFNULL(sa.valid_to,  DATE_ADD(sysdate(), INTERVAL 1 YEAR)) and s.id=".$this->id."";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all user attributes

        switch ($row['attribute_name']) {
          case "Zoom Join URL":
            $this->joinURL = $row['attribute_value'];
            break;
          case "Zoom Start URL":
            $this->startURL = $row['attribute_value'];
            break;
      }
    }
    }
  }

  function setScheduledDateTime($scheduledDateTime, $conn){
    $this->scheduledDateTime=$scheduledDateTime;
    $sql = "update sessions set sch_dt_tm='".$this->scheduledDateTime. "' where id=". $this->id.";";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      return 0;
      exit();
    }
    else {
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_affected_rows($stmt)<1){
        return 0;
        exit();
      } else {
        return 1;
      }
    }
  }

  function setAssignments($conn){
    // get active assignment list
    $sql = "select ua.id from sessions s, user_assignments ua where s.id=ua.session_id and ua.delete_ind='N' and s.id='".$this->id."'";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($row = $result->fetch_assoc()) {
      $assignment = new Assignment($row['id'], $conn);
      array_push($this->assignments, $assignment);
    }
  }

  function getTrainerUID($conn){
    foreach ($this->assignments as $assignment) {
      if($assignment->type=="trainer"){
        return $assignment->uid;
      }
    }
  }

  function addAttribute($attributeName, $attributeValue, $conn){
    $sql="insert into session_attributes (session_id, attribute_id, attribute_value, valid_from) values (".$this->id.", (select sad.attribute_id from session_attribute_definitions sad where sad.attribute_name='".$attributeName."'), '".$attributeValue."', (select date(sysdate()) from dual));";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);
    if(mysqli_stmt_affected_rows($stmt)<1){
      return 0;
    } else {
      return 1;
    }
  }

  function createZoomMeeting($conn){

    $converToDateTime = strtotime($this->scheduledDateTime);
    $date= date('Y-m-d',$converToDateTime);
    $time= date('H:i',$converToDateTime);
    $dateTimeForZoom= $date . 'T' . $time.':00Z';

    $topic = $this->productName." session # ".$this->sequence;
    $trainer = new User($this->getTrainerUID($conn), $conn);

    if(is_null($trainer->zoomID)){ // if trainer's zoom username isn't set, fail to create the zoom meeting
      return 0;
    }

    $agenda = "Trainer: ". $trainer->firstName;

    //create JWT token to be used with Zoom API call

    $key = "mhWHl73oj9n5nU5gdEzTmty2nnNKECsfUdFC";
    $payload = array(
        "iss" => "vMs6BwCXTciKkv5hoiWWag",
        "exp" => time()+36000, // expire in 10 hours
    );

    $jwt = JWT::encode($payload, $key, 'HS256');
    //$decoded = JWT::decode($jwt, $key, array('HS256'));

    $curl = curl_init();

    // call Zoom API using curl and read the response
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.zoom.us/v2/users/".$trainer->zoomID."/meetings", //This is the Zoom API endpoint you'd hit to get a list of active users.
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"topic\":\"".$topic."  \",\"type\":\"2\",\"start_time\":\"".$dateTimeForZoom."\",\"duration\":\"60\",\"timezone\":\"UTC\",\"agenda\":\"".$agenda."\",\"settings\":{\"host_video\":\"true\",\"participant_video\":\"true\",\"join_before_host\":\"false\",\"mute_upon_entry\":\"false\",\"approval_type\":\"2\",\"audio\":\"both\",\"auto_recording\":\"none\",\"waiting_room\":\"false\"}}",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer {$jwt}", // You provide your JWT token in the Authorization header.
        "content-type: application/json"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $zoomMeeting = json_decode($response);

    if(is_null($zoomMeeting->start_url) or is_null($zoomMeeting->join_url)){
      return 0;
    }

    if ($err) {
      return 0;
    } else {

      //insert into DB and update session properties

      $addStartURL= $this->addAttribute('Zoom Start URL', $zoomMeeting->start_url, $conn);
      $addJoinURL= $this->addAttribute('Zoom Join URL', $zoomMeeting->join_url, $conn);

      if($addStartURL=='1' and $addJoinURL=='1'){
        return 1;
      } else {
        return 0;
      }
    }

  }


  function setNextSessionId($conn){
    $nextSequenceNr = $this->sequence+1;
    $sql="select id from sessions where user_product_id in (select user_product_id from sessions where id='".$this->id."') and sequence='".$nextSequenceNr."'";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
        $this->nextSessionId=$row['id'];
      }
    }
  }

  function setNextSessionScheduledStatus($conn){
    $this->nextSessionScheduled=false;
    $sql = "select * from sessions where id='".$this->nextSessionId."' and sch_dt_tm is not null;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
        $this->nextSessionScheduled=true;
      }
    }
  }

  function setActivity($activity, $conn){
    $sql = "update sessions set activity_type_id=(select id from activity_types where name='".$activity."') where id='".$this->id."';";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      return 0;
      exit();
    }
    else {
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_affected_rows($stmt)<1){
        return 0;
        exit();
      } else {
        return 1;
      }
    }

  }

  function initTrainerDetails($conn){
    $sql = "select u.uid from sessions s, user_assignments ua, users u
    where s.id=ua.session_id and ua.uid=u.uid and u.user_type_id=1 and s.id = $this->id;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
        $this->trainerUid=$row['uid'];
        $trainer = new Trainer($this->trainerUid, $conn);
        $this->trainerFirstName = $trainer->firstName;
        $this->trainerLastName = $trainer->lastName;
      }
    }
  }

  function initTraineeDetails($conn){
    $sql = "select u.uid from sessions s, user_assignments ua, users u
    where s.id=ua.session_id and ua.uid=u.uid and u.user_type_id=2 and s.id = $this->id;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
      return "sqlerror";
    } else {
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      while($row = $result->fetch_assoc()) { // loop through the array and set all session properties
        $this->trainerUid=$row['uid'];
        $trainee = new Trainee($this->trainerUid, $conn);
        $this->traineeFirstName = $trainee->firstName;
        $this->traineeLastName = $trainee->lastName;
      }
    }
  }

  function setScheduledDateTimeLocal($scheduledDateTime){ // conversion of UTC time stored in AWS db to IST local time
    if(isset($_SERVER['HTTP_HOST']) and $_SERVER['HTTP_HOST']=="localhost"){
      $tzOffset = 0;
      $adjustedDateTime= (date('Y-m-d G:i',strtotime($scheduledDateTime. ' -'.$tzOffset.' minute')));
    } else {
      $tzOffset = 330; // 5h30 mins offset forward for AWS server that's on UTC TZ
      $adjustedDateTime= (date('Y-m-d G:i',strtotime($scheduledDateTime. ' +'.$tzOffset.' minute')));
    }
    $this->scheduledDateTimeLocal=$adjustedDateTime;
  }
}
?>
