<?php
session_start();
require_once "dbaccess.php";
?>





<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!--<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.teal-green.min.css">-->
<link rel="stylesheet" href="buttons.css">


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">




<html lang="en">
<head>
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>


<style>

    button:hover{
        background-color: grey;
    }

    button:hover{
        background-color: dimgrey;
        color: white;
        border-bottom: 0;
        border-top: 0;
    }
</style>


<!--<button onclick="location='http://goo.gl/forms/2Bk1cmcva4Flvh2j2'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="margin-left: 10px">-->
<!--    Finish This Study-->
<!--</button>-->


<!--<a href="http://goo.gl/forms/2Bk1cmcva4Flvh2j2">Finish This Study</a>-->

<?php

$result = mysql_query("select * from participate where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user_id']."' ");
$row = mysql_fetch_array($result);
$real_user_id = $row['real_user_id'];

$result = mysql_query("select * from user where id = '".$real_user_id."'");
$row = mysql_fetch_array($result);
$user_name = $row['user_name'];

?>




<body>


<p style="padding-left: 10px">
    <b>
        Group Page for <?php echo $user_name;?>
    </b><br>
    This is an average of everyone's votes, come to a consensus on the best candidate.<br>
    The Score Variance (red bars) indicate the amount of disagreement.
    <br>
    Click on the dots to see others' votes and to change your vote; Hover over voters to see more details.<br>
</p>





<?php
$result = mysql_query("select * from decision where id = '".$_GET['decision_id']."'");
$row = mysql_fetch_array($result);

$criteria_num =$row['criteria_num'];
$candidate_num = $row['candidate_num'];
$user_num = $row['user_num'];



$sql_count = "select count(*) from participate where decision_id = '".$_GET['decision_id']."' ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_num = $row_count[0];



?>

<br>



<script>
    var criteria_num = parseInt(<?php echo $criteria_num;?>);
    var candidate_num = parseInt(<?php echo $candidate_num;?>);
    var user_num = parseInt(<?php echo $user_num;?>);


    overall = new Array();
    for(var k=0;k<criteria_num+1;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        overall[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<candidate_num+2;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；

            overall[k][j]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
        }
    }

</script>

<script>
    conflict = new Array();
    for(var k=0;k<criteria_num+1;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        conflict[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<candidate_num+2;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；

            conflict[k][j]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
        }
    }

</script>


<script>
    score = new Array();
    for(var k=0;k<criteria_num+1;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        score[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<candidate_num+2;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；
            score[k][j]=new Array();

            for(var p = 0; p<user_num; p++){
                score[k][j][p]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
            }


        }
    }

</script>

<script>
    score2 = new Array();
    for(var k=0;k<criteria_num+1;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        score2[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<candidate_num+2;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；
            score2[k][j]=new Array();

            for(var p = 0; p<user_num; p++){
                score2[k][j][p]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
            }


        }
    }


    argu = new Array();
    for(var k=0;k<user_num+1;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        argu[k]="NULL";  //声明二维，每一个一维数组里面的一个元素都是一个数组；


    }



</script>







<!-- <div id="myDiv"><h2>使用 AJAX 修改该文本内容</h2></div>
<button type="button" onclick="loadXMLDoc()">修改内容</button> -->





<div style="margin-left: 10px; margin-top: 60px">
</div>


<?php

$result = mysql_query("select * from participate where decision_id = '".$_GET['decision_id']."'; ");

$str = "[";

while ($row = mysql_fetch_array($result)){
    $user_id = $row['user_id'];
    $real_user_id = $row['real_user_id'];
    $result_2 = mysql_query("select * from user where id = '".$real_user_id."' ");
    $row_2 = mysql_fetch_array($result_2);
    $user_name = $row_2['user_name'];

    $str = $str."{code:".$user_id.", name:\"".$user_name."\"}";
    if($user_id != $user_num){
        $str = $str.",";
    }

}

$str = $str."]";

// echo $str;

?>



<div class="row">
    <div class="col-lg-12 row center">
        <div class="col-lg-2 text-center">

            <button style="width: 70px" class="text-center" id="0"  onmouseover="defaultContent(this)" value="all">All</button>
<!--            <a class="text-center" id="0"  onmouseover="defaultContent(this)" value="all">All</a>-->

<br>

            <?php
            $result = mysql_query("select * from participate");
            ?>



            <?php
            while($row = mysql_fetch_array($result)){
                $participate_id = $row['user_id'];

                $result_2 = mysql_query("select * from user where id = '".$participate_id."' ");
                $row_2 = mysql_fetch_array($result_2);

                $participate_name = $row_2['user_name'];

                ?>

                <button  style="width: 70px"  class="text-center" id="<?php echo $participate_id;?>" onmouseout="defaultContent()" onmouseover="changeContent(this)" value="<?php echo $participate_name;?>"><?php  echo $participate_name?></button>
<!--                <a class="text-center" id="--><?php //echo $participate_id;?><!--" onmouseout="defaultContent()" onmouseover="changeContent(this)" value="--><?php //echo $participate_name;?><!--">--><?php // echo $participate_name?><!--</a>-->
                <br>
                <?php


            }

            ?>



        </div>
        <div class="col-lg-6">

            <table border="1px" style="width: 100%">
                <tr class="text-center">
                    <td></td>
                    <td>Sam</td>
                    <td>Adam</td>
                    <td>Jim</td>
                </tr>

                <tr class="text-center">
                    <td style="width: 40%">Overall</td>
                    <td id="01" style="width: 20%">Loading</td>
                    <td id="02" style="width: 20%">Loading</td>
                    <td id="03" style="width: 20%">Loading</td>
                </tr>

                <tr class="text-center">
                    <td>Academic</td>
                    <td id="11">Loading</td>
                    <td id="12">Loading</td>
                    <td id="13">Loading</td>
                </tr>

                <tr class="text-center">
                    <td>Extracurricular</td>
                    <td id="21">Loading</td>
                    <td id="22">Loading</td>
                    <td id="23">Loading</td>
                </tr>

                <tr class="text-center">
                    <td>Recommendation Letter</td>
                    <td id="31">Loading</td>
                    <td id="32">Loading</td>
                    <td id="33">Loading</td>
                </tr>

                <tr class="text-center">
                    <td>Fit for the Program</td>
                    <td id="41">Loading</td>
                    <td id="42">Loading</td>
                    <td id="43">Loading</td>
                </tr>

            </table>




        </div>
        <div class="col-lg-4">
            <table border="1px" style="width: 100%">
                <tr>
                    <td style="width: 15%">Voter</td>
                    <td style="width: 85%">Argument</td>
                </tr>

                <tr>
                    <td id="participate_id">Loading</td>
                    <td id="participate_argument">Loading</td>
                </tr>

            </table>
        </div>

    </div>
</div>








<br>

<br>
<br>



<div style="padding-left: 400px; margin-bottom: 30px">

    <textarea  name="argument" placeholder="Reasons for your scores..." id="argu_id_argu" onkeyup="saveA()" onkeydown="countWord()" style="width: 500px; height: 100px;"></textarea>
    <span id="word_counter">0</span>Words<br/>
</div>



<div style="width:1000px;float:right;">

    <a href="holdpage_3.php?decision_id=<?php echo $_GET['decision_id']?>&user_id=<?php echo $_GET['user_id'];?>" class="button button-rounded button-raised" style="margin-left: 750px;  margin-top: 5px; float:left">Next</a>

</div>






<script>


    str1 = "";
    count = 0;
    function loadXMLDoc()
    {


        count++;
        console.log(count);

        var xmlhttp;
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {

            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {


                var user_num = <?php echo $user_num?>;
                // document.getElementById("myDiv").innerHTML=xmlhttp.responseText;



                var obj = eval(xmlhttp.responseText);





//sijia's part ********************************************************************************************************

                var criteria_id = 0;
                var candidate_id = 0;
                var user_id = 0;
                var score_data = 0.00;
                var argu_data = 'NO DATA';


                for(var i = 0; i < obj.length; i++){
                    criteria_id = obj[i][3];
                    candidate_id = obj[i][4];
                    score_data = obj[i][5];
                    user_id = obj[i][2];
                    argu_data = obj[i][6];

                    score[criteria_id][candidate_id][user_id] = score_data;


                    if(criteria_id == 0 && candidate_id ==1){

                        argu[user_id] = argu_data;
                    }

                }

                console.log(argu);

                if(count == 1){
                    calculateAvg();

                    calculateConflict();

                    console.log(score);


                }




                if(count == 1){


                    for(var m = 0; m <<?php echo $criteria_num + 1;?>; m++ ){
                        for(var n = 0; n <<?php echo $candidate_num;?>; n++){
                            for (var q = 1; q <= <?php echo $user_num;?> ; q++){
                                score2[m][n][q] = score[m][n][q];

                            }
                        }
                    }





                }




                for(var m = 0; m <<?php echo $criteria_num +1;?>; m++ ){
                    for(var n = 0; n <<?php echo $candidate_num +1;?>; n++){
                        for (var q = 1; q <= <?php echo $user_num;?>; q++){



                            if(score2[m][n][q] == score[m][n][q]){

                            }else {
                                calculateAvg();
                                calculateConflict();


                            }

                            score2[m][n][q] = score[m][n][q];
                        }

                    }
                }





                console.log("requested");

            }



        },
            xmlhttp.open("GET","overall_data.php?decision_id=<?php echo $_GET['decision_id']?>",true);
        xmlhttp.send();







    }


    loadXMLDoc();


    //    loadXMLDoc();
    var t=setInterval("loadXMLDoc()",2000);


</script>


<!--<script src="overall.js"></script>-->


<script>



    function calculateAvg(){
        var criteria_id = 0;
        var candidate_id = 0;
        var user_id = 0;
        var temp = 0.00;

        for(criteria_id = 0; criteria_id<=criteria_num; criteria_id++){
            for(candidate_id = 0; candidate_id<=candidate_num; candidate_id++){
                var temp = 0.00;
                for(user_id = 1; user_id<=user_num; user_id++){

                    temp = temp +  parseFloat(score[criteria_id][candidate_id][user_id]);
                }
                temp = temp/user_num;

                overall[criteria_id][candidate_id] = temp;

            }
        }
    }





    function calculateConflict(){
        var criteria_id = 0;
        var candidate_id = 0;
        var user_id = 0;

        var data = 0.00;
        var avg = 0.00;
        var max = 0.00;

        for(criteria_id = 0; criteria_id<=criteria_num; criteria_id++){
            for(candidate_id = 0; candidate_id<=candidate_num; candidate_id++){
                var temp = 0.00;
                data = 0.00;
                avg = 0.00;

                for(user_id = 1; user_id<=user_num; user_id++){

                    data = parseFloat(score[criteria_id][candidate_id][user_id]);
                    avg = parseFloat(overall[criteria_id][candidate_id]);


                    temp = temp + (data - avg) * (data - avg);


                }
                temp = temp/user_num;

                conflict[criteria_id][candidate_id] = temp;

            }
        }
//        var sum = 0.00;
//
//        for(criteria_id = 0; criteria_id<=3; criteria_id++) {
//            for (candidate_id = 1; candidate_id <= 3; candidate_id++) {
//
//                    sum = sum + conflict[criteria_id][candidate_id];
//            }
//        }
//
//
//        for(criteria_id = 0; criteria_id<=3; criteria_id++) {
//            for (candidate_id = 1; candidate_id <= 3; candidate_id++) {
//                conflict[criteria_id][candidate_id] = conflict[criteria_id][candidate_id] * 10/ sum;
//            }
//        }

        for(criteria_id = 0; criteria_id<=criteria_num; criteria_id++) {
            for (candidate_id = 1; candidate_id <= candidate_num; candidate_id++) {
                if(conflict[criteria_id][candidate_id] > max){
                    max = conflict[criteria_id][candidate_id];
                }
            }
        }

        for(criteria_id = 0; criteria_id<=criteria_num; criteria_id++) {
            for (candidate_id = 1; candidate_id <= candidate_num; candidate_id++) {
                conflict[criteria_id][candidate_id] = conflict[criteria_id][candidate_id] / max;
            }
        }





    }






    function save(){



        var jsonString = JSON.stringify(score);



        $.ajax({
            url: "save_overall_data.php?decision_id=<?php echo $_GET['decision_id'];?>",
            type: "POST",
            data:{trans_data:jsonString},
            traditional: true,
            error: function(){
                alert('Error');
            },
            success: function(data,status){
//               location.reload(true);
            }
        });
    }


    function saveA(){

        var argu_id_argu=document.getElementById("argu_id_argu").value;

        arguSave = argu_id_argu.replace(/\n/g, "<br/>");
        arguSave = arguSave.replace(/'/g, "pp");
        arguSave = arguSave.replace(/"/g, "ll");



        var jsonString = JSON.stringify(arguSave);

//        console.log(jsonString);

        $.ajax({
            url: "save_argu.php?decision_id=<?php echo $_GET['decision_id'];?>&user_id=1",
            type: "POST",
            data:{trans_data:jsonString},
            traditional: true,
            error: function(){
                alert('Error');
            },
            success: function(data,status){
//               location.reload(true);
            }
        });
    }


    function countWord(){


        s = document.getElementById("argu_id_argu").value;
        s = s.replace(/(^\s*)|(\s*$)/gi,"");
        s = s.replace(/[ ]{2,}/gi," ");
        s = s.replace(/\n /,"\n");
        var numm = s.split(' ').length;

        document.getElementById("word_counter").innerText = numm;

    }

    function changeContent(x){
        console.log(score);
        document.getElementById("participate_argument").innerHTML = argu[x.id];
        document.getElementById("participate_id").innerHTML = document.getElementById(x.id).innerHTML;


        var u_id = x.id;
        for(var i = 0; i <= 4; i++){
            for(var j = 1; j <=3; j++){


                document.getElementById(i+""+j).innerHTML = score[i][j][u_id];
                console.log(score[i][j][u_id]);
            }
        }




    }


    function defaultContent(){
        document.getElementById("participate_argument").innerHTML = "No Argument Now";
        document.getElementById("participate_id").innerHTML = "All";


        for(var i = 0; i <= 4; i++){
            for(var j = 1; j <=3; j++){
                console.log("++++++++");
                console.log(i);

                console.log(j);

                document.getElementById(i+""+j).innerHTML = overall[i][j].toFixed(2);

            }
        }






    }


//    setInterval(" ",1000);
setTimeout("defaultContent()",1000);




</script>



</body>
<!--<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>-->

<script src="js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>






