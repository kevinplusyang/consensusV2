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

$sql_count = "select count(*) from participate where decision_id = '".$decision_id."' ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_num = $row_count[0]+1;

mysql_query("insert into participate values('','".$decision_id."','".$user_num."','".$_SESSION['user_id']."')");
mysql_query("update decision set user_num = user_num + 1 where id = '".$decision_id."'");


mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','1','1','6')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','2','1','5')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','3','1','7')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','1','2','4')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','2','2','3')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','3','2','7')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','1','3','2')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','2','3','3')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','3','3','4')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','1','4','7')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','2','4','6')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','3','4','7')");

mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','0','1','3')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','0','2','4')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','0','3','2')");
mysql_query("insert into score values('','".$decision_id."','".$_SESSION['user_id']."','0','4','3')");

require_once "calculate_individual.php";

?>

</body>
</html>
