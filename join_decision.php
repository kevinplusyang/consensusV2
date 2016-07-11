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
echo $_POST['invitation_code'];
$decision_id = $_POST['invitation_code'];

mysql_query("insert into participate values('','".$decision_id."','".$_SESSION['user_id']."')");


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

require_once "calculate_individual.php";

?>

</body>
</html>
