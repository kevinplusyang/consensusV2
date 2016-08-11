<?php
//session_start();
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
    <meta charset="UTF-8">
    <title>Consensus</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>



<style>


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

<?php

$result = mysql_query("select * from participate where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user']."' ");
$row = mysql_fetch_array($result);
$real_user_id = $row['real_user_id'];

$result = mysql_query("select * from user where id = '".$real_user_id."'");
$row = mysql_fetch_array($result);
$user_name = $row['user_name'];


?>

<p style="padding: 10px;">
    <b>Individual Voting page for <?php echo $user_name;?></b><br>
    Rank the Candidates<br>
    Click and drag the colored circles onto the line
    <br><br/>
</p>
<svg id="left_side_panel"></svg>
<svg id="main_panel"></svg>
<div></div>
<div style="width:1000px;float:right;">

    <a href="holdpage_4.php?decision_id=<?php echo $_GET['decision_id']?>&user_id=<?php echo $_GET['user'];?>" class="button button-rounded button-raised" style="margin-left: 750px;  margin-top: 5px; float:left">Next</a>

</div>


<br>




<div style="margin-left: 10px; margin-top: 60px">
    <?php

    $result = mysql_query("select * from participate where decision_id = '".$_GET['decision_id']."' and user_id = '".$_GET['user']."' ");
    $row = mysql_fetch_array($result);
    $real_user_id = $row['real_user_id'];

    $result = mysql_query("select * from user where id = '".$real_user_id."'");
    $row = mysql_fetch_array($result);
    $user_name = $row['user_name'];



    $result = mysql_query("select * from decision where id = '".$_GET['decision_id']."'");
    $row = mysql_fetch_array($result);

    $criteria_num =$row['criteria_num'];
    $candidate_num = $row['candidate_num'];
    $user_num = $row['user_num'];


    ?>
</div>




<?php //echo $_GET['user'];?>


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





                //sijia's part ********************************************************************************************************

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



                if(count == 1)
                {


                    var user_num = <?php echo $user_num?>;

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

                        scores[criteria_id][candidate_id] = score_data;

                    }



                    if(count == 1){

                        calculateTable();


                        var height = 450, width = 1050;

                        var r = 10;



                        var svg = d3.select('body')
                            .select('#main_panel')
                            .attr("height", height)
                            .attr("width", width)
                        //                           .style("margin-left", "300px")
//                            .attr("transform", "translate(100, 0)")
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
                            .attr("transform", "translate(754, 50)");



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


                        rect
                            .append("rect")
                            .attr("x", title_width + padding_x)
                            .attr("y", function(d, i){
                                return (d.rect + 1) * padding_y - padding_y / 2;
                            })
                            .attr("width", rect_width)
                            .attr("height", padding_y)
                            .attr("opacity", 0)
                        ;

                        var color = new Array("green", "blue", "orange", "BlueViolet",  "brown", "Chartreuse", "Cyan");

                        var criteria_id_init = 0;
                        var candidate_id_init = 0;

                        var str = "[";

                        for(criteria_id_init = 0; criteria_id_init <= criteria_num; criteria_id_init++){

                            for(candidate_id_init = 1; candidate_id_init <=candidate_num; candidate_id_init++){
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

                                if(criteria_id_init ==criteria_num && candidate_id_init ==candidate_num){
                                    str = str + "}"

                                }else {
                                    str = str + "},"
                                }

                            }


                        }
                        str = str + "]";





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
                            .attr("cx", function(d) {
                                if(d.score == -1) {
                                    return d.x = 550 + d.col * 30;
                                }else {
                                    return d.x = title_width + padding_x + d.score * rect_width /10;
                                }


                            })
                            .attr("cy", function(d, i) { return d.y = padding_y * (d.row + 1); })
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
                            .attr("class", "voter_score")
                            .attr("x", function(d){

                                if(d.score == -1){
                                    return 550 + d.col * 30;
                                }
                                else{
                                    return title_width + padding_x + d.score * rect_width / 10;
                                }
                            })
                            .attr("y", function(d){return d.y - 10;})
                            .style("text-anchor", "middle")
                            .style("font-size", "14px")
                            .text('');




                        var defs = svg.append("defs");

                        var filter = defs.append("filter")
                            .attr("id", "drop-shadow")
                            .attr("height", "130%");

                        filter.append("feGaussianBlur")
                            .attr("in", "SourceAlpha")
                            .attr("stdDeviation", 1.1)
                            .attr("result", "blur");

                        filter.append("feOffset")
                            .attr("in", "blur")
                            .attr("dx", 0)
                            .attr("dy", 0)
                            .attr("result", "offsetBlur");

                        var feMerge = filter.append("feMerge");

                        feMerge.append("feMergeNode")
                            .attr("in", "offsetBlur")
                        feMerge.append("feMergeNode")
                            .attr("in", "SourceGraphic");

                        circle.selectAll("circle")
                            .style("filter", function(d){
                                if(d.id[0] == 0)
                                    return;

                                return "url(#drop-shadow)"});



                        var float_height = 15;
                        var refNode = d3.select("#a01").node();

//drag behavior
                        var drag = d3.behavior.drag()
                            .origin(Object)
                            .on("dragstart", dragStart)
                            .on("drag", dragMove)
                            .on('dragend', dragEnd);

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
                                    .attr("xlink:href","forbidden-sign.png");
                            })
                            .on('dragend', function(d){
                                d3.select(this).select("image").remove();
                            });

                        d3.selectAll(".handler").each(function(d){
                            if(d.id[0]!=0){
                                d3.select(this).call(drag);
                            }
                            else
                                d3.select(this).call(drag1);
                        })


                        d3.selectAll(".handler").select("circle")
                            .on("mouseover", function(d){
                                if(this.parentNode.id[1] != 0){
                                    d3.select(this)
                                        .attr("stroke-width", "2px")
                                        .attr("stroke", function(d){
                                            return color[this.parentNode.id[2]-1];
                                        });
                                }

                                d3.select(this.parentNode).append("text")
                                    .attr("class", "voter_name")
                                    .text(function(d){
                                        return candid[d.col-1].candid;})
                                    .style("text-anchor", "end")
                                    .attr("transform", function(d, i){
                                        return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                                    });

                            })
                            .on("mouseout", function(d){

                                (this.parentNode).parentNode.insertBefore((this.parentNode), refNode);
                                refNode = this.parentNode;

                                d3.select(this)
                                    .attr("stroke-width", 0);

                                d3.selectAll(".voter_name").remove();

                            })
                        ;

                        d3.selectAll(".bar").on("mouseover", function(d){
                                var row = this.id[1];
                                for(var i = 1; i <= candidate_num; i++){

                                    var circle_id = "#a" + row.toString() + i.toString();
                                    d3.select(circle_id).append("text")
                                        .attr("class", "voter_name")
                                        .text(function(d) {return candid[i-1].candid;})
                                        .style("text-anchor", "end")
                                        .attr("transform", function(d, i){

                                            return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                                        });
                                }

                                //                        console.log(d);
                            })
                            .on("mouseout", function(d){
                                d3.selectAll(".voter_name").remove();
                            });

                        function dragStart(d) {
                            d3.selectAll(".bar").on("mouseover", null);
                            d3.selectAll(".handler").on("mouseover", null);
                            d3.selectAll(".voter_name").remove();



                            d3.event.sourceEvent.preventDefault();

                            this.parentNode.insertBefore(this, refNode);
                            refNode = this;


//                        d3.select(this.parentNode).append(this);

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
                                    x = Math.max(0, x);
                                    if(x > 10) x = "-";
                                    return x;

                                });


//text: voter_name
                            d3.select(this)
                                .append("text")
                                .attr("class", "tmp_name")
                                .text(function(d) {
                                    return candid[d.col - 1].candid;})
                                .style("text-anchor", "end")
                                .attr("transform", function(d, i){
                                    return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                                })
                            ;


                        }


                        function dragMove(d) {

                            d3.select(this)
                                .select("circle")
                                .attr("opacity", 0.4)
                                .attr("cx",
                                    //                          d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x)))
                                    d.x = Math.max(title_width + padding_x, d3.event.x))
                                .attr("cy", d.y - float_height);

                            d3.select(this)
                                .select(".tmp_name")
                                .attr("transform", function(d){
                                    //    d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x));
                                    d.x = Math.max(title_width + padding_x, d3.event.x);

                                    return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                                })
                                .text(function(d) {
                                    return candid[d.col - 1].candid;});

                            d3.select(this)
                                .select(".float_path")
                                .attr("d", function(d) {
                                    return "M" + d.x.toString() + " " + (d.y - 15 + r).toString() + "L " + d.x.toString() + " " + d.y.toString();
                                });

                            d3.select(this)
                                .select(".voter_score")
                                .text(function(d){
                                    var x = d3.round((d3.event.x - title_width - padding_x)/rect_width * 10, 1);
                                    x = Math.max(0, x);
                                    if(x > 10){
                                        x = "-";}
                                    return x;

                                })
                                .attr("x",
                                    Math.max(title_width + padding_x, d3.event.x) );

//                                    Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x)) );


                            var score_num = d3.round((d.x - title_width - padding_x)/rect_width * 10, 10);
                            if(score_num > 10) score_num = 10;
                            scores[d.row][d.col] = score_num;

                            calculateTable();



//                        tableChanged(d.row, d.col, score_num);


                            var overall = scores[0][d.col];
                            var overall_id = "#a0" + d.col.toString();
                            d3.select(overall_id).select("circle").attr("cx", function(d) {
                                d.x = title_width + padding_x + overall * rect_width /10;
                                return d.x;}

                            );


                        }

                        function dragEnd(d) {
                            d3.select(".tmp_name").remove();


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
                            if(score_num > 10) score_num = -1;
                            scores[d.row][d.col] = score_num;

                            for(var i = 1; i <= criteria_num; i++){
                                if(scores[i][d.col] == -1) break;
                            }
                            if(i == criteria_num){
                                calculateTable();
                            }



//                        tableChanged(d.row, d.col, score_num);


                            var overall = scores[0][d.col];
                            var overall_id = "#a0" + d.col.toString();
                            d3.select(overall_id).select("circle").attr("cx", function(d) {
                                d.x = title_width + padding_x + overall * rect_width /10;
                                return d.x;}

                            );


                            save();

//recover bar name
                            d3.selectAll(".bar").on("mouseover", function(d){
                                var row = this.id[1];
                                for(var i = 1; i <= candidate_num; i++){

                                    var circle_id = "#a" + row.toString() + i.toString();
                                    d3.select(circle_id).append("text")
                                        .attr("class", "voter_name")
                                        .text(function(d) {return candid[i-1].candid;})
                                        .style("text-anchor", "end")
                                        .attr("transform", function(d, i){

                                            return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                                        });
                                }

                                //                        console.log(d);
                            });

                            d3.selectAll(".handler").select("circle")
                                .on("mouseover", function(d){
                                    if(this.parentNode.id[1] != 0){
                                        d3.select(this)
                                            .attr("stroke-width", "2px")
                                            .attr("stroke", function(d){
                                                return color[this.parentNode.id[2]-1];
                                            });
                                    }

                                    d3.select(this.parentNode).append("text")
                                        .attr("class", "voter_name")
                                        .text(function(d){
                                            return candid[d.col-1].candid;})
                                        .style("text-anchor", "end")
                                        .attr("transform", function(d, i){
                                            return "translate(" + d.x + "," + (d.y + r + 4) + ") rotate(-40)";
                                        });

                                });

                        }






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
                            .attr("x", 0)
                            .attr("y", function(d, i) {return i * legend_height + 0;})
                            .attr("transform", "translate(" + (title_width + rect_width + 200) + "," + 65 + ")")
                            ;

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

                        /* checkbox */
                        var check_box = d3
                            .select("body")
                            .select("div")
                            .classed("checkbox", true)
                            .style("position", "absolute")
                            .style("left", 1077  + "px")
                            .style("top", function() { return 260 + "px";})
                            .append('input')
                            .attr('type','checkbox')
                            .property("checked", false);

                        d3.select(".checkbox")
                            .append("text")
                            .text("Scale");


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
                        //                 .tickValues([0,null,2,null,4,null,6,null,8,null,10])
                            ;


                        d3.selectAll(".bar").append("g")
                            .attr("transform", function(d, i){
                                var y = (i + 1) * padding_y;
                                return "translate(" + 0 + "," + y + ")"

                            })
                            .classed("axis",true).call(xAxis).style("visibility", "hidden");


                        check_box.on("click", function(d){

                            if(this.checked == true){
                                d3.selectAll(".axis").style("visibility", "visible");
                            }
                            else{
                                d3.selectAll(".axis").style("visibility", "hidden");
                            }
                        })



//sijia's part ********************************************************************************************************




                        for(var m = 1; m <criteria_num+1; m++ ){
                            for(var n = 1; n <candidate_num+1; n++){

                                scores2[m][n] = scores[m][n];
                            }
                        }



                    }






                    for(var m = 1; m <criteria_num+1; m++ ){
                        for(var n = 1; n <candidate_num+1; n++){

                            if(scores2[m][n] == scores[m][n]){

                            }else {
                                calculateTable();
                                oneChanged(m,n);
                            }
                            scores2[m][n] = scores[m][n];
                        }
                    }






                }






                for(var m = 1; m <criteria_num+1; m++ ){
                    for(var n = 1; n <candidate_num+1; n++){

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
            xmlhttp.open("GET","fetch_individual_data_post.php?decision_id=<?php echo $_GET['decision_id']?>&user_id=<?php echo $_GET['user']?>",true);
        xmlhttp.send();







    }





    //    loadXMLDoc();
    var t=setInterval("loadXMLDoc()",500);





</script>



<script>



    function oneChanged(criteria_id, candidate_id){
        var title_width = 150;
        var rect_width=400;
        var padding_x = 10, padding_y = 70;
        var score1 = scores[criteria_id][candidate_id];
        var score2 = scores[0][candidate_id];
        console.log(score2);
        var id1 = "#a" + criteria_id.toString() + candidate_id.toString();
        var id2 = "#a0" + candidate_id.toString();

        d3.select(id1).select("circle")
            .attr("cx", function(d) {
                if(score1 == -1){
                    return d.x = 550 + d.col * 30;
                }
                else{
                    return d.x = title_width + padding_x + rect_width / 10 * score1;
                }

            })

        d3.select(id2).select("circle")
            .attr("cx", function(d) {
                if(score2 == -1){
                    return d.x = 550 + d.col * 30;
                }
                else{
                    return d.x = title_width + padding_x + rect_width / 10 * score2;
                }
            })

    }

    function calculateTable() {

        var i = 0;
        var j = 0;
        var temp = 0.00;
        var flag = 0;

        for(i = 1; i <=candidate_num; i++){
            temp = 0;
            flag = 0;
            for(j = 1; j <=criteria_num; j++){
                temp = temp + parseFloat(scores[j][i]);
                if(scores[j][i]<0){
                    flag = 1;
                }

            }
            if(flag == 1){

            }else {
                scores[0][i] = temp/criteria_num;
            }

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


        for(i = 1; i<=candidate_num; i++){

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
            url: "save_data_post.php?decision_id=<?php echo $_GET['decision_id'];?>&user_id=<?php echo $_GET['user'];?>",
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


<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>

</html>