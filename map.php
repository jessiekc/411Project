<!--<!DOCTYPE html>-->
<!--<html>-->
<!--    <head>-->
<!--        <meta charset="utf-8">-->
<!--        <style>-->
<!--            * {-->
<!--                font-family:"Helvetica Neue";-->
<!--            }-->
<!--            p {-->
<!--                font-size: 0.85em;-->
<!--            }-->
<!--            svg {-->
<!--                background: #efefef;-->
<!--            }-->
<!--        </style>-->
<!--    </head>-->
<!--    <body>-->
<!--        <div id="map"></div>-->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.2/d3.min.js"></script>-->
<!--        <script src="https://d3js.org/topojson.v1.min.js"></script>-->
<!--        <script src="map.js"></script>-->
<!--    </body>-->
<!--</html>-->




<!DOCTYPE html>
<meta charset="utf-8">
<style>
body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  width: 960px;
  height: 500px;
  position: relative;
  background-image: url("https://wallpaperscraft.com/image/deer_silhouette_galaxy_stars_118063_2048x1152.jpg");
}
#canvas {
}
#canvas-svg {
}
.land {
  fill: #222;
}
.boundary {
  fill: none;
  stroke: #fff;
  stroke-width: 1px;
}
#tooltip-container {
  position: absolute;
  background-color: #fff;
  color: #000;
  padding: 10px;
  border: 1px solid;
  display: none;
}
.tooltip_key {
  font-weight: bold;
}
.tooltip_value {
  margin-left: 20px;
  float: right;
}
</style>

<div id="tooltip-container"></div>

<div id="canvas-svg"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/topojson/1.1.0/topojson.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
d3.csv("API_ST.INT.ARVL_DS2_en_csv_v2.csv", function(err, data) {
  var config = {"data0":"Country Name","data1":"2016",
              "label0":"label 0","label1":"label 1","color0":"#99ccff","color1":"#0050A1",
              "width":960,"height":960}
  
  var width = config.width,
      height = config.height;
  
  var COLOR_COUNTS = 9;
  
  function Interpolate(start, end, steps, count) {
      var s = start,
          e = end,
          final = s + (((e - s) / steps) * count);
      return Math.floor(final);
  }
  
  function Color(_r, _g, _b) {
      var r, g, b;
      var setColors = function(_r, _g, _b) {
          r = _r;
          g = _g;
          b = _b;
      };
  
      setColors(_r, _g, _b);
      this.getColors = function() {
          var colors = {
              r: r,
              g: g,
              b: b
          };
          return colors;
      };
  }
  
  function hexToRgb(hex) {
      var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
      return result ? {
          r: parseInt(result[1], 16),
          g: parseInt(result[2], 16),
          b: parseInt(result[3], 16)
      } : null;
  }
  
  function valueFormat(d) {
    if (d > 1000000000) {
      return Math.round(d / 1000000000 * 10) / 10 + "B";
    } else if (d > 1000000) {
      return Math.round(d / 1000000 * 10) / 10 + "M";
    } else if (d > 1000) {
      return Math.round(d / 1000 * 10) / 10 + "K";
    } else {
      return d;
    }
  }
  
  var COLOR_FIRST = config.color0, COLOR_LAST = config.color1;
  
  var rgb = hexToRgb(COLOR_FIRST);
  
  var COLOR_START = new Color(rgb.r, rgb.g, rgb.b);
  
  rgb = hexToRgb(COLOR_LAST);
  var COLOR_END = new Color(rgb.r, rgb.g, rgb.b);
  
  var startColors = COLOR_START.getColors(),
      endColors = COLOR_END.getColors();
  
  var colors = [];
  
  for (var i = 0; i < COLOR_COUNTS; i++) {
    var r = Interpolate(startColors.r, endColors.r, COLOR_COUNTS, i);
    var g = Interpolate(startColors.g, endColors.g, COLOR_COUNTS, i);
    var b = Interpolate(startColors.b, endColors.b, COLOR_COUNTS, i);
    colors.push(new Color(r, g, b));
  }
  
  var MAP_KEY = config.data0;
  var MAP_VALUE = config.data1;
  
  var projection = d3.geo.mercator()
      .scale((width + 1) / 2 / Math.PI)
      .translate([width / 2, height / 2])
      .precision(.1);
  
  var path = d3.geo.path()
      .projection(projection);
  
  var graticule = d3.geo.graticule();
  
  var svg = d3.select("#canvas-svg").append("svg")
      .attr("width", width)
      .attr("height", height);
  
  svg.append("path")
      .datum(graticule)
      .attr("class", "graticule")
      .attr("d", path);
  
  var valueHash = {};
  
  function log10(val) {
    return Math.log(val);
  }
  
  data.forEach(function(d) {
    valueHash[d[MAP_KEY]] = +d[MAP_VALUE];
  });
  
  var quantize = d3.scale.quantize()
      .domain([0, 1.0])
      .range(d3.range(COLOR_COUNTS).map(function(i) { return i }));
  
  quantize.domain([d3.min(data, function(d){
      return (+d[MAP_VALUE]) }),
    d3.max(data, function(d){
      return (+d[MAP_VALUE]) })]);
  
  d3.json("https://s3-us-west-2.amazonaws.com/vida-public/geo/world-topo-min.json", function(error, world) {
    var countries = topojson.feature(world, world.objects.countries).features;
  
    svg.append("path")
       .datum(graticule)
       .attr("class", "choropleth")
       .attr("d", path);
  
    var g = svg.append("g");
  
    g.append("path")
     .datum({type: "LineString", coordinates: [[-180, 0], [-90, 0], [0, 0], [90, 0], [180, 0]]})
     .attr("class", "equator")
     .attr("d", path);
  
    var country = g.selectAll(".country").data(countries);
  
    country.enter().insert("path")
        .attr("class", "country")
        .attr("d", path)
        .attr("id", function(d,i) { return d.id; })
        .attr("title", function(d) { return d.properties.name; })
        .style("fill", function(d) {
          if (valueHash[d.properties.name]) {
            var c = quantize((valueHash[d.properties.name]));
            var color = colors[c].getColors();
            return "rgb(" + color.r + "," + color.g +
                "," + color.b + ")";
          } else {
            return "#ccc";
          }
        })
        .on("mousemove", function(d) {
            var html = "";
  
            html += "<div class=\"tooltip_kv\">";
            html += "<span class=\"tooltip_key\">";
            html += d.properties.name;
            console.log(d.properties.name);
            html += "</span>";
            html += "<span class=\"tooltip_value\">";
            html += (valueHash[d.properties.name] ? valueFormat(valueHash[d.properties.name]) : "");
            html += "";
            html += "</span>";
            html += "</div>";
            
            $("#tooltip-container").html(html);
            $(this).attr("fill-opacity", "0.8");
            $("#tooltip-container").show();
            
            var coordinates = d3.mouse(this);
            
            var map_width = $('.choropleth')[0].getBoundingClientRect().width;
            
            if (d3.event.pageX < map_width / 2) {
              d3.select("#tooltip-container")
                .style("top", (d3.event.layerY + 15) + "px")
                .style("left", (d3.event.layerX + 15) + "px");
            } else {
              var tooltip_width = $("#tooltip-container").width();
              d3.select("#tooltip-container")
                .style("top", (d3.event.layerY + 15) + "px")
                .style("left", (d3.event.layerX - tooltip_width - 30) + "px");
            }
        })
        .on("mouseout", function() {
                $(this).attr("fill-opacity", "1.0");
                $("#tooltip-container").hide();
            })
        .on("click", function(d){
            console.log(d.properties.name);
            window.location.href = "photogallery.php?country="+d.properties.name;
            
        });
    g.append("path")
        .datum(topojson.mesh(world, world.objects.countries, function(a, b) { return a !== b; }))
        .attr("class", "boundary")
        .attr("d", path);
    
    svg.attr("height", config.height * 2.2 / 3);
  });
  
  d3.select(self.frameElement).style("height", (height * 2.3 / 3) + "px");
});


</script>


    <script type="text/javascript">
    function register() {
        window.location.href = 'signup_login/signup_login.php';
    }
    </script>


<script type="text/javascript">
    function searchFlight() {
        window.location.href = 'index.php';
    }
    
    </script>
<link rel="stylesheet" href=map.css>

<div class="lolcontent">

  
          <div style="width:25%; margin-top: 25px; float:left;">
            <input class ="ui button" input type="button" name="lyp" id="lbutton" value="Signup/Login to have your personal recommandation" onclick="register()"/>
            
        </div>
            
        <div style="width:50%; margin-top: 5px;float:left;">
            <h1 align="center" style="color: white; font-family: Snell Roundhand;">Spur-of-the-Moment Trip</h1>
        </div>
        
        <div style="width:25%; float:left;" >
            <div id="box">
            
            <input class ="ui button" input type="button" name="lyp" id="button" value="Know where you want to go? Search Flight Directly!" onclick="searchFlight()"/>
            </div>
        </div>

</div>
















