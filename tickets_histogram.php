<?php

session_start();
$original_city = $_SESSION['departure_city'];
$target_city = $_SESSION['destination_city'];
$t = $_SESSION['departure_time'];

// echo $original_city;
// echo $target_city;
// echo $t;

// echo "QAQAQAQAQ";

unset($out);
$message = exec("/home/momenttrip/.local/bin/python3 /home/momenttrip/public_html/cgi-bin/hello.py 2>&1 $original_city $target_city $t",$out,$res);
// print_r($message);
// print_r(urldecode($out[0]));
// print_r(urldecode($out[1]));
// print_r(urldecode($out[2]));


// $message = exec("/home/momenttrip/.local/bin/python3 /home/momenttrip/public_html/cgi-bin/hello.py 2>&1");

// print_r($message);

?>







<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<head>
    
    <link rel="stylesheet" href=tickets_histogram.css>

    
	<style>

  .bar{
    fill: steelblue;
  }

  .bar:hover{
    fill: brown;
  }

	.axis {
	  font: 10px sans-serif;
	}

	.axis path,
	.axis line {
	  fill: none;
	  stroke: #000;
	  shape-rendering: crispEdges;
	}



.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
}

/* Creates a small triangle extender for the tooltip */
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 10px;
  width: 80%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
}	</style>
</head>

<body>

<script src="http://d3js.org/d3.v3.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js
"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>



<script type="text/javascript">
    function mapFunc(){
        window.location.href = 'map.php';
    }
    function ticket(){
        window.location.href = 'index.php';
    }
    </script>
<div class="lolcontent">

        <div style="width:25%; margin-top: 25px; float:left;">
            <input class ="ui button" input type="button" name="lyp" id="lbutton"  value="Popularity Map!" onclick="mapFunc()"/>
        </div>
            
        
        <div style="width:50%; margin-top: 5px;float:left;">
            <?php
            echo '<h1 align="center" style="color: white; font-family: Snell Roundhand;">Spur-of-the-Moment Trip</h1>';
            ?>
        </div>
        <div style="width:25%; float:right;" >
            <div id="box">
            <input class ="ui button" input type="button" name="lyp" id="button" value="Return" onclick="ticket()"/>
            </div>
        </div>
</div>



<script>




        var tickets = (function () {
            var json = null;
            $.ajax({
                'async': false,
                'global': false,
                 'url': "tickets_info.json",
                //'url': "/home/momenttrip/public_html/cgi-bin/tickets.json",
                'dataType': "json",
                'success': function (data) {
                    json = data;
                }
            });
            return json;
        })();
        
        
        
        var dates = (function () {
            var json = null;
            $.ajax({
                'async': false,
                'global': false,
                 'url': "date.json",
                //'url': "/home/momenttrip/public_html/cgi-bin/tickets.json",
                'dataType': "json",
                'success': function (data) {
                    json = data;
                }
            });
            return json;
        })();
        
        
        // console.log(tickets);
        

        var data = []; temp=0;
        // for(var key in tickets.Prices)
        // {
        // data.push({});
        // data[temp].date = key;
        // data[temp].value = tickets.Prices[key];
        // temp++;
        // }
        
        for(var elem in tickets)
        {
        // console.log(elem);

        data.push({});
        data[temp].date = dates[temp];
        data[temp].value = tickets[temp]["price"];
        temp++;
        }

        var tickets_info = JSON.stringify(data);
        // alert(tickets_info);
        var data = JSON.parse(tickets_info);
        // console.log(data[0]['date']);


            // console.log(data)




        // set the dimensions of the canvas
        var margin = {top: 100, right: 100, bottom: 70, left: 100},
            width = 850 - margin.left - margin.right,
            height = 700 - margin.top - margin.bottom;


        // set the ranges
        var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);

        var y = d3.scale.linear().range([height, 0]);

        // define the axis
        var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom")


        var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(10);

var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
        temp = 0;
        for(var elem in tickets)
        {
        // console.log(elem);
        // console.log(d.date);
        // console.log(d);
        // console.log(d.price);
        if(d.date == dates[temp] && d.value == tickets[temp]["price"]){
            break;
        }
            temp++;
        }
          var res =  "<strong>Price:</strong> <span style='color:red'>" + tickets[temp]['price'] + "</span><br>"+ "<strong>Airline:</strong> <span style='color:red'>" + tickets[temp]['airline'] + "</span><br>"+"<strong>Departure time:</strong> <span style='color:red'>" + tickets[temp]['departure_time'] + "</span><br>"  + "<strong>Arrival time:</strong> <span style='color:red'>" + tickets[temp]['arrival_time'] + "</span><br>"+ "<strong>Stop time:</strong> <span style='color:red'>" + tickets[temp]['stop'] + "</span><br>";
          return res;
      
  })

        // add the SVG element
        var svg = d3.select("body").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
          .append("g")
            .attr("transform",
                  "translate(" + margin.left + "," + margin.top + ")");

svg.call(tip);

          // scale the range of the data
          x.domain(data.map(function(d) { return d.date; }));
          y.domain([0, d3.max(data, function(d) { return d.value; })]);

          // add axis
          svg.append("g")
              .attr("class", "x axis")
              .attr("transform", "translate(0," + height + ")")
              .call(xAxis)
            .selectAll("text")
              .style("text-anchor", "end")
              .attr("dx", "-.8em")
              .attr("dy", "-.55em")
              .attr("transform", "rotate(-90)" );
            //   .text("Stop_time");

          svg.append("g")
              .attr("class", "y axis")
              .call(yAxis)
            .append("text")
              .attr("transform", "rotate(-90)")
              .attr("y", 5)
              .attr("dy", ".71em")
              .style("text-anchor", "end")
              .text("Price");


          // Add bar chart
          svg.selectAll("bar")
              .data(data)
            .enter().append("rect")
              .attr("class", "bar")
              .attr("x", function(d) { return x(d.date); })
              .attr("width", x.rangeBand())
              .attr("y", function(d) { return y(d.value); })
              .attr("height", function(d) { return height - y(d.value); })
              .on('mouseover', tip.show)
              .on('mouseout', tip.hide)
              .on("click", clicked);
              
              
    svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 - (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "18px") 
        .style("text-decoration", "underline")  
        .text("Lowest Prices In Recent 11 Days");   
              
              
              
// });



    function clicked(d) {
        // console.log(d.date)

        
        var day_tickets = (function () {
            var json = null;
            $.ajax({
                'async': false,
                'global': false,
                 'url': "xinwenjian.json",
                //'url': "/home/momenttrip/public_html/cgi-bin/tickets.json",
                'dataType': "json",
                'success': function (data) {
                    json = data;
                }
            });
            return json;
        })();
        
        count = 0;
        for(var elem in tickets)
        {
        // console.log(elem);
        // console.log(d.date);
        // console.log(d);
        // console.log(d.price);
        if(d.date == dates[count]){
            break;
        }
        count++;
        }
        // console.log(count)
        
        
        
        // console.log(day_tickets[count])
        var data = []; temp=0;

        for(var elem in day_tickets[count])
        {
        data.push({});
        data[temp].date = day_tickets[count][temp]['stop'];
                // console.log(day_tickets[count][temp]['stop']);

        data[temp].value = day_tickets[count][temp]["price"];
                        // console.log(elem['price']);

        temp++;
        }
        console.log(data)
        
        
        
        // set the dimensions of the canvas
        var margin = {top: 20, right: 150, bottom: 70, left: 50},
            width = 450 - margin.left - margin.right,
            height = 400 - margin.top - margin.bottom;


        // set the ranges
        var x = d3.scale.ordinal().rangeRoundBands([0, width], .05);

        var y = d3.scale.linear().range([height, 0]);

        // define the axis
        var xAxis = d3.svg.axis()
            .scale(x)
            .orient("bottom")


        var yAxis = d3.svg.axis()
            .scale(y)
            .orient("left")
            .ticks(10);
            
            

var tip = d3.tip()
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
        temp = 0;
        for(var elem in day_tickets[count])
        {
        // console.log(elem);
        // console.log(d.date);
        // console.log(d);
        // console.log(d.price);
        if(d.date == day_tickets[count][temp]['stop'] && d.value == day_tickets[count][temp]["price"]){
            break;
        }
            temp++;
        }
          var res =  "<strong>Price:</strong> <span style='color:red'>" + day_tickets[count][temp]['price'] + "</span><br>"+ "<strong>Airline:</strong> <span style='color:red'>" + day_tickets[count][temp]['airline'] + "</span><br>"+"<strong>Departure time:</strong> <span style='color:red'>" + day_tickets[count][temp]['departure_time'] + "</span><br>"  + "<strong>Arrival time:</strong> <span style='color:red'>" + day_tickets[count][temp]['arrival_time'] + "</span><br>"+ "<strong>Stop time:</strong> <span style='color:red'>" + day_tickets[count][temp]['stop'] + "</span><br>";
          return res;
      
  })

        // add the SVG element
        var svg = d3.select("body").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
          .append("g")
            .attr("transform",
                  "translate(" + margin.left + "," + margin.top + ")");

svg.call(tip);

          // scale the range of the data
          x.domain(data.map(function(d) { return d.date; }));
          y.domain([0, d3.max(data, function(d) { return d.value; })]);

          // add axis
          svg.append("g")
              .attr("class", "x axis")
              .attr("transform", "translate(0," + height + ")")
              .call(xAxis)
            .selectAll("text")
              .style("text-anchor", "end")
              .attr("dx", "-.8em")
              .attr("dy", "-.55em")
              .attr("transform", "rotate(-90)" );
            //   .text("Stop_time");

          svg.append("g")
              .attr("class", "y axis")
              .call(yAxis)
            .append("text")
              .attr("transform", "rotate(-90)")
              .attr("y", 5)
              .attr("dy", ".71em")
              .style("text-anchor", "end")
              .text("Price");


          // Add bar chart
          svg.selectAll("bar")
              .data(data)
            .enter().append("rect")
              .attr("class", "bar")
              .attr("x", function(d) { return x(d.date); })
              .attr("width", x.rangeBand())
              .attr("y", function(d) { return y(d.value); })
              .attr("height", function(d) { return height - y(d.value); })
              .on('mouseover', tip.show)
              .on('mouseout', tip.hide)
            //   .on("click", clicked);
              
              
    svg.append("text")
        .attr("x", (width / 2))             
        .attr("y", 0 - (margin.top / 2))
        .attr("text-anchor", "middle")  
        .style("font-size", "15px") 
        .style("text-decoration", "underline")  
        .text("Several Low Prices on " +d.date);

        // svg.exit().remove()

    }



</script>

</body>
</html>
