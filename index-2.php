<?php
session_start();
    $email=$_SESSION['email'];
    echo $email;
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />

    <script src="jquery-3.3.1.min.js"></script>
<script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
<script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script>
    <title>Spur-of-the-Moment Trip</title>
        <link rel="stylesheet" href=style.css>
        <link rel="stylesheet" href=search_style.css>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/input.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/input.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/button.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/button.min.css">
    <script type="text/javascript" src="script.js"></script>
    
    
    <script type="text/javascript">
    function regist() {
        window.location.href = 'signup_login/signup_login.php';
    }
    function mapFunc() {
        window.location.href = 'map.php';
    }
    </script>
    
    
    <script type="text/javascript">
    // function booknow() {
    //     window.location.href = 'gallery_web//test.html';
    // }
    function searchFunc(){
        window.location.href = 'photogallery.php?country='+document.getElementById('inputId').value;
    }
    </script>
    
</head>

<body>

<video autoplay muted loop id="myVideo">
  <source src="travel.mp4" type="video/mp4">
</video>

<div class="content">

  
          <div style="width:10%; margin-top: 25px; float:left;">
            <input class ="signup" input type="button"name="lyp" id="button" value="Signup/Login" onclick="regist()"/>
        </div>
            
        <div style="width:80%; margin-top: 5px;float:left;">
            <h1 align="center" style="color: white; font-family: Snell Roundhand;">Spur-of-the-Moment Trip</h1>
        </div>
        
        <div style="width:10%; float:left;">
        <div id="box">
            
            <div class="ui action input">
              <input id="inputId" type="text" placeholder="Plz type a Country you want to go">
              <button class="ui button" onclick="searchFunc()">Search</button>
            </div>
        
            </div>
        </div>
<div class="but2nd" style="width:100%; " >
    <div style="width:10%;  margin-bot: 0px; float:left;">
            
            <button id="my" onclick="mapFunc()">Show me the Popularity Map！</button>
      </div>
      <div style="width:15%; margin-bot: 0px;float:right; ">
        <button id="myBtn" onclick="myFunction()">Pause</button>
      </div>
  </div>
</div>
    


    

    

    <div class="diamond"></div>
    <div class="form-wrap">
      <h2 class="mob">Hotel Booking Form</h2>
      <h3 class="mob">Mobile Version</h3>
      <h5 class="mob">view on a desktop for the full experience</h5>
      
      <form action="booknow_insert.php" method="POST">
          
        <div class="location">
            <div class="departure_city">
              <label>
                DEPARTURE CITY
              </label>
              <input type="text" name="departure_city" placeholder="New York" required autocomplete="off" />
            </div>

            <div class="destination_city">
              <label>
                DESTINATION CITY
              </label>
              <input type="text" name="destination_city" placeholder="New York" required autocomplete="off"/>
            </div>
          </div>
          
          
        
        <div class="dates">
            
            
        <!--<div class="departure">-->
        <!--    <label for="arrival">DEPARTURE TIME </label><br/>-->
        <!--    <input name="departure_time" type="text"  placeholder="2016-05-11" required autocomplete="off"/>-->
        <!--  </div>-->
        <!--            <div class="arrival">-->
        <!--    <label for="arrival">ARRIVAL TIME </label><br/>-->
        <!--    <input name="arrival_time" type="text"  placeholder="2016-10-03" required autocomplete="off"/>-->
        <!--  </div>-->
        <!--</div>-->

          <div class="departure">
            <label for="arrival">DEPARTURE TIME</label><br/>
            <input name="departure_time" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="2016/05/11"/>
          </div>
          <!--          <div class="arrival">-->
          <!--  <label for="arrival">ARRIVAL TIME</label><br/>-->
          <!--  <input name="arrival_time" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="2016/10/03"/>-->
          <!--</div>-->
        </div>
        
        <!--<div class="guests">-->
        <!--  <label for="guests">NUMBER OF GUESTS</label><br/><br/>-->
        <!--  <input type="text" id="guestNo" name="guests" value="2"/>-->
        <!--</div>-->
              <!--<button class="submit" type="button" onclick="signup()">BOOK NOW</button>-->
                            <button class="btn" type="submit" name="book_now"  >BOOK NOW</button>
                  <!--<button type="submit" class="button button-block" name="submit" onclick="signup()">Get Started</button>-->
        
      </form>
      <!--<button class="btn" type="button" onclick="bookFunction()">BOOK NOW</button>-->
                    <!--<button class="submit" type="button" onclick="signup()">BOOK NOW</button>-->
      <div class="linkbox">
        <div class="links">
          <div class="origin">
            <p>Check out Seth Coelen's original design over on dribbble</p><a href="www.google.com" target="_blank"><i class="fa fa-dribbble"></i></a>
          </div>
          <div class="me">
            <p>Why not take a look at my other pens while you're here</p><a href="www.ctrip.com"><i class="fa fa-codepen"></i></a>
          </div>
        </div>
      </div>
    </div>
    
    <script>
    function bookFunction() {
        document.getElementById("field2").value = document.getElementById("field1").value;
    }
    </script>
    
    
    
    <script type="text/javascript" src="scripts.js"></script>
        <script type="text/javascript" src="video.js"></script>




</body>
</html>








