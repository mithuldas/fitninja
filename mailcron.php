<?php
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );


$mail = imap_open('{mail.privateemail.com:993/ssl}INBOX', 'hello@funinja.in', 'Aeh2kpst1!');
$svgs = imap_sort($mail, SORTARRIVAL, 0, null,'SUBJECT "CitiAlert - Balance in your account"');
$ccEmails = imap_sort($mail, SORTARRIVAL, 1, null,'SUBJECT "Transaction confirmation on your Citibank credit card"');

$latestSvgsEmailUID = max($svgs);
$latestCCEmailUID = max($ccEmails);

$svgsEmailBody = imap_body ($mail , $latestSvgsEmailUID);
$svgsEmailPieces = explode(" ", $svgsEmailBody);
foreach( $svgsEmailPieces as $key => $value ){
  if($svgsEmailPieces[$key] == 'withdraw' )
  {
    $svgBal = (int)$svgsEmailPieces[$key+3];
    break;
  }
}

$ccEmailBody = imap_body ($mail , $latestCCEmailUID);
$ccEmailPieces = explode(" ", $ccEmailBody);
foreach( $ccEmailPieces as $key => $value ){
  if($ccEmailPieces[$key] == 'Limit' )
  {
    $ccBal = (int) str_replace(',','', $ccEmailPieces[$key+2]);
    break;
  }
}

imap_close($mail);

// now we have $ccBal and $svgBal extracted from the latest emails - now write these as json into test.php
// to be picked up in a google sheet

$date = date('Y/m/d H:i:s');
$finJSON = '{"mithul": {"svgBal":'.$svgBal.', "ccBal":'.$ccBal.', "lastUpt":"'.$date.'"}}';
$myfile = fopen("/var/www/html/mail.php", "w") or die("Unable to open file!");
fwrite($myfile, $finJSON);
fclose($myfile);

?>
