
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


      <link rel="stylesheet" href="css/style.css">
      

</head>

<body>
<!--<video autoplay muted loop id="myVideo">-->
<!--  <source src="travel.mp4" type="video/mp4">-->
<!--</video>-->
  <div class="form">

      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>

      <div class="tab-content">
        <div id="signup">
          <h1>Sign Up for Free</h1>

          <form action="/signup_login/insert.php" method="POST">

          <div class="top-row">
            <div class="field-wrap">
              <label>
                email<span class="req">*</span>
              </label>
              <input type="email" name="email" required autocomplete="off" />
            </div>

            <div class="field-wrap">
              <label>
                password<span class="req">*</span>
              </label>
              <input type="password" name="password" required autocomplete="off"/>
            </div>
          </div>

          <div class="field-wrap">
            <label>
              current_city<span class="req">*</span>
            </label>
            <input type="text" name="current_city" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="username" name="Username" required autocomplete="off"/>
          </div>

          <button type="submit" id="butsubmit" class="button button-block" name="submit" >Get Started</button>

          </form>

        </div>

        <div id="login">
          <h1>Welcome Back!</h1>

          <form action="/signup_login/userlogin.php" method="POST">

            <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input type="email" name="email" required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>

          <p class="forgot"><a href="#">Forgot Password?</a></p>

          <button class="button button-block" id="butsubmit" >Log In</button>

          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



    <script  src="js/index.js"></script>
<script type="text/javascript">
    function searchFlight() {
        window.location.href = '../index.php';
    }
    function mapFunc() {
        window.location.href = '../map.php';
    }
    </script>
<div class="lolcontent">

  
          <div style="width:25%; margin-top: 25px; float:left;">
            <input class ="ui button" input type="button" name="lyp" id="lbutton" value="Show me the Popularity Map!" onclick="mapFunc()"/>
            
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

</body>

</html>
