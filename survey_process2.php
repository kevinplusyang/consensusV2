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




mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','4','".$_POST['q4']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','5','".$_POST['q5']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','6','".$_POST['q6']."')");
mysql_query("insert into survey values ('','".$_GET['decision_id']."','".$_GET['user_id']."','7','".$_POST['q7']."')");


?>

</body>


<meta http-equiv=refresh content="0.00005; url=http://www.ucsd.edu">

</html>
