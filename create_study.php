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


mysql_query("insert into decision values ('', '".$_POST['studyname']."', '".$_POST['description']."', '1', '3','4','0')");

$result = mysql_query("select * from decision where name = '".$_POST['studyname']."' ");
$row = mysql_fetch_array($result);
$decision_id = $row['id'];

mysql_query("insert into overall values('','".$decision_id."','1','1','10')");
mysql_query("insert into overall values('','".$decision_id."','2','1','10')");
mysql_query("insert into overall values('','".$decision_id."','3','1','10')");
mysql_query("insert into overall values('','".$decision_id."','1','2','10')");
mysql_query("insert into overall values('','".$decision_id."','2','2','10')");
mysql_query("insert into overall values('','".$decision_id."','3','2','10')");
mysql_query("insert into overall values('','".$decision_id."','1','3','10')");
mysql_query("insert into overall values('','".$decision_id."','2','3','10')");
mysql_query("insert into overall values('','".$decision_id."','3','3','10')");
mysql_query("insert into overall values('','".$decision_id."','1','4','10')");
mysql_query("insert into overall values('','".$decision_id."','2','4','10')");
mysql_query("insert into overall values('','".$decision_id."','3','4','10')");

mysql_query("insert into overall values('','".$decision_id."','0','1','10')");
mysql_query("insert into overall values('','".$decision_id."','0','2','10')");
mysql_query("insert into overall values('','".$decision_id."','0','3','10')");
mysql_query("insert into overall values('','".$decision_id."','0','4','10')");

mysql_query("insert into conflict values('','".$decision_id."','1','1','0')");
mysql_query("insert into conflict values('','".$decision_id."','2','1','0')");
mysql_query("insert into conflict values('','".$decision_id."','3','1','0')");
mysql_query("insert into conflict values('','".$decision_id."','1','2','0')");
mysql_query("insert into conflict values('','".$decision_id."','2','2','0')");
mysql_query("insert into conflict values('','".$decision_id."','3','2','0')");
mysql_query("insert into conflict values('','".$decision_id."','1','3','0')");
mysql_query("insert into conflict values('','".$decision_id."','2','3','0')");
mysql_query("insert into conflict values('','".$decision_id."','3','3','0')");
mysql_query("insert into conflict values('','".$decision_id."','1','4','0')");
mysql_query("insert into conflict values('','".$decision_id."','2','4','0')");
mysql_query("insert into conflict values('','".$decision_id."','3','4','0')");

mysql_query("insert into conflict values('','".$decision_id."','0','1','0')");
mysql_query("insert into conflict values('','".$decision_id."','0','2','0')");
mysql_query("insert into conflict values('','".$decision_id."','0','3','0')");
mysql_query("insert into conflict values('','".$decision_id."','0','4','0')");



?>


<!-- jQuery -->
<meta http-equiv=refresh content="0.00005; url=control_panel.php">

</body>

</html>
