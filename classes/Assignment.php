<?php

require_once __DIR__.'/../config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );

class Assignment {
  public $id;
  public $sessionID;
  public $uid;
  public $type; // trainer, trainee etc, determines the fill to update in sessions table

  public function insertToDB($conn){
    // insert row into user_assignment table
    // increment fill value appropriately in session


    $sql = "INSERT INTO user_assignments (session_id, uid, delete_ind) VALUES (" . $this->sessionID . ", " . $this->uid . ", 'N');";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      return 0;
      exit();
    }
    else{
      mysqli_stmt_execute($stmt);
      if(mysqli_stmt_affected_rows($stmt)<1){
        return 0;
        exit();
      }

      // increment fill value
      $fillColumnName;
      if($this->type=="trainer"){
        $fillColumnName='filled_trainers';
      } else if ($this->type=="trainee"){
        $fillColumnName='filled_trainees';
      }

      if($this->type=="trainer"){
        $sql = "update sessions set ". $fillColumnName . "=(select count(*) from sessions s, user_assignments ua, users u where s.id=ua.session_id and ua.uid=u.uid and ua.delete_ind='N' and user_type_id=1) where id=". $this->sessionID.";";
      } else if ($this->type=="trainee"){
        $sql = "update sessions set ". $fillColumnName . "=(select count(*) from sessions s, user_assignments ua, users u where s.id=ua.session_id and ua.uid=u.uid and ua.delete_ind='N' and user_type_id=2) where id=". $this->sessionID.";";
      }

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
  }
}
