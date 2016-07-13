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


I'm:
<?php
echo $_SESSION['username'];

$result = mysql_query("select * from decision where id = '".$_GET['decision_id']."'");
$row = mysql_fetch_array($result);

$criteria_num =$row['criteria_num'];
$candidate_num = $row['candidate_num'];
$user_num = $row['user_num'];

?>


<?php echo $_GET['user'];?>


<script>
    var criteria_num = parseInt(<?php echo $criteria_num;?>);
    var candidate_num = parseInt(<?php echo $candidate_num;?>);
    var user_num = parseInt(<?php echo $user_num;?>);



    scores = new Array();
    for(var k=0;k<criteria_num+1;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        scores[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<candidate_num;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；

            scores[k][j]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
        }
    }



</script>


<table border="1">
    <tr>
        <?php
        $result = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user']."' and criteria_id = 0 ");
        ?>
        <td>
            Criteria_id: 0
        </td>
        <?php
        while($row = mysql_fetch_array($result)) {
            $decision_id = $row['decision_id'];
            $criteria_id = $row['criteria_id'];
            $candidate_id = $row['candidate_id'];
            $score = $row['score'];
            ?>
            <td id="<?php echo $criteria_id;?><?php echo  $candidate_id;?>">
                Candidate: <?php echo $candidate_id;?>
                <br>
                <script>

                    var score = <?php echo $score;?>;

                    scores[<?php echo $criteria_id;?>][<?php echo $candidate_id;?>] = <?php echo $score;?>;


                </script>
                Score: <?php echo $score;?>
            </td>
            <?php

        }

        ?>

    </tr>


<!--    --><?php
//    $ResultTable = mysql_query("select * from ")
//    ?>


    <tr>
        <?php
        $result = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user']."' and criteria_id = 1 ");
        ?>
        <td>
            Criteria_id: 1
        </td>
        <?php
        while($row = mysql_fetch_array($result)) {
            $decision_id = $row['decision_id'];
            $criteria_id = $row['criteria_id'];
            $candidate_id = $row['candidate_id'];
            $score = $row['score'];
            ?>
            <td>
                Candidate: <?php echo $candidate_id;?>
                <br>
                <script>
                    var score<?php echo $criteria_id;?><?php echo $candidate_id;?> = <?php echo $score;?>;

                    scores[<?php echo $criteria_id;?>][<?php echo $candidate_id;?>] = <?php echo $score;?>;

                </script>
                <input type="text"  id="<?php echo $criteria_id;?><?php echo  $candidate_id;?>" value="<?php echo $score;?>" onchange="change(this.id)" />
                Score: <?php echo $score;?>
            </td>
            <?php

        }

        ?>

        <script>

        </script>
    </tr>

    <tr>
        <?php
        $result = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user']."' and criteria_id = 2 ");
        ?>
        <td>
            Criteria_id: 2
        </td>
        <?php
        while($row = mysql_fetch_array($result)) {
            $decision_id = $row['decision_id'];
            $criteria_id = $row['criteria_id'];
            $candidate_id = $row['candidate_id'];
            $score = $row['score'];
            ?>
            <td>
                Candidate: <?php echo $candidate_id;?>
                <br>
                <script>
                    var score<?php echo $criteria_id;?><?php echo $candidate_id;?> = <?php echo $score;?>;

                    scores[<?php echo $criteria_id;?>][<?php echo $candidate_id;?>] = <?php echo $score;?>;

                </script>
                <input type="text"  id="<?php echo $criteria_id;?><?php echo  $candidate_id;?>" value="<?php echo $score;?>" onchange="change(this.id)" />

                Score: <?php echo $score;?>
            </td>
            <?php

        }

        ?>

        <script>

//            console.log(scores[2][1]);
//            console.log(scores[2][2]);
//            console.log(scores[2][3]);
//            console.log(scores[2][4]);

        </script>
    </tr>


    <tr>
        <?php
        $result = mysql_query("select * from score where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user']."' and criteria_id = 3 ");
        ?>
        <td>
            Criteria_id: 3
        </td>
        <?php
        while($row = mysql_fetch_array($result)) {
            $decision_id = $row['decision_id'];
            $criteria_id = $row['criteria_id'];
            $candidate_id = $row['candidate_id'];
            $score = $row['score'];
            ?>
            <td>
                Candidate: <?php echo $candidate_id;?>
                <br>
                <script>
                    var score<?php echo $criteria_id;?><?php echo $candidate_id;?> = <?php echo $score;?>;

                    scores[<?php echo $criteria_id;?>][<?php echo $candidate_id;?>] = <?php echo $score;?>;

                </script>
                <input type="text"  id="<?php echo $criteria_id;?><?php echo  $candidate_id;?>" value="<?php echo $score;?>" onchange="change(this.id)" />

                Score: <?php echo $score;?>
            </td>
            <?php

        }

        ?>


    </tr>

</table>


<div>
    Users in this dcision:
    <?php
    $result = mysql_query("select * from participate where decision_id = '".$_GET['decision_id']."'");
    while($row = mysql_fetch_array($result)){
        $user_id = $row['user_id'];

        $username_result = mysql_query("select * from user where id = '".$user_id."' ");
        $username_row = mysql_fetch_array($username_result);
        $username = $username_row['user_name'];

        ?>

        <a href="decision.php?decision_id=<?php echo $_GET['decision_id'];?>&user=<?php echo $user_id;?>"><?php echo $username;?></a>

        <?php

    }
    ?>

</div>

<div>
    <a href="overall.php?decision_id=<?php echo $_GET['decision_id']?>">Overall Page</a>
</div>



<script>

    i = 1;
    var j = 1;
    var temp = 0;
    for(i = 1; i<=4; i++){
        temp = 0.00;
        for(j = 1; j<=3; j++){
            temp = temp + scores[j][i];
        }
        temp = temp/3;
        scores[0][i] = temp;
        document.getElementById("0"+i+"").innerHTML=temp;
    }

    for(i = 1; i<=4; i++){
        console.log(scores[0][1]);
    }

</script>

<script>
    var criteria_id_init = 0;
    var candidate_id_init = 0;

    var str = "[";

    for(criteria_id_init = 0; criteria_id_init <= 3; criteria_id_init++){

        for(candidate_id_init = 1; candidate_id_init <=3; candidate_id_init++){
            str = str + "{row: ";
            str = str + criteria_id_init;
            str = str +", col: ";
            str = str +candidate_id_init;
            str = str + ", score: ";
            str = str + scores[criteria_id_init][candidate_id_init]/10;
            str = str + ", conflict: 0, id:\"";
            str = str + criteria_id_init;
            str = str + candidate_id_init;
            str = str + "\""

            if(criteria_id_init ==3 && candidate_id_init ==3){
                str = str + "}"

            }else {
                str = str + "},"
            }

        }


    }
    str = str + "]"

    console.log(str);

</script>

<script src="individual_page.js"></script>





<script>
    function change(x){

        var num = document.getElementById(x).value;

        var candidate_id = x%10;
        x = x - candidate_id;
        var criteria_id = x/10;


        updateTable(criteria_id, candidate_id, num);

        var newData = calculate(candidate_id, criteria_id);

        updateTableOverall(criteria_id, candidate_id, newData);

        document.getElementById("0"+candidate_id+"").innerHTML = newData;

        save();



    }

    function updateTable(criteria_id, candidate_id, num){
        num = parseFloat(num);
        scores[criteria_id][candidate_id] = num;
    }

    function updateTableOverall(criteria_id, candidate_id, num){
        num = parseFloat(num);
        scores[0][candidate_id] = num;
    }

    function calculate(candidate_id, criteria_id){


        var temp = 0.00;
        var i = 1;


        for(i = 1; i<=3; i++){

            temp = temp + scores[i][candidate_id];
            console.log(temp);


        }
        return temp/3;
    }

    function save(){

        console.log(scores);

        var jsonString = JSON.stringify(scores);

        console.log(jsonString);

        $.ajax({
            url: "save_data.php?decision_id=<?php echo $_GET['decision_id'];?>&user_id=<?php echo $_GET['user'];?>",
            type: "POST",
            data:{trans_data:jsonString},
            traditional: true,
            error: function(){
                alert('Error');
            },
            success: function(data,status){
//                location.reload(true);
            }
        });
    }
</script>

</body>
</html>