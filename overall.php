<?php
session_start();
require_once "dbaccess.php";
?>

<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>
<html lang="en">
<head>
<link href="style.css" rel="stylesheet">
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
    overall = new Array();
    for(var k=0;k<4;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        overall[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<5;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；

            overall[k][j]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
        }
    }

</script>

<script>
    conflict = new Array();
    for(var k=0;k<4;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        conflict[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<5;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；

            conflict[k][j]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
        }
    }

</script>


<script>
    score = new Array();
    for(var k=0;k<4;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        score[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<5;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；
            score[k][j]=new Array();

            for(var p = 0; p<3; p++){
                score[k][j][p]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
            }


        }
    }

</script>

<script>
    score2 = new Array();
    for(var k=0;k<4;k++){    //一维长度为i,i为变量，可以根据实际情况改变

        score2[k]=new Array();  //声明二维，每一个一维数组里面的一个元素都是一个数组；

        for(var j=0;j<5;j++){   //一维数组里面每个元素数组可以包含的数量p，p也是一个变量；
            score2[k][j]=new Array();

            for(var p = 0; p<3; p++){
                score2[k][j][p]=0;    //这里将变量初始化，我这边统一初始化为空，后面在用所需的值覆盖里面的值
            }


        }
    }

</script>


<div id="myDiv"><h2>使用 AJAX 修改该文本内容</h2></div>
<button type="button" onclick="loadXMLDoc()">修改内容</button>


<script>


    str1 = "";
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
                document.getElementById("myDiv").innerHTML=xmlhttp.responseText;



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


                    var criteria_id_init = 0;
                    var candidate_id_init = 0;




                    str = "[";


                    for(criteria_id_init = 0; criteria_id_init <= 3; criteria_id_init++){

                        for(candidate_id_init = 1; candidate_id_init <=3; candidate_id_init++){
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

                            if(criteria_id_init ==3 && candidate_id_init ==3){
                                str = str + "}"

                            }else {
                                str = str + "},"
                            }

                        }


                    }



                    str = str + "]";

                }






                if(count == 1){


                    for(var m = 0; m <4; m++ ){
                        for(var n = 0; n <4; n++){
                            for (var q = 1; q <= 3 ; q++){
                                score2[m][n][q] = score[m][n][q];
                            }
                        }
                    }


                    var height = 350, width = 700;
                    var drag = d3.behavior.drag()
                        .origin(Object)
                        .on("dragstart", dragStart)
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
                        .attr('y', function(d){return (d.rect + 1) * padding_y;})
                        .attr("height", rect_height)
                        .attr("width", rect_width)
                        .attr("fill", "#C0C0C0")
                    ;

                    var color = new Array("green", "blue", "yellow", "purple", "orange", "brown", "Chartreuse", "Cyan");
                    var criteria_num = 4, candid_num = 3, voter_num = 3;


                    var data2 = eval('(' + str + ')');



                    var r = 10;
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
                        .attr("opacity", function(d){return d.conflict;})
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
                        .attr("stroke-width", "2")
                        .attr("opacity", function(d){return d.conflict;})



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
                        .attr("stroke-width", "2")
                        .attr("opacity", function(d){return d.conflict;})

                    circle
                        .append("circle")
                        .attr("cx", function(d){ return d.x;})
                        .attr("cy", function(d){ return d.y;})
                        .attr("r", 2)
                        .attr("fill", "Crimson")
                        .attr("opacity", function(d){return d.conflict;});


                    var voter = score;

                    var voter_info = [{code: 1, name: "Ming"}, {code: 2, name: "Jake"}, {code: 3, name: "Steven"}];

                    circle.on("click", function(d){
                        if (d3.event.defaultPrevented) return;

                        d3.selectAll(".bar").classed("hidden", true);
                        d3.selectAll(".handler").classed("hidden", true);
                        var a = d.id[0], b = d.id[1], id ="#a" + a.toString();
                        d3.select(id).classed("hidden", false);

                        var score_bar = new Array(0, 0, 0, 0);
                        for(var i = 1; i <= voter_num; i++)
                        {
                            score_bar[i] = voter[a][b][i];
                        }

                        var voter_circle =
                                g
                                    .append("g")
                                    .selectAll("circle")
                                    .data(voter_info)
                                    .enter()
                                    .append("g")
                                    .classed("voter_dot", true)
                                    .attr("id", function(d) {return "b" + a.toString() + b.toString() + d.code.toString(); })                                    .attr("x", function(d, i){
                                        d.x = title_width + padding_x + rect_width / 10 * score_bar[i + 1];
                                        return d.x;

                                    })
                                    .attr("y", function(){
                                        d.y = padding_y * (+a + 1);
                                        return d.y;
                                    })
                                    .call(drag)
                            ;

                        voter_circle
                            .append("circle")
                            .attr("r", 10)
                            .attr("cx", function(d, i) { return title_width + padding_x + rect_width / 10 * score_bar[i + 1]; })
                            .attr("cy", function(d, i) { return padding_y * (+a + 1); })
                            .attr("fill", "grey");

                        voter_circle
                            .append("text")
                            .text(function(d) {return d.name;})
                            .attr("transform", function(d, i){
                                d.x = title_width + padding_x + rect_width / 10 * score_bar[i + 1];
                                d.y = padding_y * (+a + 1);
                                return "translate(" + d.x + "," + d.y + ") rotate(-40)";
                            })
                        ;
//button
                        voter_circle
                            .append("rect")
                            .attr("x", function(d){ return title_width + padding_x + rect_width + padding_x;})
                            .attr("y", function(d) {return padding_y * (+a + 1)-10;})
                            .attr("height", 20)
                            .attr("width", 56)
                            .attr("fill", "grey")
                        ;

                        voter_circle
                            .append("text")
                            .attr("x", function(d){ return title_width + padding_x + rect_width + padding_x + 3;})
                            .attr("y", function(d) {return padding_y * (+a + 1) + 3;})
                            .text("confirm")
                            .on("click", recover)
                        ;

                    });

                    function recover(){
                        d3.selectAll(".bar").classed("hidden", false);
                        d3.selectAll(".handler").classed("hidden", false);
                        d3.selectAll(".voter_dot").remove();
                    }

                    function dragStart(){
                        d3.event.sourceEvent.preventDefault();
                    }

                    function dragMove(d) {
                        d3.select(this)
                            .select("circle")
                            .attr("opacity", 0.4)
                            .attr("cx", d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x)));
                        d3.select(this)
                            .select("text")
                            .attr("transform", function(d){
                                d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x));
                                return "translate(" + d.x + "," + d.y + ") rotate(-40)";


                            })
                            .text(function(d) {return d.name;});

                    }

                    function dragEnd(d) {

                      
                        var voter_id = d3.select(this).attr("id");
                        d3.select(this)
                            .select('circle')
                            .attr('opacity', 1);
                        var score_num = d3.round((d.x - title_width - padding_x) /rect_width * 10);

                        score[voter_id[1]][voter_id[2]][voter_id[3]] = score_num;
//                        d.conflict = conflict[voter_id[1]][voter_id[2]];
//                        console.log(d.conflict);

                        calculateAvg();
//                        d.conflict = conflict[voter_id[1]][voter_id[2]];
//                        console.log(d.conflict);
                        calculateConflict();
//                        var candid_id = "#a" + voter_id[1].toString() + voter_id[2].toString();
//
//                        d3.select(candid_id).select(".lower-path")
//                            .attr("d", function(d){
//                                var x = d.x;
//                                var y = padding_y * (d.row + 1) + d.conflict/2 * path_max_length;
//                                return "M " + (x - r/2).toString() + " " + y.toString() +
//                                    "L " + (x + r/2).toString() + " " + y.toString();
//                            });
//
//                        d3.select(candid_id).select(".upper-path")
//                            .attr("d", function(d){
//
//                                var x = d.x;
//                                var y = padding_y * (d.row + 1) - d.conflict/2 * path_max_length;
//                                return "M " + (x - r/2).toString() + " " + y.toString() +
//                                    "L " + (x + r/2).toString() + " " + y.toString();
//                            });
//
//
//                        d3.select(candid_id).select(".middle-path")
//                            .attr("d", function(d){
//                                var x = d.x;
//                                var y = padding_y * (d.row + 1);
//                                return "M " + x.toString() + " " + (y - d.conflict/2 * path_max_length).toString() +
//                                    "L " + x.toString() + " " + (y + d.conflict/2 * path_max_length).toString();
//                            });
                        save();
                       
                    }

                    /* legend */
                    var candid = [{candid: "Betsy"}, {candid: "Chris"}, {candid: "Ross"}]
                    var legend_height = 10;
                    var legend = d3.select('body')
                        .append("svg")
                        .style("position", "absolute")
                        .style("top", "80px")
                        .style("left", "700px")
                        .append("g")
                        .selectAll("g")
                        .data(candid)
                        .enter()
                        .append('g')
                        .attr('class', 'legend')
                        .attr("x", 8)
                        .attr("y", function(d, i) {return i * legend_height + 8;})

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

                    /* checkbox */
                    var check_box = d3.
                        select("body")
                        .selectAll("div")
                        .data(d3.range(0, candid_num))
                        .enter()
                        .append("div")
                        .style("position", "absolute")
                        .style("left", width + 50 + "px")
                        .style("top", function(d, i) { return (73 + legend_height * i).toString() + "px";})
                        .append('input')
                        .attr('type','checkbox');





                }




                for(var m = 0; m <4; m++ ){
                    for(var n = 0; n <4; n++){
                        for (var q = 1; q <= 3 ; q++){


                            if(score2[m][n][q] == score[m][n][q]){

                            }else {
                                console.log("&&&&&&&&&&&&&&&&&");
//                                console.log(conflict);
                                calculateAvg();
                                calculateConflict();
                                console.log(conflict);
                                oneChanged(m, n, q);

                            }

                            score2[m][n][q] = score[m][n][q];
                        }

                    }
                }







                function oneChanged(criteria_id, candidate_id, user_id){

                    var title_width = 150;
                    var rect_width=400;

                    var padding_x = 10, padding_y = 70;

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
                }





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

        for(criteria_id = 0; criteria_id<=3; criteria_id++){
            for(candidate_id = 0; candidate_id<=4; candidate_id++){
                var temp = 0.00;
                for(user_id = 1; user_id<=3; user_id++){

                    temp = temp +  parseFloat(score[criteria_id][candidate_id][user_id]);
                }
                temp = temp/3;

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

        for(criteria_id = 0; criteria_id<=3; criteria_id++){
            for(candidate_id = 0; candidate_id<=3; candidate_id++){
                var temp = 0.00;
                data = 0.00;
                avg = 0.00;

                for(user_id = 1; user_id<=3; user_id++){

                    data = parseFloat(score[criteria_id][candidate_id][user_id]);
                    avg = parseFloat(overall[criteria_id][candidate_id]);


                    temp = temp + (data - avg) * (data - avg);


                }
                temp = temp/3;

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

        for(criteria_id = 0; criteria_id<=3; criteria_id++) {
            for (candidate_id = 1; candidate_id <= 3; candidate_id++) {
                if(conflict[criteria_id][candidate_id] > max){
                    max = conflict[criteria_id][candidate_id];
                }
            }
        }

        for(criteria_id = 0; criteria_id<=3; criteria_id++) {
            for (candidate_id = 1; candidate_id <= 3; candidate_id++) {
                conflict[criteria_id][candidate_id] = conflict[criteria_id][candidate_id] / max;
            }
        }

        console.log("max");
        console.log(max);

        console.log(conflict);




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
    
    
</script>



</body>
</html>






