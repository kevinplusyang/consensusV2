
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
//add feature: score, conflict
    var criteria_num = 4, candid_num = 3, voter_num = 3;


var data2 = [{row: 0, col: 1, score: 1, conflict: 0.2, id:"01"},
    {row:0, col: 2, score: 9, conflict: 0.8, id:"02"},
    {row:0, col: 3, score: 8, conflict: 0.9, id:"03"},

    {row: 1, col: 1, score: 3, conflict: 0.4, id:"11"},
    {row:1, col: 2, score: 7, conflict: 0.8, id:"12"},
    {row:1, col: 3, score: 6, conflict: 0.6, id:"13"},

    {row: 2, col: 1, score: 4, conflict: 0.5, id:"21"},
    {row:2, col: 2, score: 9, conflict: 0.4, id:"22"},
    {row:2, col: 3, score: 1, conflict: 0.9, id:"23"},

    {row: 3, col: 1, score: 2, conflict: 0.4, id:"31"},
    {row:3, col: 2, score: 3, conflict: 0.7, id:"32"},
    {row:3, col: 3, score: 8, conflict: 0.6, id:"33"}
];



//var data2 = eval('(' + temp + ')');



//console.log(data2);

//var data2 = eval('(' + str + ')');
//
//console.log(data2);




//won't call drag
//28 ->> rect_width / 10
    var r = 10;
    var circle = g
        .selectAll("circle")
        .data(data2)
        .enter()
        .append("g")
        .classed("handler", true)
        .attr("id", function(d) {return "a" + d.id.toString(); });
//    .call(drag);
//x changed
    circle
        .append("circle")
        .attr("r", r)
        .attr("cx", function(d) { return d.x = title_width + padding_x + rect_width / 10 * d.score; })
        .attr("cy", function(d) { return d.y = padding_y * (d.row + 1); })
        .attr("fill", function(d) {return color[d.col - 1];});




//x changed
    circle
        .append("text")
        .attr("x", function(d){return title_width + padding_x + rect_width / 10 * d.score;})
        .attr("y", function(d){return padding_y * (d.row + 1) - 9;})
        .text('');

//add path & dot
    var path_max_length = 75;
    circle
        .append("path")
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


    var voter = [
        [[0, 0, 0, 0],[0, 3, 5, 4],[0, 9, 3, 5],[0, 6, 7, 8]],
        [[0, 0, 0, 0],[0, 3, 4, 5],[0, 2, 3, 3],[0, 2, 6, 9]],
        [[0, 0, 0, 0],[0, 6, 4, 3],[0, 2, 5, 6],[0, 2, 4, 9]],
        [[0, 0, 0, 0],[0, 3, 4, 5],[0, 2, 4, 6],[0, 2, 4, 4]],
    ];

    var voter_info = [{code: 1, name: "Sara"}, {code: 2, name: "Tony"}, {code: 3, name: "Jack"}];

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
                    .attr("id", function(d) {return "b" + d.code.toString(); })
                    .attr("x", function(d, i){
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
            .attr("cx", d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d.x)));
        d3.select(this)
            .select("text")
            .attr("transform", function(d){
                d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d.x));
                return "translate(" + d.x + "," + d.y + ") rotate(-40)";


            })
            .text(function(d) {return d.name;});

    }

    function dragEnd() {
        d3.select(this)
            .select('circle')
            .attr('opacity', 1);
        /*
         d3.select(this)
         .select("text")
         .text('');
         */
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




/**
 * Created by kevinyang on 7/14/16.
 */






function oneChanged(criteria_id, candidate_id, user_id){
    var id1 = "#a" + criteria_id.toString() + candidate_id.toString();
    var score1 = overall[criteria_id][candidate_id];
    d3.select(id1)
        .attr("cx", function(d) { return d.x = title_width + padding_x + rect_width / 10 * score1; })

    var id2 = "#a0" + candidate_id.toString();
    var score2 = overall[0][candidate_id];
    d3.select(id2)
        .attr("cx", function(d) { return d.x = title_width + padding_x + rect_width / 10 * score2; })

    var id3 = "#b" + user_id.toString();
    var score3 = score[criteria_id][candidate_id][user_id];
    d3.select(id3)
        .attr("cx", function(d) { return d.x = title_width + padding_x + rect_width / 10 * score3; })
}