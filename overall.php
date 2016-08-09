<?php
session_start();
require_once "dbaccess.php";
?>





<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.teal-green.min.css">
<link rel="stylesheet" href="buttons.css">



<html lang="en">
<head>
<link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>



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


<style>


    .faded {
        opacity: 0;
    }

    .axis path,
    .axis line
    {
        fill: none;
        stroke: grey;
        shape-rendering: crispEdges;
    }

    .axis text
    {
        fill: grey;
        stroke: none;
        shape-rendering: crispEdges;
    }


    text {
        font-size: 14px;
        stroke: none;
        font-family: sans-serif;
    }

</style>

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
<svg id="left_side_panel"></svg>
<svg id="main_panel"></svg>
<div id = "right_side_div"></div>


<br>
<br>
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


                    var criteria_id_init = 0;
                    var candidate_id_init = 0;




                    str = "[";


                    for(criteria_id_init = 0; criteria_id_init <= <?php echo $criteria_num;?>; criteria_id_init++){

                        for(candidate_id_init = 1; candidate_id_init <=<?php echo $candidate_num;?>; candidate_id_init++){
                            str = str + "{row: ";
                            str = str + criteria_id_init;
                            str = str +", col: ";
                            str = str +candidate_id_init;
                            str = str + ", score: ";
                            str = str + overall[criteria_id_init][candidate_id_init];
                            str = str + ", conflict: ";
                            str = str + conflict[criteria_id_init][candidate_id_init];
                            str = str + ", id:\""
                            str = str + criteria_id_init;
                            str = str + candidate_id_init;
                            str = str + "\""

                            if(criteria_id_init ==<?php echo $criteria_num;?> && candidate_id_init ==<?php echo $candidate_num;?>){
                                str = str + "}"

                            }else {
                                str = str + "},"
                            }

                        }


                    }



                    str = str + "]";

                }




                if(count == 1){


                    for(var m = 0; m <<?php echo $criteria_num + 1;?>; m++ ){
                        for(var n = 0; n <<?php echo $candidate_num;?>; n++){
                            for (var q = 1; q <= <?php echo $user_num;?> ; q++){
                                score2[m][n][q] = score[m][n][q];

                            }
                        }
                    }


                    var height = 450, width = 850;
                    var r = 10;




                    var svg = d3.select('body')
                        .select('#main_panel')
                        .attr("height", height)
                        .attr("width", width)
                    //                       .style("margin-left", "300px")
//                        .attr("transform", "translate(100, 0)")
                        ;

                    svg.append("text")
                        .text("Not suitable")
                        .attr("transform", "translate(160, 50)");

                    svg.append("text")
                        .text("Suitable")
                        .style("text-anchor", "end")
                        .attr("transform", "translate(560, 50)");

                    svg.append("text")
                        .text("Candidates")
                        .attr("transform", "translate(733, 50)");



                    var g = svg.append('g')
                        .attr("height", height)
                        .attr("width", width);

                    var data1 = [{rect:0, name:"Overall"},{rect:1, name:"Academic"},{rect:2, name:"Extracurricular"},{rect:3, name:"Recommendation Letter"},{rect:4, name:"Fit"}];



                    var title_width = 150;
                    var rect_height = 2, rect_width=400;

                    var padding_x = 10;
                    var padding_y = 70;

                    var rect = g
                        .selectAll('rect')
                        .data(data1)
                        .enter()
                        .append('g')
                        .classed("bar", true)
                        .attr("id", function(d) { return "a" + d.rect.toString();})
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
                        .attr("width", rect_width)
                        .attr("fill", "#C0C0C0")
                        .attr('y', function(d, i){
                            if(i == 0)
                                return (d.rect + 1) * padding_y - r;
                            else
                                return (d.rect + 1) * padding_y;
                        })
                        .attr("height", function(d, i){
                            if(i == 0)
                                return r * 2;
                            return rect_height;
                        })
                        .attr("rx", function(d, i){
                            if(i == 0)
                                return r;
                            return 0;
                        })
                        .attr("ry", function(d, i){
                            if(i == 0)
                                return r;
                            return 0;
                        })
                    ;



                    var color = new Array("green", "blue", "orange", "BlueViolet", "brown", "Chartreuse", "Cyan");
                    var criteria_num = <?php echo $criteria_num+1?>, candid_num = <?php echo $candidate_num?>, voter_num = <?php echo $user_num;?>;


                    var data2 = eval('(' + str + ')');


                    var circle = g
                        .selectAll("circle")
                        .data(data2)
                        .enter()
                        .append("g")
                        .classed("handler", true)
                        .attr("id", function(d) {return "a" + d.id.toString(); });

                    circle
                        .append("circle")
                        .attr("r", r)
                        .attr("cx", function(d) { return d.x = title_width + padding_x + rect_width / 10 * d.score; })
                        .attr("cy", function(d) { return d.y = padding_y * (d.row + 1); })
                        .attr("fill", function(d) {return color[d.col - 1];});




                    circle
                        .append("text")
                        .attr("x", function(d){return title_width + padding_x + rect_width / 10 * d.score;})
                        .attr("y", function(d){return padding_y * (d.row + 1) - 9;})
                        .text('');

                    var path_max_length = 75;
                    circle
                        .append("path")
                        .attr("class", "middle-path")
                        .attr("d", function(d){
                            var x = title_width + padding_x + rect_width / 10 * d.score;
                            var y = padding_y * (d.row + 1);
                            return "M " + x.toString() + " " + (y - d.conflict/2 * path_max_length).toString() +
                                "L " + x.toString() + " " + (y + d.conflict/2 * path_max_length).toString();
                        })
                        .attr("stroke", "Crimson")
                        .attr("stroke-width", "2")
                    ;



                    circle
                        .append("path")
                        .attr("class", "upper-path")
                        .attr("d", function(d){
                            var x = title_width + padding_x + rect_width / 10 * d.score;
                            var y = padding_y * (d.row + 1) - d.conflict/2 * path_max_length;
                            return "M " + (x - r/2).toString() + " " + y.toString() +
                                "L " + (x + r/2).toString() + " " + y.toString();
                        })
                        .attr("stroke", "Crimson")
                        .attr("stroke-width", "2");


                    circle
                        .append("path")
                        .attr("class", "lower-path")
                        .attr("d", function(d){
                            var x = title_width + padding_x + rect_width / 10 * d.score;
                            var y = padding_y * (d.row + 1) + d.conflict/2 * path_max_length;
                            return "M " + (x - r/2).toString() + " " + y.toString() +
                                "L " + (x + r/2).toString() + " " + y.toString();
                        })
                        .attr("stroke", "Crimson")
                        .attr("stroke-width", "2");
                    circle
                        .append("circle")
                        .attr("class", "middle-dot")
                        .attr("cx", function(d){ return d.x;})
                        .attr("cy", function(d){ return d.y;})
                        .attr("r", 2)
                        .attr("fill", "Crimson");

                    var defs = svg.append("defs");

                    var filter = defs.append("filter")
                        .attr("id", "drop-shadow")
                        .attr("height", "130%");

                    filter.append("feGaussianBlur")
                        .attr("in", "SourceAlpha")
                        .attr("stdDeviation", 0.9)
                        .attr("result", "blur");

                    filter.append("feOffset")
                        .attr("in", "blur")
                        .attr("dx", 1)
                        .attr("dy", 1)
                        .attr("result", "offsetBlur");

                    var feMerge = filter.append("feMerge");

                    feMerge.append("feMergeNode")
                        .attr("in", "offsetBlur")
                    feMerge.append("feMergeNode")
                        .attr("in", "SourceGraphic");

                    var voter = score;

                    var voter_info = <?php echo $str;?>


                    var refNode = d3.select("#a01").node();
//revote panel part
                    circle.on("click", function(d){
                        this.parentNode.insertBefore(this, refNode);
                        refNode = this;

                        if (d3.event.defaultPrevented) return;

                        d3.selectAll(".bar").classed("faded", true);
                        d3.selectAll(".handler").classed("faded", true);
                        var a = d.id[0], b = d.id[1], id ="#a" + a.toString();
                        d3.select(id).classed("faded", false);

                        var score_bar = new Array(0, 0, 0, 0);
                        for(var i = 1; i <= voter_num; i++)
                        {
                            score_bar[i] = voter[a][b][i];
                        }

                        var voter_circle =
                                g
                                    .append("g")
                                    .classed("voter_panel", true)
                                    .selectAll("circle")
                                    .data(voter_info)
                                    .enter()
                                    .append("g")
                                    .classed("voter_dot", true)
                                    .attr("id", function(d) {
                                        return "b" + a.toString() + b.toString() + d.code.toString(); })
                                    .attr("x", function(d, i){
                                        d.x = title_width + padding_x + rect_width / 10 * score_bar[i + 1];
                                        return d.x;
                                    })
                                    .attr("y", function(){
                                        d.y = padding_y * (+a + 1);
                                        return d.y;
                                    })

                            ;

//enable drag


                        var drag = d3.behavior.drag()
                            .origin(Object)
                            .on("dragstart", dragStart)
                            .on("drag", dragMove)
                            .on('dragend', dragEnd);


                        var voter_who = <?php echo $_GET['user_id'];?>;
                        var str = "#b" + a.toString() + b.toString() + voter_who.toString();


//let the red dot on top

                        d3.select(".voter_panel").node().appendChild(d3.select(str).node());



                        voter_circle
                            .append("circle")
                            .attr("r", 10)
                            .attr("cx", function(d, i) {
                                return d.x = title_width + padding_x + rect_width / 10 * score_bar[i + 1]; })
                            .attr("cy", function(d, i) { return d.y = padding_y * (+a + 1); })
                            .attr("fill", color[+b - 1])
                            .attr("opacity", 0.5)
                        ;
                        var refNode1_id = str[0] + str[1] + str[2] + str[3] + "1";
                        var refNode1 = d3.select(refNode1_id).node().parentNode.firstChild;
                        d3.selectAll(".voter_dot")
                            .on("mouseover", function(d){

                                if(this.id[3] == str[4]){
                                    d3.select(this).select("circle")
                                        .attr("stroke-width", "2px")
                                        .attr("stroke", function(d){
                                            return color[+b-1];
                                        })
                                        .attr("opacity", 1);
                                }
                            })
                            .on("mouseout", function(d){

                                this.parentNode.insertBefore(this, refNode1);
                                refNode1 = this;
                                if(this.id[3] == str[4]){

                                    d3.select(this).select("circle")
                                        .attr("stroke-width", 0)
                                        .attr("opacity", 0.5)
                                    ;}
                            })
                        ;

                        var drag1 = d3.behavior.drag()
                            .origin(Object)
                            .on("dragstart", function(d){
                                d3.select(this)
                                    .append("svg:image")
                                    .attr('x',function(d){ return d.x + 5;})
                                    .attr('y',function(d){ return d.y + 5;})
                                    .attr('width', 20)
                                    .attr('height', 24)
                                    .attr("xlink:href","forbidden-sign.png");
                            })
                            .on('dragend', function(d){
                                d3.select(this).select("image").remove();
                            });

                        d3.selectAll(".voter_dot").each(function(d){
                            if(this.id!= str)
                                d3.select(this).call(drag1);
                        });


                        if(str[2] != 0){
                            d3.select(str).call(drag);
                            // d3.selectAll(str).select("circle")
                            // .attr("stroke", color[+b - 1]).attr("stroke-width", "2");
                            d3.select(".voter_panel")
                                .append("circle")
                                .attr("r", 2)
                                .attr("cx", function(d, i) {
                                    return d3.select(str).select("circle").attr("cx"); })
                                .attr("cy", function(d, i) {
                                    return d3.select(str).select("circle").attr("cy"); })
                                .attr("fill", "black")
                                .attr("id", "voter_original_vote");
                        }


//ballon
                        voter_circle
                            .append("path")
                            .attr("class", "float_path")
                            .attr("d", function(d) {
                                return "M " + d.x.toString() + " " + d.y.toString() + "L " + d.x.toString() + " " + d.y.toString();
                            })
                            .attr("stroke", "grey")
                            .attr("stroke-width", "2")
                            .attr("opacity", 0.6)
                        ;
//text: voter_name

                        voter_circle
                            .append("text")
                            .attr("class", "voter_name")
                            .text(function(d) {return d.name;})
                            .style("text-anchor", "end")
                            .attr("transform", function(d, i){
                                d.x = title_width + padding_x + rect_width / 10 * score_bar[i + 1];
                                d.y = padding_y * (+a + 1);
                                return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                            })
                        ;
//text: voter_score
                        voter_circle
                            .append("text")
                            .attr("class", "voter_score")
                            .text("")
                            .attr("x", function(d) { return d.x;})
                            .attr("y", function(d) { return d.y - 10;})
                            .style("text-anchor", "middle")
                            .style("font-size", "14px")
                            .text('')
                        ;
//button1
                        var button1 = d3.select(".voter_panel")
                            .append("g")
                            .attr("id", "r1");


                        button1
                            .append("rect")
                            .attr("height", 20)
                            .attr("width", 50)
                            .attr("stroke-width", 1)
                            .attr("stroke", "grey")
                            .attr("fill", "grey")
                            .style("filter", "url(#drop-shadow)")
                            .style("border-radius", "100px")
                            .attr("x", function(d){ return title_width + padding_x + rect_width + padding_x + 60 + 5;})
                            .attr("y", function(d) {return padding_y * (+a + 1) - 10;})
                            .attr("rx", "3px")
                            .attr("ry", "3px")
                        ;

                        button1
                            .append("text")
                            .attr("x", function(d){ return title_width + padding_x + rect_width + padding_x + 60 + 25 + 5;})
                            .attr("y", function(d) {return padding_y * (+a + 1) + 6;})
                            .text("Confirm")
                            .style("text-anchor", "middle")
                            .style("font-family", "Sans-serif")
                            .style("fill", "white")
                            .style("font-size", "15px")
                            .on("mousedown", recover1)
                            .on("mouseover", function(d){
                                d3.select(this).style("fill", "grey");
                                d3.select("#r1").select("rect").attr("fill", "white");
                            })
                            .on("mouseout", function(d){
                                d3.select(this).style("fill", "white");
                                d3.select("#r1").select("rect").attr("fill", "grey");

                            })
                        ;
// //button2
//                         var button2 = d3.select(".voter_panel")
//                             .append("g")
//                             .attr("id", "r2")
//                             .attr("class", "button2")
//                             .style("visibility", "hidden")
//                             ;

//                         button2
//                             .append("rect")
//                             .attr("height", 20)
//                             .attr("width", 50)
//                             .attr("stroke-width", 1)
//                             .attr("stroke", "grey")
//                             .attr("fill", "grey")
//                             .style("filter", "url(#drop-shadow)")
//                             .style("border-radius", "100px")
//                             .attr("x", function(d){ return title_width + padding_x + rect_width + padding_x;})
//                             .attr("y", function(d) {return padding_y * (+a + 1)-10;})
//                             .attr("rx", "3px")
//                             .attr("ry", "3px")
//                         ;

//                         button2
//                             .append("text")
//                             .attr("x", function(d){ return title_width + padding_x + rect_width + padding_x + 25;})
//                             .attr("y", function(d) {return padding_y * (+a + 1) + 6;})
//                             .text("Undo")
//                             .style("text-anchor", "middle")
//                             .style("font-family", "Sans-serif")
//                             .style("fill", "white")
//                             .style("font-size", "15px")
//                             .on("mousedown", Undo)
//                             .on("mouseover", function(d){
//                                 d3.select(this).style("fill", "grey");
//                                 d3.select("#r2").select("rect").attr("fill", "white");
//                             })
//                             .on("mouseout", function(d){
//                                 d3.select(this).style("fill", "white");
//                                 d3.select("#r2").select("rect").attr("fill", "grey");

//                             })
//                         ;


                        var button3 = d3.select(".voter_panel")
                            .append("g")
                            .attr("id", "r3");


                        button3
                            .append("rect")
                            .attr("height", 20)
                            .attr("width", 50)
                            .attr("stroke-width", 1)
                            .attr("stroke", "grey")
                            .attr("fill", "grey")
                            .style("filter", "url(#drop-shadow)")
                            .style("border-radius", "100px")
                            .attr("x", function(d){ return title_width + padding_x + rect_width + padding_x + 5;})
                            .attr("y", function(d) {return padding_y * (+a + 1) - 10;})
                            .attr("rx", "3px")
                            .attr("ry", "3px")
                        ;

                        button3
                            .append("text")
                            .attr("x", function(d){ return title_width + padding_x + rect_width + padding_x + 25 + 5;})
                            .attr("y", function(d) {return padding_y * (+a + 1) + 6;})
                            .text("Cancel")
                            .style("text-anchor", "middle")
                            .style("font-family", "Sans-serif")
                            .style("fill", "white")
                            .style("font-size", "15px")
                            .on("mousedown", function(d){
                                Undo();
                                recover1();

                            })
                            .on("mouseover", function(d){
                                d3.select(this).style("fill", "grey");
                                d3.select("#r3").select("rect").attr("fill", "white");
                            })
                            .on("mouseout", function(d){
                                d3.select(this).style("fill", "white");
                                d3.select("#r3").select("rect").attr("fill", "grey");

                            })
                        ;


                        function Undo(){
                            if(window.obj == null) return;

                            var x1 = parseInt(d3.select("#voter_original_vote").attr("cx"));
                            var y1 = parseInt(d3.select("#voter_original_vote").attr("cy"));
                            window.obj.x = x1;
                            window.obj.y = y1;

                            var d = window.obj;
                            d3.select(str).select("circle").attr("cx", d.x).attr("opacity", 1);

                            d3.select(str)
                                .select(".voter_name")
                                .attr("transform", function(d){
                                    return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";

                                });
                            d3.select(str)
                                .select(".voter_score")
                                .attr("x", function(d) { return d.x;})
                                .attr("y", function(d) { return d.y - 10;})
                                .text("");

                            d3.select(str)
                                .select(".float_path")
                                .attr("d", function(d){
                                    return "M" + d.x.toString() + " " + d.y.toString() + "L " + d.x.toString() + " " + d.y.toString();
                                });

                            var voter_id = d3.select(str).attr("id");
                            var score_num = d3.round((d.x - title_width - padding_x) /rect_width * 10, 10);

                            score[voter_id[1]][voter_id[2]][voter_id[3]] = score_num;
                            calculateAvg();
                            calculateConflict();

                            var conflict_level = conflict[voter_id[1]][voter_id[2]];
                            var overall_score = overall[voter_id[1]][voter_id[2]];
                            var x = title_width + padding_x + overall_score * rect_width / 10;


                            var candid_id = "#a" + voter_id[1].toString() + voter_id[2].toString();


                            d3.select(candid_id).select("circle").attr("cx", x);

                            d3.select(candid_id).select(".lower-path")
                                .attr("d", function(d){
                                    var y = padding_y * (d.row + 1) + conflict_level/2 * path_max_length;
                                    return "M " + (x - r/2).toString() + " " + y.toString() +
                                        "L " + (x + r/2).toString() + " " + y.toString();
                                });

                            d3.select(str)
                                .select(".float_path")
                                .attr("d", function(d){
                                    return "M" + d.x.toString() + " " + d.y.toString() + "L " + d.x.toString() + " " + d.y.toString();
                                });

                            d3.select(candid_id).select(".upper-path")
                                .attr("d", function(d){
                                    var y = padding_y * (d.row + 1) - conflict_level/2 * path_max_length;
                                    return "M " + (x - r/2).toString() + " " + y.toString() +
                                        "L " + (x + r/2).toString() + " " + y.toString();
                                });

                            d3.select(candid_id).select(".middle-path")
                                .attr("d", function(d){
                                    var y = padding_y * (d.row + 1);
                                    return "M " + x.toString() + " " + (y - conflict_level/2 * path_max_length).toString() +
                                        "L " + x.toString() + " " + (y + conflict_level/2 * path_max_length).toString();
                                });



                            save();
                        }

                        d3.selectAll(".legend").attr("opacity", function(d, i){
                            if((i+1)!=b)
                                return 0.07;
                            return 1;
                        });


                        d3.selectAll(".checkbox").style("visibility", "hidden");


                    });

                    function recover1(){
                        d3.select(".voter_panel").select("rect").style("filter", undefined);
                        d3.selectAll(".bar").classed("faded", false);
                        d3.selectAll(".handler").classed("faded", false);
                        d3.selectAll(".voter_panel").remove();
                        d3.selectAll(".legend").attr("opacity", 1);
                        d3.selectAll(".checkbox").style("visibility", "visible");

                    }




                    var float_height = 15;



                    function dragStart(d){
                        d3.select(".button2").style("visibility", "visible");


                        //for cancel button
                        objecta = d;

                        d3.event.sourceEvent.preventDefault();
                        d3.select(this)
                            .select("circle")
                            .attr("opacity", 0.2)
                            .attr("cy", d.y - float_height);

                        d3.select(this)
                            .select(".float_path")
                            .attr("d", function(d) {
                                return "M" + d.x.toString() + " " + (d.y - 15 + r).toString() + "L " + d.x.toString() + " " + d.y.toString();
                            });

                        d3.select(this)
                            .select(".voter_score")
                            .text(function(d){
                                var x = d3.round((d.x - title_width - padding_x)/rect_width * 10, 1);
                                x = Math.min(x, 10);
                                x = Math.max(0, x);
                                return x;

                            });

                    }

                    function dragMove(d) {
                        d3.select(this)
                            .select("circle")
                            .attr("opacity", 0.4)
                            .attr("cx", d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x)))
                            .attr("cy", d.y - 15)
                        ;

                        d3.select(this)
                            .select(".float_path")
                            .attr("d", function(d) {
                                return "M" + d.x.toString() + " " + (d.y - 15 + r).toString() + "L " + d.x.toString() + " " + d.y.toString();
                            });

                        d3.select(this)
                            .select(".voter_name")
                            .attr("transform", function(d){
                                d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x));
                                return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                            })
                            .text(function(d) {return d.name;});

                        d3.select(this)
                            .select(".voter_score")
                            .text(function(d){
                                var x = d3.round((d3.event.x - title_width - padding_x)/rect_width * 10, 1);
                                x = Math.min(x, 10);
                                x = Math.max(0, x);
                                return x;

                            })
                            .attr("x", Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x)) );

                    }
                    window.obj = null;
                    function dragEnd(d) {
                        window.obj = d;
                        d3.select(this).select("circle").attr("cy", d.y).attr("opacity", 0.5);

                        d3.select(this)
                            .select(".voter_name")
                            .attr("transform", function(d){
                                return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";

                            });
                        d3.select(this)
                            .select(".voter_score")
                            .text("");

                        d3.select(this)
                            .select(".float_path")
                            .attr("d", function(d){
                                return "M" + d.x.toString() + " " + d.y.toString() + "L " + d.x.toString() + " " + d.y.toString();
                            });

                        var voter_id = d3.select(this).attr("id");
                        var score_num = d3.round((d.x - title_width - padding_x) /rect_width * 10, 10);

                        score[voter_id[1]][voter_id[2]][voter_id[3]] = score_num;
                        calculateAvg();
                        calculateConflict();

                        var conflict_level = conflict[voter_id[1]][voter_id[2]];
                        var overall_score = overall[voter_id[1]][voter_id[2]];
                        var x = title_width + padding_x + overall_score * rect_width / 10;


                        var candid_id = "#a" + voter_id[1].toString() + voter_id[2].toString();



                        d3.select(candid_id).select(".lower-path")
                            .attr("d", function(d){
                                var y = padding_y * (d.row + 1) + conflict_level/2 * path_max_length;
                                return "M " + (x - r/2).toString() + " " + y.toString() +
                                    "L " + (x + r/2).toString() + " " + y.toString();
                            });

                        d3.select(this)
                            .select(".float_path")
                            .attr("d", function(d){
                                return "M" + d.x.toString() + " " + d.y.toString() + "L " + d.x.toString() + " " + d.y.toString();
                            });

                        d3.select(candid_id).select(".upper-path")
                            .attr("d", function(d){
                                var y = padding_y * (d.row + 1) - conflict_level/2 * path_max_length;
                                return "M " + (x - r/2).toString() + " " + y.toString() +
                                    "L " + (x + r/2).toString() + " " + y.toString();
                            });

                        d3.select(candid_id).select(".middle-path")
                            .attr("d", function(d){
                                var y = padding_y * (d.row + 1);
                                return "M " + x.toString() + " " + (y - conflict_level/2 * path_max_length).toString() +
                                    "L " + x.toString() + " " + (y + conflict_level/2 * path_max_length).toString();
                            });

                        d3.select(candid_id).selectAll("circle")
                            .attr("cx", x);
                        save();

                    }


                    var drag1 = d3.behavior.drag()
                        .origin(Object)
                        .on("dragstart", function(d){
                            d3.event.sourceEvent.preventDefault();


                            d3.select(this)
                                .append("svg:image")
                                .attr('x',function(d){ return d.x + 5;})
                                .attr('y',function(d){ return d.y + 5;})
                                .attr('width', 20)
                                .attr('height', 24)
                                .attr("xlink:href","forbidden-sign.png")
                                .attr("opacity", 0);

                        })
                        .on("drag", function(d){
                            d3.select(this).select("image")
                                .attr("opacity", 1);
                        })
                        .on('dragend', function(d){
                            d3.select(this).select("image").remove();
                        });

                    d3.selectAll(".handler").call(drag1);

                    d3.selectAll(".handler")
                        .on("mouseover", function(d){

                            d3.select(this).select("circle")
                                .attr("stroke-width", "2px")
                                .attr("stroke", function(d){
                                    return color[this.parentNode.id[2]-1];
                                });
                            d3.select(this).append("text")
                                .text("Click to see detail")
                                .attr("x", function(d){
                                    return d.x + 15;
                                })
                                .attr("y", function(d){
                                    return d.y - 20;
                                });

                            d3.select(this).append("text")
                                .text(function(d){
                                    return candid[d.col-1].candid;})
                                .style("text-anchor", "end")
                                .attr("transform", function(d, i){
                                    return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                                });
                        })
                        .on("mouseout", function(d){
                            this.parentNode.insertBefore(this, refNode);
                            refNode = this;

                            d3.select(this).select("circle")
                                .attr("stroke-width", 0);
                            d3.select(this).selectAll("text").remove();
                        })
                    ;




                    /* legend */
                    var candid = [{candid: "Sam"}, {candid: "Adam"}, {candid: "Jim"}];
                    var legend_height = 15;
                    var legend_padding = 17;
                    var legend = d3.select('body')
                        .select("#main_panel")
                        .append("g")
                        .selectAll("g")
                        .data(candid)
                        .enter()
                        .append('g')
                        .attr('class', 'legend')
                        .classed("side_panel", true)
                        .attr("x", 0)
                        .attr("y", function(d, i) {return i * legend_height + 0;})
                        .attr("transform", "translate(" + (title_width + rect_width + 200) + "," + 65 + ")");


                    legend.append('circle')
                        .attr('cx', 10)
                        .attr('cy', function(d, i) {
                            return i * legend_height;
                        })
                        .attr("r", 5)
                        .style('fill', function(d, i) { return color[i];})
                        .style('stroke', function(d, i) {return color[i];});

                    legend.append('text')
                        .attr('x', 25)
                        .attr('y', function(d, i) {
                            return i * legend_height + 5;})
                        .text(function(d) { return d.candid; });

                    legend
                        .append("image")
                        .attr('x',function(d){ return -21;})
                        .attr('y',function(d){ return candid_num * legend_height + legend_padding * 4 ;})
                        .attr('width', 20)
                        .attr('height', 50)
                        .attr("xlink:href","score_variance.png");

                    legend
                        .append("text")
                        .attr("x", 0)
                        .attr("y", function(d, i){ return candid_num * legend_height + legend_padding * 4 + 30;})
                        .text("Score variance");
                    /* checkbox */
                    var check_box = d3
                        .select("body")
                        .select("#right_side_div")
                        .append("div")
                        .selectAll("div")
                        .data(d3.range(0, candid_num))
                        .enter()
                        .append("div")
                        .classed("side_panel", true)
                        .style("position", "absolute")
                        .style("left", 1032 +"px")
                        .style("top", function(d, i) {
                            return  (168 +  legend_height * i).toString() + "px";})
                        .append('input')
                        .attr("type", "checkbox")
                        .property("checked", true)
                        .classed("checkbox", true)

                        .attr("id", function(d, i) { return "c" + (i + 1).toString()})
                        ;



//axis
                    var xScale = d3.scale.linear().domain([0, 10]).range([title_width + padding_x, title_width + padding_x + rect_width]);

                    var xAxis = d3.svg.axis()
                        .scale(xScale)
                        //            .innerTickSize([8])
                        .outerTickSize([3])
                        //               .tickSize([6, 100])
                        .tickPadding([5])
                        .orient("bottom")
                        .ticks(11)
                    //     .tickValues([" "," "," "," "," "," "," "," "," "," "," "])
                        ;

                    d3.selectAll(".bar").append("g")
                        .attr("transform", function(d, i){
                            var y = (i + 1) * padding_y;
                            return "translate(" + 0 + "," + y + ")"

                        })
                        .classed("axis",true).call(xAxis).style("visibility", "hidden");

                    check_box.on("click", function(d){

                        var id = new Array(0, 0, 0, 0);
                        var candid = d3.select(this).node();
                        for(var i = 0; i < 4; i++)
                        {
                            id[i] = "#a" + i + candid.id[1];
                            if(this.checked == true) {
                                d3.select(id[i]).style("visibility", "visible");
                            }
                            else {
                                d3.select(id[i]).style("visibility", "hidden");
                            }

                        }




                    });

                    var check_box1 = d3
                        .select("body")
                        .append("div")
                        .classed("checkbox1", true)
                        .classed("side_panel", true)
                        .style("position", "absolute")
                        .style("left", (1031).toString() + "px")
                        .style("top", function() { return (200 + legend_height * candidate_num).toString() + "px";})
                        .append('input')
                        .attr('type','checkbox')
                        .property("checked", false);

                    d3.select(".checkbox1")
                        .append("text")
                        .text("Scale");

                    check_box1.on("click", function(d){

                        if(this.checked == true){
                            d3.selectAll(".axis").style("visibility", "visible");
                        }
                        else{
                            d3.selectAll(".axis").style("visibility", "hidden");
                        }
                    });



//indivudial page hover

                    var left_padding_x = 140;
                    var left_padding_y = 20;
                    var svg1 = d3.select("body")
                        .select("#left_side_panel")
                        .attr("width", 300)
                        .attr("height", height);
                    svg1
                        .append("text")
                        .text("Voters")
                        .attr("transform", "translate(" + left_padding_x + ", 50)");
                    var voter_list_all =
                        svg1
                            .append("g")
                            .attr("id", "v0");

                    voter_list_all
                        .append("rect")
                        .attr("x", left_padding_x)
                        .attr("y", function(d, i){
                            return 63;
                        })
                        .attr("height", 20)
                        .attr("width", 50)
                        .attr("stroke-width", 1)
                        .attr("stroke", "grey")
                        .attr("fill", "grey")
                        .style("filter", "url(#drop-shadow)")
                        .style("border-radius", "100px")
                    ;

                    voter_list_all
                        .append("text")
                        .attr("x", function(d){ return  left_padding_x + 25;})
                        .attr("y", function(d, i) {
                            return 78;
                        })
                        .text(function(d){
                            return "ALL";
                        })
                        .style("text-anchor", "middle")
                        .style("font-family", "Sans-serif")
                        .style("fill", "White")
                        .style("font-size", "15px");

                    var voter_list =
                            svg1
                                .append("g")
                                .selectAll("rect")
                                .data(voter_info)
                                .enter()
                                .append("g")
                                .attr("id", function(d, i){
                                    return "v" + (i + 1).toString();
                                })
                        ;
                    voter_list
                        .append("rect")
                        .attr("x", left_padding_x)
                        .attr("y", function(d, i){
                            return 63 + left_padding_y * (i + 1);
                        })
                        .attr("height", left_padding_y)
                        .attr("width", 50)
                        .attr("stroke-width", 1)
                        .attr("stroke", "grey")
                        .attr("fill", "white")
                        .style("filter", "url(#drop-shadow)")
                        .style("border-radius", "100px")
                    ;
                    voter_list
                        .append("text")
                        .attr("x", function(d){ return  left_padding_x + 25;})
                        .attr("y", function(d, i) {
                            return 78 + left_padding_y * (i + 1);
                        })
                        .text(function(d){
                            return d.name;
                        })
                        .style("text-anchor", "middle")
                        .style("font-family", "Sans-serif")
                        .style("fill", "grey")
                        .style("font-size", "15px")
                        .on("mouseover", function(d){
                            d3.select(this).style("fill", "white");
                            var id = "#v" + d.code.toString();
                            d3.selectAll(id).select("rect").style("fill", "grey");

                            d3.select("#v0").select("rect").style("fill", "white");
                            d3.select("#v0").select("text").style("fill", "grey");

                            d3.selectAll(".handler").style("visibility", "hidden");
                            for(var i = 0; i < criteria_num; i++)
                                for(var j = 1; j <= candidate_num; j++)
                                {
                                    g.
                                        append("circle")
                                        .attr("class", "indivudial_vote")
                                        .attr("id", "v" + i.toString() + j.toString())
                                        .attr("r", r)
                                        .attr("cx", function(){
                                            return title_width + padding_x + rect_width / 10 * (score[i][j][d.code]);
                                        })
                                        .attr("cy", padding_y * (i + 1))
                                        .attr("fill", function(d) {return color[j - 1];});

                                }
                        })
                        .on("mouseout", function(d){
                            d3.selectAll(".indivudial_vote").remove();

                            d3.select(this).style("fill", "grey");
                            var id = "#v" + d.code.toString();
                            d3.selectAll(id).select("rect").style("fill", "White");

                            d3.select("#v0").select("rect").style("fill", "grey");
                            d3.select("#v0").select("text").style("fill", "white");

                            d3.selectAll(".handler").style("visibility", "visible");

                        })
                    ;









//end of sijia's part



                }




                for(var m = 0; m <<?php echo $criteria_num +1;?>; m++ ){
                    for(var n = 0; n <<?php echo $candidate_num +1;?>; n++){
                        for (var q = 1; q <= <?php echo $user_num;?>; q++){



                            if(score2[m][n][q] == score[m][n][q]){

                            }else {
                                calculateAvg();
                                calculateConflict();
                                oneChanged(m, n, q);

                            }

                            score2[m][n][q] = score[m][n][q];
                        }

                    }
                }







                function oneChanged(criteria_id, candidate_id, user_id){

                    var title_width = 150;
                    var rect_width=400;
                    var r = 10;


                    var padding_x = 10, padding_y = 70;
                    var path_max_length = 75;


                    var id1 = "#a" + criteria_id.toString() + candidate_id.toString();
                    var score1 = overall[criteria_id][candidate_id];




                    d3.select(id1).select("circle")
                        .attr("cx", function(d) {return d.x = title_width + padding_x + rect_width / 10 * score1; })

                    var id2 = "#a0" + candidate_id.toString();
                    var score2 = overall[0][candidate_id];


                    d3.select(id2).select("circle")
                        .attr("cx", function(d) { return d.x = title_width + padding_x + rect_width / 10 * score2; })


                    var id3 = "#b" + user_id.toString();
                    var score3 = score[criteria_id][candidate_id][user_id];

                    d3.select(id3).select("circle")
                        .attr("cx", function(d) { return d.x = title_width + padding_x + rect_width / 10 * score3; })
                    d3.select(id3).select("text")
                        .attr("transform", function(d, i){
                            d.x = title_width + padding_x + rect_width / 10 * score3;
                            d.y = padding_y * (criteria_id + 1);
                            return "translate(" + d.x + "," + d.y + ") rotate(-40)";
                        })

//              change  conflict


                    var conflict_level = conflict[criteria_id][candidate_id];
                    var overall_score = overall[criteria_id][candidate_id];
                    var x = title_width + padding_x + overall_score * rect_width / 10;


                    var candid_id = "#a" + criteria_id.toString() + candidate_id.toString();


                    d3.select(candid_id).select(".lower-path")
                        .attr("d", function(d){
                            var y = padding_y * (d.row + 1) + conflict_level/2 * path_max_length;
                            return "M " + (x - r/2).toString() + " " + y.toString() +
                                "L " + (x + r/2).toString() + " " + y.toString();
                        });

                    d3.select(candid_id).select(".upper-path")
                        .attr("d", function(d){
                            var y = padding_y * (d.row + 1) - conflict_level/2 * path_max_length;
                            return "M " + (x - r/2).toString() + " " + y.toString() +
                                "L " + (x + r/2).toString() + " " + y.toString();
                        });

                    d3.select(candid_id).select(".middle-path")
                        .attr("d", function(d){
                            var y = padding_y * (d.row + 1);
                            return "M " + x.toString() + " " + (y - conflict_level/2 * path_max_length).toString() +
                                "L " + x.toString() + " " + (y + conflict_level/2 * path_max_length).toString();
                        });

                    d3.select(candid_id).select(".middle-dot")
                        .attr("cx", x);


                }


//sijia's part ********************************************************************************************************





                console.log("requested");

            }



        },
        xmlhttp.open("GET","overall_data.php?decision_id=<?php echo $_GET['decision_id']?>",true);
        xmlhttp.send();







    }





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





</script>



</body>
<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>

</html>






