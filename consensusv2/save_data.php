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
$data = json_decode(stripslashes($_POST['trans_data']));
//$data=$_POST['trans_data'];
$result = mysql_query("select * from decision where id = '".$_GET['decision_id']."'");
$row = mysql_fetch_array($result);
$criteria_num =$row['criteria_num'];
$candidate_num = $row['candidate_num'];
$user_num = $row['user_num'];
//mysql_query("insert into score values('','2','7','1','1','77')");
mysql_query("insert into debug values('','".$_GET['user_id']."')");
for($i = 0; $i<=$criteria_num; $i++){
    for($k = 1; $k<=$candidate_num; $k++){
        mysql_query("update score set score = '".$data[$i][$k]."' where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user_id']."' and criteria_id = '".$i."' and candidate_id = '".$k."' ");
        mysql_query("update score_backup set score = '".$data[$i][$k]."' where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user_id']."' and criteria_id = '".$i."' and candidate_id = '".$k."' ");

    }
}
?>

</body>

</html>
