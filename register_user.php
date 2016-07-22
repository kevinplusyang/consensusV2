<!DOCTYPE html>


<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Evaluation</title>

</head>

<body>

<?php
require_once "dbaccess.php";


echo $_POST['username'];
echo $_POST['email'];
echo $_POST['password'];
echo $_POST['participate'];


mysql_query("insert into user values ('','".$_POST['username']."','".$_POST['email']."','".md5($_POST['password'])."') ");


$result = mysql_query("select * from user where email = '".$_POST['email']."' ");
$row = mysql_fetch_array($result);
$user_id = $row['id'];



$decision_id = $_POST['participate'];

$sql_count = "select count(*) from participate where decision_id = '".$decision_id."' ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_num = $row_count[0]+1;

mysql_query("insert into participate values('','".$decision_id."','".$user_num."','".$user_id."')");
mysql_query("update decision set user_num = user_num + 1 where id = '".$decision_id."'");



mysql_query("insert into score values('','".$decision_id."','".$user_num."','1','1','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','2','1','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','3','1','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','1','2','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','2','2','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','3','2','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','1','3','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','2','3','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','3','3','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','1','4','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','2','4','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','3','4','-1')");

mysql_query("insert into score values('','".$decision_id."','".$user_num."','0','1','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','0','2','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','0','3','-1')");
mysql_query("insert into score values('','".$decision_id."','".$user_num."','0','4','-1')");


?>


<!-- jQuery -->
<meta http-equiv=refresh content="0.00005; url=control_panel.php">

</body>

</html>
