<?php

session_start();
require_once "dbaccess.php";


$result = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user_id']."' ");

while($row = mysql_fetch_row($result)){
    $all[]=($row);
}



echo json_encode($all);
?>