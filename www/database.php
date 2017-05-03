<?php

function connectToDB() {
  $db_connection = mysql_connect("localhost", "cs143", "");

  if(!$db_connection) {
    $errmsg = mysql_error($db_connection);
    echo "Connection failed:".$errmsg."<br />";
    exit(1);
  }

  mysql_select_db("CS143", $db_connection);

  return $db_connection;
}

function checkNull(&$testArr, $nullStr){
  foreach($testArr as &$elem){
    if(is_null($elem)){
      $elem=$nullStr;
    }
  }
  unset($elem);
  return $testArr;
}
?>
