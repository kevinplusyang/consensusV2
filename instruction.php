<?php
session_start();
require_once "dbaccess.php";
?>

<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>
<body>


Participant Name:
<?php

echo $_SESSION['username'];

$result = mysql_query("select * from decision where id = '".$_GET['decision_id']."'");
$row = mysql_fetch_array($result);

$criteria_num =$row['criteria_num'];
$candidate_num = $row['candidate_num'];
$user_num = $row['user_num'];

$decision_id = $_GET['decision_id'];
$user_id = $_GET['user_id'];


?>





<br>
<button onclick="location='decision.php?decision_id=<?php echo $decision_id;?>&user=<?php echo $_SESSION['user_id'];?>'">Enter the Study</button>









</body>
</html>