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






//mysql_query("insert into score values('','2','7','1','1','77')");
//mysql_query("insert into debug values('','".$data[1][3]."')");


for($i = 0; $i<=3; $i++){
    for($k = 1; $k<=4; $k++){
        mysql_query("update score set score = '".$data[$i][$k]."' where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user_id']."' and criteria_id = '".$i."' and candidate_id = '".$k."' ");
    }
}


?>

</body>

</html>




