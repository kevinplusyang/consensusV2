<?php

session_start();
require_once "dbaccess.php";

$sql_count = "select count(*) from participate where decision_id = '".$_GET['decision_id']."' ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_num = $row_count[0];



for($criteria_id = 0; $criteria_id<=3; $criteria_id++ ){
    for($candidate_id = 1; $candidate_id<=4; $candidate_id++){
        $result = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and criteria_id = '".$criteria_id."' and candidate_id = '".$candidate_id."' ");
        $temp = 0.00;
        while($row = mysql_fetch_array($result)){
            $temp = $temp + $row['score'];
        }
        $temp = $temp/$user_num;
        $avg = $temp;

        $result_2 = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and criteria_id = '".$criteria_id."' and candidate_id = '".$candidate_id."' ");
        $temp_2 = 0.00;
        $temp_3 = 0.00;
        while($row_2 = mysql_fetch_array($result_2)){
            $temp_2 = $row_2['score'];
            $temp_3 = $temp_3 + ($temp_2 - $avg)*($temp_2 - $avg);
        }
        $sd = $temp_3/$user_num;


        mysql_query("update overall set score = '".$avg."' where decision_id = '".$_GET['decision_id']."' and criteria_id = '".$criteria_id."' and candidate_id = '".$candidate_id."'  ");
        mysql_query("update conflict set score = '".$sd."' where decision_id = '".$_GET['decision_id']."' and criteria_id = '".$criteria_id."' and candidate_id = '".$candidate_id."'  ");

    }
}


//$result = mysql_query("select * from conflict where decision_id = '".$_GET['decision_id']."' ");

$result = mysql_query("select * from score_backup where decision_id = '".$_GET['decision_id']."'");

while($row = mysql_fetch_row($result)){
    $all[]=($row);
}



echo json_encode($all);
?>