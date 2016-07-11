<?php
session_start();
require_once "dbaccess.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>
<body>

<?php
echo $_POST['decision_name'];
echo $_POST['description'];
echo $_SESSION['user_id'];
//mysql_query("insert into decision values ('','".$_POST['e2_id']."','".$_GET['e1_id']."','".$_POST['name']."')");
mysql_query("insert into decision values ('', '".$_POST['decision_name']."', '".$_POST['description']."', '".$_SESSION['user_id']."')");

$result = mysql_query("select * from decision where name = '".$_POST['decision_name']."' ");
$row = mysql_fetch_array($result);
$decision_id = $row['id'];


mysql_query("insert into participate values('','".$decision_id."','".$_SESSION['user_id']."')");

mysql_query("insert into candidate values('','".$decision_id."','Betsy','')");
mysql_query("insert into candidate values('','".$decision_id."','Joyce','')");
mysql_query("insert into candidate values('','".$decision_id."','Sara','')");
mysql_query("insert into candidate values('','".$decision_id."','Lucy','')");

mysql_query("insert into criteria values('','".$decision_id."','First Criteria')");
mysql_query("insert into criteria values('','".$decision_id."','Second Criteria')");
mysql_query("insert into criteria values('','".$decision_id."','Third Criteria')");

mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','1','1','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','2','1','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','3','1','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','1','2','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','2','2','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','3','2','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','1','3','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','2','3','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','3','3','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','1','4','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','2','4','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','3','4','100')");

mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','0','1','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','0','2','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','0','3','100')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','0','4','100')");

mysql_query("insert into overall values('','".$decision_id."','1','1','100')");
mysql_query("insert into overall values('','".$decision_id."','2','1','100')");
mysql_query("insert into overall values('','".$decision_id."','3','1','100')");
mysql_query("insert into overall values('','".$decision_id."','1','2','100')");
mysql_query("insert into overall values('','".$decision_id."','2','2','100')");
mysql_query("insert into overall values('','".$decision_id."','3','2','100')");
mysql_query("insert into overall values('','".$decision_id."','1','3','100')");
mysql_query("insert into overall values('','".$decision_id."','2','3','100')");
mysql_query("insert into overall values('','".$decision_id."','3','3','100')");
mysql_query("insert into overall values('','".$decision_id."','1','4','100')");
mysql_query("insert into overall values('','".$decision_id."','2','4','100')");
mysql_query("insert into overall values('','".$decision_id."','3','4','100')");

mysql_query("insert into overall values('','".$decision_id."','0','1','100')");
mysql_query("insert into overall values('','".$decision_id."','0','2','100')");
mysql_query("insert into overall values('','".$decision_id."','0','3','100')");
mysql_query("insert into overall values('','".$decision_id."','0','4','100')");

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

</body>
</html>
