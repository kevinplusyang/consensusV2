<?php
require_once "dbaccess.php";
?>



<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.teal-red.min.css">



<html lang="en">
<head>
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>


<body>

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

========================================================================
<br>
Individual Pages:


<?php


for($i = 1; $i <= $user_num; $i++){

    ?>
    <table border="1px">
        <tr>
            <td>Average</td>
            <?php
            for($j = 1; $j <=$candidate_num; $j++){

                $result = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and user_id = '".$i."' and criteria_id = 0 and candidate_id = '".$j."' ");
                $row = mysql_fetch_array($result);
                $score = $row['score'];
                ?>
                <td><?php echo $score;?></td>
                <?php
            }
            ?>
        </tr>

        <?php
        for($k = 1; $k<= $criteria_num; $k++ ){
            ?>
            <tr>
                <td>(<?php echo $k;?>,0)</td>
                <?php

                for($j = 1; $j <=$candidate_num; $j++){
                    $result = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and user_id = '".$i."' and criteria_id = '".$k."' and candidate_id = '".$j."' ");
                    $row = mysql_fetch_array($result);
                    $score = $row['score'];
                    ?>
                    <td><?php echo $score;?></td>
                    <?php
                }
                ?>

            </tr>
            <?php
        }
        ?>

    </table>

    <br>
    <br>

    <?php

}



?>





========================================================================
<br>
Overall Average:

    <table border="1px">
        <?php
        for($j = 0; $j <= $criteria_num; $j++){
            ?>
            <tr>
                <?php
                for($k = 0; $k <= $candidate_num; $k++){
                    ?>
                    <td id="x<?php echo $j;?><?php echo $k;?>">
                        123
                    </td>
                    <?php
                }
                ?>
            </tr>
            <?php
        }
        ?>


    </table>

<br>
<br>
========================================================================
<br>
Conflict:


<table border="1px">
    <?php
    for($j = 0; $j <= $criteria_num; $j++){
        ?>
        <tr>
            <?php
            for($k = 0; $k <= $candidate_num; $k++){
                ?>
                <td id="c<?php echo $j;?><?php echo $k;?>">
                    ccc
                </td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>


</table>







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

</script>




<script>

    count = 0;
    function loadXMLDoc()
    {
        count++;

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



                var criteria_id = 0;
                var candidate_id = 0;
                var user_id = 0;
                var score_data = 0.00;


                for(var i = 0; i < obj.length; i++){
                    criteria_id = obj[i][3];
                    candidate_id = obj[i][4];
                    score_data = obj[i][5];
                    user_id = obj[i][2];

                    score[criteria_id][candidate_id][user_id] = score_data;

                }

                if(count == 1){
                    calculateAvg();

                    calculateConflict();


                    console.log(score);
                    console.log(conflict);
                    console.log(overall);




                }












            }



        },
            xmlhttp.open("GET","overall_data.php?decision_id=<?php echo $_GET['decision_id']?>",true);
        xmlhttp.send();







    }





        loadXMLDoc();
//    var t=setInterval("loadXMLDoc()",2000);


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

                document.getElementById("x"+criteria_id+candidate_id).innerHTML = temp;

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
                document.getElementById("c"+criteria_id+candidate_id).innerHTML = conflict[criteria_id][candidate_id];


            }
        }


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









</script>



</body>
<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>

</html>






