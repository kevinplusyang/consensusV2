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



mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','1','".$_POST['q1']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','2','".$_POST['q2']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','3','".$_POST['q3']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','4','".$_POST['q4']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','5','".$_POST['q5']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','6','".$_POST['q6']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','7','".$_POST['q7']."')");


?>

</body>


<meta http-equiv=refresh content="0.00005; url=holdpage_2.php?decision_id=<?php echo $_GET['decision_id']?>&user_id=<?php echo $_GET['user_id']?>">

</html>
