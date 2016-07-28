<?php
session_start();
require_once "dbaccess.php";
?>

<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>
<body>

<?php
$sql_count = "select count(*) from participate where decision_id = '".$_GET['decision_id']."' ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_num = $row_count[0];

echo $user_num;
?>




<script>
    scores = new Array();
    for(var k=0;k<4;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        scores[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<4;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；

            scores[k][j]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
        }
    }



</script>

<div id="myDiv"><h2>使用 AJAX 修改该文本内容</h2></div>
<button type="button" onclick="loadXMLDoc()">修改内容</button>


<script>
    function loadXMLDoc()
    {
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
                console.log(user_num);
                document.getElementById("myDiv").innerHTML=xmlhttp.responseText;


//                console.log(xmlhttp.responseText);

                var obj = eval(xmlhttp.responseText);

                console.log(obj.length);

                var criteria_id = 0;
                var candidate_id = 0;
                var user_id = 0;
                var score_data = 0.00;



                for(var i = 0; i < obj.length; i++){
                    criteria_id = obj[i][3];
                    candidate_id = obj[i][4];
                    score_data = obj[i][5];
                    user_id = obj[i][2];

                    scores[criteria_id][candidate_id] = score_data;


                }

                console.log(scores);


            }
        },
            xmlhttp.open("GET","inspect_data.php?decision_id=<?php echo $_GET['decision_id']?>&user_id=<?php echo $_GET['user_id']?>",true);
        xmlhttp.send();
    }

    var t=setInterval("loadXMLDoc()",2000);


</script>



</body>
</html>






