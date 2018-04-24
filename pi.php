

<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<head>
<link rel="stylesheet" href=pi.css>

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
            <input class ="ui button" input type="button" name="lyp" id="button" value="Want cheap tickets?" onclick="ticket()"/>
            </div>
        </div>
</div>

<script>
// var data_url = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/29725/got.json";
// var colors_url = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/29725/house_colors.json";
var data_url = "pi.json";
var colors_url = "color1.json";
var data, house_colors;
d3.json(data_url, loadData);

function loadData(json){
  //data
  data = sortData(json);
  
  d3.json(colors_url, function(colors){
    house_colors = colors;
    visualize();

    window.onresize = function(){
      d3.select("svg").remove();
      visualize();
    };
  });
}

function visualize(){
  //style
  var pad = 10;
  var h = window.innerHeight-pad;
  var w = window.innerWidth-pad;
  var size = 1000;
  var r = size/8;
  var barWidth = w/data.length;
  var animTime = 1500;

  var radiusScale = d3.scale.sqrt()
    .domain([0, d3.max(data, function(d){ return d.episodes })])
    .range([0, r*3]);
  
  var colorScale = d3.scale.ordinal()
    .domain(arrayFromProperty(house_colors,"family"))
    .range(arrayFromProperty(house_colors,"color"));
  
  //bars
  var svg = d3.select("body")
    .append("svg")
      .attr("height", h)
      .attr("width", w)
      .style("margin", pad/2+"px 0 0 "+pad/2+"px");
  
  var pie = d3.layout.pie()
    .value(function(d){ return d.minutes})
    .sort(null);
  
  var arc_zero = d3.svg.arc()
    .outerRadius(r)
    .innerRadius(r);
  
  var arc = d3.svg.arc()
    .outerRadius(function(d){ return r + radiusScale(d.data.episodes) })
    .innerRadius(r);

  var g = svg.append("g")
    .attr("transform", "translate("+w/2+","+h/2+") rotate(-180)");
  g.transition().duration(animTime)
    .attr("transform", "translate("+w/2+","+h/2+")");


  var bars = g.selectAll("g")
    .data(pie(data)).enter()
    .append("g")
    .attr("class", "bar")
    .attr("id", function(d,i){ return i });
  
  bars.append("path")
    .attr("d", arc_zero)
    .attr("stroke", "#FFF")
    .attr("fill", function(d){ return colorScale(d.data.family) })
    .transition().duration(animTime)
    .attr("d", arc);
  
  //text info
  var circle = g.append("circle")
    .attr("fill", "#333")
    .attr("r", 1)
    .transition().duration(animTime)
    .attr("r", r-5);
  
  var title_default = "Recommendation";
  var title = g.append("text")
      .text(title_default)
      .attr("xml:space", "preserve")
      .attr("text-anchor", "middle")
      .attr("font-family", "GameOfThrones, sans-serif")
      .attr("font-size", size/70+"px")
      .attr("fill", "white");
  
  var subtitle_default = data.length + " Tourist Attractions";
  var subtitle = g.append("text")
      .text(subtitle_default)
      .attr("xml:space", "preserve")
      .attr("text-anchor", "middle")
      .attr("font-family", "Lato, sans-serif")
      .attr("font-size", size/63+"px")
      .attr("fill", "white")
      .attr("y", size/40);
  
  var subtitle_family = g.append("text")
      .text("")
      .attr("xml:space", "preserve")
      .attr("text-anchor", "middle")
      .attr("font-family", "Lato, sans-serif")
      .attr("font-size", size/63+"px")
      .attr("fill", "white")
      .attr("y", size/10);
  
  bars.on("mouseover", function(d){  title.text(d.data.name);
                                     subtitle.text(d3.round(d.data.minutes, 1)+" Stars, "+d.data.episodes+" Reviews");
                                     subtitle_family.text(d.data.family);  });
  bars.on("mouseout",  function(d){  title.text(title_default);
                                     subtitle.text(subtitle_default);
                                     subtitle_family.text("");  });
  bars.on("click",     function(d){  window.open(d.data.url, "_blank")  });
}

function sortData(data){
  var filter = "episodes";
  
  //sort by filter
  data.sort(sortProperty(filter));

  //break array into families
  var families = d3.nest()
    .sortValues(sortProperty(filter))
    .key(function(d) { return d.family; })
    .entries(data);
  
  //sort families by total filter
  families.forEach(function(family){
    family.episodes = 0;
    family.values.forEach(function(member){
      family.episodes += member.episodes;
    })
  });
  families.sort(sortProperty(filter));
  
  //move "other" to end no matter what
  families.forEach(function(obj,i){
    if (obj.key === "Other"){
      families.push(families[i])
      families.splice(i,1);
      return;
    }
   });
  
  return flattenTree(families);
}

function flattenTree(tree){
  var arr = [];
  tree.forEach(function(e,i){
    arr.push(e.values);
  });
  
  if (arr[0] instanceof Array) 
    return d3.merge(arr);
  else
    return arr;
}

function arrayFromProperty(arr, prop){
  var new_arr = [];
  arr.forEach(function(value){
    new_arr.push(value[prop]);
  });
  return d3.set(new_arr).values();
}

function sortProperty(property){
  return (function(a, b) {
            if (a[property] < b[property])
              return 1;
            else if (a[property] > b[property])
              return -1;
            return 0;
          });
}</script>

</body>
</html>
