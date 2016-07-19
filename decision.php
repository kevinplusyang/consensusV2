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


    scores2 = new Array();
    for(var k=0;k<criteria_num+1;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        scores2[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<candidate_num;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；

            scores2[k][j]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
        }
    }


</script>




<!--<div>-->
<!--    Users in this dcision:-->
<!--    --><?php
//    $result = mysql_query("select * from participate where decision_id = '".$_GET['decision_id']."'");
//    while($row = mysql_fetch_array($result)){
//        $user_id = $row['user_id'];
//
//        $username_result = mysql_query("select * from user where id = '".$user_id."' ");
//        $username_row = mysql_fetch_array($username_result);
//        $username = $username_row['user_name'];
//
//        ?>
<!---->
<!--        <a href="decision.php?decision_id=--><?php //echo $_GET['decision_id'];?><!--&user=--><?php //echo $user_id;?><!--">--><?php //echo $username;?><!--</a>-->
<!---->
<!--        --><?php
//
//    }
//    ?>
<!---->
<!--</div>-->

<div>
    <a href="overall.php?decision_id=<?php echo $_GET['decision_id']?>">Overall Page</a>
</div>


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
//                console.log(user_num);

                var obj = eval(xmlhttp.responseText);

//                console.log(obj.length);

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



                if(count == 1){

                    calculateTable();


                    var height = 450, width = 700;
                    var drag = d3.behavior.drag()
                        .origin(Object)
                        .on("drag", dragMove)
                        .on('dragend', dragEnd);

                    var svg = d3.select('body')
                        .append('svg')
                        .attr("height", height)
                        .attr("width", width);

                    var g = svg.append('g')
                        .attr("height", height)
                        .attr("width", width)
                        .attr('transform', 'translate(20, 10)');

                    var data1 = [{rect:0, name:"overall"},{rect:1, name:"academic"},{rect:2, name:"extra curricular"},{rect:3, name:"recommondation letter"}];

                    var title_width = 150;
                    var rect_height = 5, rect_width=400;
                    var padding_x = 10;
                    var padding_y = 60;

                    var rect = g
                        .selectAll('rect')
                        .data(data1)
                        .enter()
                        .append('g')
                        .classed("bar", true)
                        .attr("id", function(d) {return "a" + d.rect.toString();})
                        ;

                    rect
                        .append("text")
                        .attr("x", title_width)
                        .attr("y", function(d){return (d.rect + 1) * padding_y + 5})
                        .attr("text-anchor", "end")
                        .text(function(d){return d.name;});
                    rect
                        .append('rect')
                        .attr("x", title_width + padding_x)
                        .attr('y', function(d){return (d.rect + 1) * padding_y;})
                        .attr("height", rect_height)
                        .attr("width", rect_width)
                        .attr("fill", "#C0C0C0");



                    var color = new Array("green", "blue", "yellow", "purple", "orange", "brown", "Chartreuse", "Cyan");

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
                            str = str + parseFloat(scores[criteria_id_init][candidate_id_init]);
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
                    str = str + "]";

//                    console.log(str);




                    var data2 = eval('(' + str + ')');

                    var r = 10;

                    var circle = g
                        .selectAll("circle")
                        .data(data2)
                        .enter()
                        .append("g")
                        .classed("handler", true)
                        .attr("id", function(d) {return "a" + d.id.toString(); })
                        .call(drag);

                    circle
                        .append("circle")
                        .attr("r", r)
                        .attr("cx", function(d) {
                            if(d.score == -1) {
                                return d.x = 480 + d.col * 30;
                            }else {
                                return d.x = title_width + padding_x + d.score * rect_width /10;
                            }


                        })
                        .attr("cy", function(d) { return d.y = padding_y * (d.row + 1); })
                        .attr("fill", function(d) {return color[d.col - 1];});

circle
                        .append("path")
                        .attr("class", "float_path")
                        .attr("d", function(d) {
                            return "M " + d.x.toString() + " " + d.y.toString() + "L " + d.x.toString() + " " + d.y.toString();
                         })
                        .attr("stroke", "grey")
                        .attr("stroke-width", "2")
                        .attr("opacity", 0.6)
                        ;

                    circle
                        .append("text")
                        .attr("x", function(d){

                            if(d.score == -1){
                                return d.x = 480 + d.col * 30;
                            }
                            else{
                                return d.x = title_width + padding_x + d.score * rect_width / 10;
                            }
                        })
                        .attr("y", function(d){return d.y - 10;})
                        .text('');

                    

                    var float_height = 15;

                    function dragMove(d) {
                        d3.select(this)
                            .select("circle")
                            .attr("opacity", 0.4)
                            .attr("cx", d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x)))
                            .attr("cy", d.y - float_height);

                        d3.select(this)
                            .select(".float_path")
                            .attr("d", function(d) {
                                return "M" + d.x.toString() + " " + (d.y - 15 + r).toString() + "L " + d.x.toString() + " " + d.y.toString();
                            });
                        
                        d3.select(this)
                            .select("text")
                            .text(function(d){
                                var x = d3.round((d3.event.x - title_width - padding_x)/rect_width * 10, 10);
                                console.log(x);
                                x = Math.min(x, 10);
                                x = Math.max(0, x);
                                console.log(x);
                                return x;

                            })
                            .attr("x", Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x))-4);


                    }

                    function dragEnd(d) {

                        // console.log(d);
                        d3.select(this)
                            .select('circle')
                            .attr('opacity', 1)
                            .attr("cy", d.y);
                        d3.select(this)
                            .select(".float_path")
                            .attr("d", function(d){
                                return "M" + d.x.toString() + " " + d.y.toString() + "L " + d.x.toString() + " " + d.y.toString(); 
                            });

                        d3.select(this)
                            .select("text")
                            .text('');


                        var score_num = d3.round((d.x - title_width - padding_x)/rect_width * 10, 10);
                        console.log("score_num");
                        console.log(score_num);
                        scores[d.row][d.col] = score_num;




                        calculateTable();

                        save();

//                        tableChanged(d.row, d.col, score_num);


                        var overall = scores[0][d.col];
//                        console.log(overall);
                        var overall_id = "#a0" + d.col.toString();
//                        console.log(overall_id);
                        d3.select(overall_id).select("circle").attr("cx", function(d) {
                            d.x = title_width + padding_x + overall * rect_width /10;
//                            console.log(d.x);
                            return d.x;}

                        );



                    }






                    /* legend */
                    var candid = [{candid: "Betsy"}, {candid: "Chris"}, {candid: "Ross"}]
                    var legend_height = 10;
                    var legend = d3.select('body')
                        .append("svg")
                        .append("g")
                        .selectAll("g")
                        .data(candid)
                        .enter()
                        .append('g')
                        .attr('class', 'legend')
                        .attr('transform', function(d, i) {
                            var x = 8;
                            var y = i * legend_height + 8;
                            return 'translate(' + x + ',' + y + ')';
                        });
                    legend.append('circle')
                        .attr('cx', 0)
                        .attr('cy', function(d, i) {
                            return i * legend_height;
                        })
                        .attr("r", 5)
                        .style('fill', function(d, i) { return color[i];})
                        .style('stroke', function(d, i) {return color[i];});

                    legend.append('text')
                        .attr('x', 8)
                        .attr('y', function(d, i) {
                            return i * legend_height + 6;})
                        .text(function(d) { return d.candid; });



                    for(var m = 1; m <4; m++ ){
                        for(var n = 1; n <4; n++){

                            scores2[m][n] = scores[m][n];
                        }
                    }



                }






                for(var m = 1; m <4; m++ ){
                    for(var n = 1; n <4; n++){

                        if(scores2[m][n] == scores[m][n]){

                        }else {
                            calculateTable();
                            oneChanged(m,n);
                        }
                        scores2[m][n] = scores[m][n];
                    }
                }






            }



        },
            xmlhttp.open("GET","fetch_individual_data.php?decision_id=<?php echo $_GET['decision_id']?>&user_id=<?php echo $_GET['user']?>",true);
            xmlhttp.send();







    }





//    loadXMLDoc();
        var t=setInterval("loadXMLDoc()",2000);





</script>



<script>



    function oneChanged(criteria_id, candidate_id){
        var title_width = 150;
        var rect_width=400;
        var padding_x = 10, padding_y = 70;
        var score1 = scores[criteria_id][candidate_id];
        var score2 = scores[0][candidate_id];
        var id1 = "#a" + criteria_id.toString() + candidate_id.toString();
        var id2 = "#a0" + candidate_id.toString();

        d3.select(id1).select("circle")
            .attr("cx", function(d) {return d.x = title_width + padding_x + rect_width / 10 * score1; })

        d3.select(id2).select("circle")
            .attr("cx", function(d) {return d.x = title_width + padding_x + rect_width / 10 * score2; })

    }


    function calculateTable() {

        var i = 0;
        var j = 0;
        var temp = 0.00;

        for(i = 1; i <=3; i++){
            temp = 0;
            for(j = 1; j <=3; j++){
                temp = temp + parseFloat(scores[j][i]);

            }
            scores[0][i] = temp/3;

        }

//        console.log(scores);

    }

    
    



    function tableChanged(criteria_id, candidate_id, score){

        var num = score;

        updateTable(criteria_id, candidate_id, num);

        var newData = calculate(candidate_id, criteria_id);

        updateTableOverall(criteria_id, candidate_id, newData);

//        document.getElementById("0"+candidate_id+"").innerHTML = newData;

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
//            console.log(temp);


        }
        return temp/3;
    }

    function save(){

//        console.log(scores);

        var jsonString = JSON.stringify(scores);

//        console.log(jsonString);

        $.ajax({
            url: "save_data.php?decision_id=<?php echo $_GET['decision_id'];?>&user_id=<?php echo $_GET['user'];?>",
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
</script>

</body>
</html>