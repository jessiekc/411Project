<!--https://codepen.io/mglissmann/pen/zxXvpq?q=gallery&limit=all&type=type-pens-->

<?php
    $country = $_GET['country'];
    session_start();
    $email=$_SESSION['email'];
    echo $email;
    include 'booknow_consql.php';
    $query = "SELECT * FROM `trip_ratings` WHERE `country` LIKE '$country%' and image LIKE 'h%'";
    $result = $mysqli->query($query);
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--<script src="./semantic/dist/semantic.min.js"></script>-->
<link rel="stylesheet" href=photogallery.css>
<script type="text/javascript" src="photogallery.js"></script>
<!--use while loop and php to load photo-->
<!--might could have machine learning here, if user login-->



<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

<header>
</header>

<div id="top"></div>
<section class="gallery">
	<div class="row">
		<ul>
			<a href="#" class="close"></a>
			
			<?php
			    $count = 0;
			    
                session_start();
                $_SESSION['email'] = $email;
                
			    while(($row = mysqli_fetch_array($result)) && count < 12) {
    			    echo '<li>';
        			    echo '<a href=touristAttractionDetail.php?id='.$row[id].'>';
        				    echo '<img src=' .$row['image']. ' alt="" width="300" height="200">';
        				echo '</a>';
        	        echo '</li>';
        	        $count ++;
			    }
            ?>
			

		</ul>
	</div> <!-- / row -->

	<!-- Item 01 -->
	<div id="item01" class="port">
	
		<div class="row">
			<div class="description">
				<h1>Item 01</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis libero erat. Integer ac purus est. Proin erat mi, pulvinar ut magna eget, consectetur auctor turpis.</p>
			</div>

				<img src="https://d13yacurqjgara.cloudfront.net/users/22177/screenshots/1379781/winterletters-jeremiahbritton-dribbble.png" alt="">
			</div>
		</div> <!-- / row -->


	<!-- Item 02 -->
	<div id="item02" class="port">
	
		<div class="row">
			<div class="description">
				<h1>Item 02</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis libero erat. Integer ac purus est. Proin erat mi, pulvinar ut magna eget, consectetur auctor turpis.</p>
			</div>
			<img src="https://d13yacurqjgara.cloudfront.net/users/22177/screenshots/404704/wontstopblue-womens-jeremiahbritton.jpg" alt="">
		</div> <!-- / row -->

	</div> <!-- / Item 02 -->

</section> <!-- / projects -->





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
    
<div class="lolcontent">

  
          <div style="width:25%; margin-top: 25px; float:left;">
            <input class ="ui button" input type="button" name="lyp" id="lbutton" value="Signup/Login to have your personal recommandation" onclick="register()"/>
            
        </div>
            
        <div style="width:50%; margin-top: 5px;float:left;">
            <?php
            echo '<h1 align="center" style="color: white; font-family: Snell Roundhand;">'.$country.'</h1>';
            ?>
        </div>
        
        <div style="width:25%; float:left;" >
            <div id="box">
            
            <input class ="ui button" input type="button" name="lyp" id="button" value="Know where you want to go? Search Flight Directly!" onclick="searchFlight()"/>
            </div>
        </div>

</div>
    