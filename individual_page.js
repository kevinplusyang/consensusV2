
var height = 300, width = 700;
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
var rect_height = 5, rect_width=300;
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

// var data2 = [{row: 0, col: 1, score: 1, conflict: 0.2, id:"01"},
//     {row:0, col: 2, score: 9, conflict: 0.8, id:"02"},
//     {row:0, col: 3, score: 8, conflict: 0.9, id:"03"},
//
//     {row: 1, col: 1, score: 3, conflict: 0.4, id:"11"},
//     {row:1, col: 2, score: 7, conflict: 0.8, id:"12"},
//     {row:1, col: 3, score: 6, conflict: 0.6, id:"13"},
//
//     {row: 2, col: 1, score: 4, conflict: 0.5, id:"21"},
//     {row:2, col: 2, score: 9, conflict: 0.4, id:"22"},
//     {row:2, col: 3, score: 1, conflict: 0.9, id:"23"},
//
//     {row: 3, col: 1, score: 2, conflict: 0.4, id:"31"},
//     {row:3, col: 2, score: 3, conflict: 0.7, id:"32"},
//     {row:3, col: 3, score: 8, conflict: 0.6, id:"33"}
// ];



var data2 = eval('(' + str + ')');

console.log(data2);

var circle = g
    .selectAll("circle")
    .data(data2)
    .enter()
    .append("g")
    .classed("handler", true)
    .attr("id", function(d) {console.log(d.id); return "a" + d.id.toString(); })
    .call(drag);

circle
    .append("circle")
    .attr("r", 10)
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





function dragMove(d) {
    d3.select(this)
        .select("circle")
        .attr("opacity", 0.4)
        .attr("cx", d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x)))
    d3.select(this)
        .select("text")
        .text(function(d){
            var x = d3.round((d3.event.x - title_width - padding_x)/30);
            x = Math.min(x, 10);
            x = Math.max(0, x);
            return x;

        })
        .attr("x", d.x = Math.max(title_width + padding_x, Math.min(title_width + padding_x + rect_width, d3.event.x))-4);

}

// function dragEnd(d) {
//     // console.log(d);
//     d3.select(this)
//         .select('circle')
//         .attr('opacity', 1);
//     d3.select(this)
//         .select("text")
//         .text('');
//
//     console.log(d.x );
//
//     var score_num = d3.round((d.x - title_width - padding_x)/30);
//
//
//     scores[d.row][d.col] = score_num;
//
//     console.log(scores);
//     tableChanged(d.row, d.col, score_num);
// }


function dragEnd(d) {
    // console.log(d);
    d3.select(this)
        .select('circle')
        .attr('opacity', 1);
    d3.select(this)
        .select("text")
        .text('');

    console.log(d.x );

    var score_num = d3.round((d.x - title_width - padding_x)/30);
    scores[d.row][d.col] = score_num;
    tableChanged(d.row, d.col, score_num);

    console.log(scores);

    var overall = scores[0][d.col];
    var overall_id = "#a0" + d.col.toString();
    d3.select(overall_id).select("circle").attr("cx", d.x = title_width + padding_x + d.score * rect_width /10);

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


