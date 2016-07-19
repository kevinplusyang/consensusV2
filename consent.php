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



<hr>



<div>
    Consent Here.
</div>

<hr>



<label><input name="" type="checkbox" value="" id="regText">I Agree the Consent by Clicking the Check Box</label>

<br>

<button onclick="location='instruction.php?decision_id=<?php echo $decision_id;?>&user_id=<?php echo $user_id;?>'" disabled id="regBtn">Enter Instruction</button>


<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.9.0/jquery.min.js"></script>
<script>
    //作者：懒人建站
    $(function(){
        var regBtn = $("#regBtn");
        $("#regText").change(function(){
            var that = $(this);
            that.prop("checked",that.prop("checked"));
            if(that.prop("checked")){
                regBtn.prop("disabled",false)
            }else{
                regBtn.prop("disabled",true)
            }
        });
    });
</script>






</body>
</html>