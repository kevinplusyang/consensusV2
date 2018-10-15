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


echo htmlspecialchars($_POST['username']);
echo htmlspecialchars($_POST['email']);
echo htmlspecialchars($_POST['password']);
echo htmlspecialchars($_POST['participate']);
echo htmlspecialchars($_POST['type']);


$user_num = intval($_POST['participate']) * 3 + 1;



mysql_query("insert into reason values('','1','No Data') ");
mysql_query("insert into reason values('','1','No Data') ");


echo "Now";


mysql_query("insert into user values ('','".mysql_real_escape_string($_POST['username'])."','".mysql_real_escape_string($_POST['email'])."','".md5($_POST['password'])."') ");

$result = mysql_query("select * from user where email = '".mysql_real_escape_string($_POST['email'])."' ");
$row = mysql_fetch_array($result);
$user_id = $row['id'];



mysql_query("insert into decision values ('', 'Test1', 'No', '1', '4','3','".$user_num."','".mysql_real_escape_string($_POST['type'])."')");
mysql_query("insert into participate values('','1','1','1')");


for($i = 0; $i < $_POST['participate'] * 3; $i++){
    $j = $i + 2;
    mysql_query("insert into participate values('','1','".$j."','".$j."')");
}





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




for($i = 0; $i <= 5; $i++){
    $arr[$i] = $i + 1;
}





shuffle($arr);

print_r($arr);





for($i = 0; $i < $_POST['participate'] * 3; $i++){
    $result = mysql_query("select * from name where id = '".$arr[$i]."' ");
    $row = mysql_fetch_array($result);
    $name = $row['name'];

    $j = $i + 2;
    mysql_query("insert into user values ('','".$name."','x@ucsd.edu','".md5(1234)."') ");

}






//for($i = 0 ;$i < $_POST['participate'] ; $i++){
//    $result = mysql_query("select * from score_pool_adam where user_id = '".$arr[$i]."' ");
//    while($row = mysql_fetch_array($result)){
//        $j = $i +1;
//        mysql_query("insert into score values('','','".$j."','".$row['criteria_id']."','".$row['candidate_id']."','".$row['score']."','".$row['argument']."')");
//
//    }
//
//}




for($i = 0 ;$i < $_POST['participate'] ; $i++){
    $result = mysql_query("select * from score_pool_adam where user_id = '".$arr[$i]."' ");
    while($row = mysql_fetch_array($result)){
        $j = $i +2;
        mysql_query("insert into score values('','1','".$j."','".$row['criteria_id']."','".$row['candidate_id']."','".$row['score']."','".$row['argument']."')");

    }

}




for($i = 0 ;$i < $_POST['participate'] ; $i++){
    $result = mysql_query("select * from score_pool_jim where user_id = '".$arr[$i]."' ");
    while($row = mysql_fetch_array($result)){
        $j = $i + $_POST['participate'] +2;
        mysql_query("insert into score values('','1','".$j."','".$row['criteria_id']."','".$row['candidate_id']."','".$row['score']."','".$row['argument']."')");

    }

}


for($i = 0 ;$i < $_POST['participate'] ; $i++){
    $result = mysql_query("select * from score_pool_sam where user_id = '".$arr[$i]."' ");
    while($row = mysql_fetch_array($result)){
        $j = $i + $_POST['participate']*2 +2;
        mysql_query("insert into score values('','1','".$j."','".$row['criteria_id']."','".$row['candidate_id']."','".$row['score']."','".$row['argument']."')");

    }

}


?>


<!-- jQuery -->
<!--<meta http-equiv=refresh content="0.00005; url=control_panel.php">-->

</body>

</html>
