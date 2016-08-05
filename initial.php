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

$user_name = "Edwin";
$user_email = "edwin@ucsd.edu";
$password = "1234";
$participant_num = 5;




$user_name2 = "Brian";
$user_email2 = "Brian@ucsd.edu";

$user_name3 = "Tom";
$user_email3 = "Tom@ucsd.edu";

$user_name4 = "Rose";
$user_email4 = "Rose@ucsd.edu";

$user_name5 = "Cindy";
$user_email5 = "Cindy@ucsd.edu";

$user_name6 = "Jake";
$user_email6 = "Jake@ucsd.edu";






mysql_query("insert into reason values('','1','No Data') ");
mysql_query("insert into reason values('','1','No Data') ");





mysql_query("insert into user values ('','".$user_name."','".$user_email."','".md5($password)."') ");

$result = mysql_query("select * from user where email = '".$user_email."' ");
$row = mysql_fetch_array($result);
$user_id = $row['id'];



mysql_query("insert into decision values ('', 'Test1', 'No', '1', '4','3','1','0')");
mysql_query("insert into participate values('','1','1','1')");




mysql_query("insert into score values('','1','1','1','1','-1','A')");
mysql_query("insert into score values('','1','1','2','1','-1','A')");
mysql_query("insert into score values('','1','1','3','1','-1','A')");
mysql_query("insert into score values('','1','1','4','1','-1','A')");
mysql_query("insert into score values('','1','1','1','2','-1','A')");
mysql_query("insert into score values('','1','1','2','2','-1','A')");
mysql_query("insert into score values('','1','1','3','2','-1','A')");
mysql_query("insert into score values('','1','1','4','2','-1','A')");
mysql_query("insert into score values('','1','1','1','3','-1','A')");
mysql_query("insert into score values('','1','1','2','3','-1','A')");
mysql_query("insert into score values('','1','1','3','3','-1','A')");
mysql_query("insert into score values('','1','1','4','3','-1','A')");


mysql_query("insert into score values('','1','1','0','1','-1','A')");
mysql_query("insert into score values('','1','1','0','2','-1','A')");
mysql_query("insert into score values('','1','1','0','3','-1','A')");


mysql_query("insert into score_backup values('','1','1','1','1','-1')");
mysql_query("insert into score_backup values('','1','1','2','1','-1')");
mysql_query("insert into score_backup values('','1','1','3','1','-1')");
mysql_query("insert into score_backup values('','1','1','4','1','-1')");
mysql_query("insert into score_backup values('','1','1','1','2','-1')");
mysql_query("insert into score_backup values('','1','1','2','2','-1')");
mysql_query("insert into score_backup values('','1','1','3','2','-1')");
mysql_query("insert into score_backup values('','1','1','4','2','-1')");
mysql_query("insert into score_backup values('','1','1','1','3','-1')");
mysql_query("insert into score_backup values('','1','1','2','3','-1')");
mysql_query("insert into score_backup values('','1','1','3','3','-1')");
mysql_query("insert into score_backup values('','1','1','4','3','-1')");


mysql_query("insert into score_backup values('','1','1','0','1','-1')");
mysql_query("insert into score_backup values('','1','1','0','2','-1')");
mysql_query("insert into score_backup values('','1','1','0','3','-1')");






mysql_query("insert into user values ('','".$user_name2."','".$user_email2."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','9.20','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','9.20','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','6.38','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','8.02','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','8.28','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','8.12','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','5.30','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','6.84','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.12','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','8.50','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','8.78','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','9.03','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','8.20','A')");
mysql_query("insert into score values('','1','".$user_count."','0','2','7.14','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','8.61','A')");







mysql_query("insert into user values ('','".$user_name3."','".$user_email3."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','10.00','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','9.97','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','0.02','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','7.47','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','3.45','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','7.10','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','4.03','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','1.60','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.03','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','3.42','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.97','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','6.50','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.87','A')");
mysql_query("insert into score values('','1','".$user_count."','0','2','4.04','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','6.73','A')");





mysql_query("insert into user values ('','".$user_name4."','".$user_email4."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.57','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','7.35','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','5.37','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','8.82','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','7.45','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','7.92','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','7.38','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','8.70','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.29','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','8.47','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.62','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','9.70','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','7.53','A')");
mysql_query("insert into score values('','1','".$user_count."','0','2','7.86','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','9.02','A')");



mysql_query("insert into user values ('','".$user_name5."','".$user_email5."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','9.07','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','8.35','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','7.33','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','7.30','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','7.52','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','9.18','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','8.95','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','8.75','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.30','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','7.50','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.30','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','9.53','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','8.01','A')");
mysql_query("insert into score values('','1','".$user_count."','0','2','8.60','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','8.66','A')");




mysql_query("insert into user values ('','".$user_name6."','".$user_email6."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.75','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','5.12','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','3.42','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','4.50','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','6.58','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','9.26','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','5.39','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','9.70','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.67','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','4.17','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','7.22','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','7.70','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','5.45','A')");
mysql_query("insert into score values('','1','".$user_count."','0','2','7.73','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','6.69','A')");







?>


<!-- jQuery -->
<meta http-equiv=refresh content="0.00005; url=control_panel.php">

</body>

</html>
