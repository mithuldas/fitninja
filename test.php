<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';
require_once ( ROOT_DIR.'/includes/autoloader.php' );
require_once ( ROOT_DIR.'/includes/dbh.php' );

$session = new TrialSession(1, $conn);

echo("<pre>".json_encode($session, JSON_PRETTY_PRINT))."</pre>";


?>
