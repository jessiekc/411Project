<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href=photogallery.css>
<link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/label.css'>
<link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/label.min.css'>
<?php
    session_start();
    include_once 'booknow_consql.php';
    $type = $_POST['type'];
    $rate = $_POST['rate'];
    $city = $_POST['city'];
    $email=$_SESSION['email'];
    //echo $email;
    // $ID =  $_SESSION["test_val"];

    if($type != ""){
         if($rate != ""){
             if($city != ""){
                 $query = "SELECT DISTINCT t.image as 'image', t.id as 'tourist_id', h.city as 'city', h.tourist_attraction as 'tourist_attraction', h.type as 'type', t.score as 'score' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.city LIKE '%$city%' AND t.score >= '$rate' AND h.type LIKE '%$type%' AND h.email = '$email' ";
                 $query1 = "SELECT count(DISTINCT h.tourist_attraction) as 'count' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.city LIKE '%$city%' AND t.score >= '$rate' AND h.type LIKE '%$type%' AND h.email = '$email' ";                 
             } else {
                 $query = "SELECT DISTINCT t.image as 'image', t.id as 'tourist_id', h.city as 'city', h.tourist_attraction as 'tourist_attraction', h.type as 'type', t.score as 'score' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND t.score >= '$rate' AND h.type LIKE '%$type%' AND h.email = '$email' ";
                 $query1 = "SELECT count(DISTINCT h.tourist_attraction) as 'count' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND t.score >= '$rate' AND h.type LIKE '%$type%' AND h.email = '$email' ";
             }
        } else {
             if($city != ""){
                 $query = "SELECT DISTINCT t.image as 'image', t.id as 'tourist_id', h.city as 'city', h.tourist_attraction as 'tourist_attraction', h.type as 'type', t.score as 'score' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.city LIKE '%$city%' AND h.type LIKE '%$type%' AND h.email = '$email' ";     
                 $query1 = "SELECT count(DISTINCT h.tourist_attraction) as 'count' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.city LIKE '%$city%' AND h.type LIKE '%$type%' AND h.email = '$email' ";  
             } else {
                 $query = "SELECT DISTINCT t.image as 'image', t.id as 'tourist_id', h.city as 'city', h.tourist_attraction as 'tourist_attraction', h.type as 'type', t.score as 'score' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.type LIKE '%$type%' AND h.email = '$email' ";        
                 $query1 = "SELECT count(DISTINCT h.tourist_attraction) as 'count' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.type LIKE '%$type%' AND h.email = '$email' ";    
             }
        }
    } else {
        if($rate != ""){
             if($city != ""){
                 $query = "SELECT DISTINCT t.image as 'image', t.id as 'tourist_id', h.city as 'city', h.tourist_attraction as 'tourist_attraction', h.type as 'type', t.score as 'score' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.city LIKE '%$city%' AND t.score >= '$rate' AND h.email = '$email' ";              
                 $query1 = "SELECT count(DISTINCT h.tourist_attraction) as 'count'  FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.city LIKE '%$city%' AND t.score >= '$rate' AND h.email = '$email' ";
             } else {
                 $query = "SELECT DISTINCT t.image as 'image', t.id as 'tourist_id', h.city as 'city', h.tourist_attraction as 'tourist_attraction', h.type as 'type', t.score as 'score' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND t.score >= '$rate' AND h.email = '$email' ";  
                 
                 $query1 = "SELECT count(DISTINCT h.tourist_attraction) as 'count' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND t.score >= '$rate' AND h.email = '$email' "; 
             }
        } else {
            if($city != "") {
                 $query = "SELECT DISTINCT t.image as 'image', t.id as 'tourist_id', h.city as 'city', h.tourist_attraction as 'tourist_attraction', h.type as 'type', t.score as 'score' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.city LIKE '%$city%' AND h.email = '$email' "; 
                 
                 $query1 = "SELECT count(DISTINCT h.tourist_attraction) as 'count' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.city LIKE '%$city%' AND h.email = '$email' ";  
            } else {
                 $query = "SELECT DISTINCT t.image as 'image', t.id as 'tourist_id', h.city as 'city', h.tourist_attraction as 'tourist_attraction', h.type as 'type', t.score as 'score' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.email = '$email' ";   
                 
                 $query1 = "SELECT count(DISTINCT h.tourist_attraction) as 'count' FROM `history_user` h, `trip_ratings` t, `User` u WHERE h.city = t.city AND h.tourist_attraction = t.tourist_attraction AND u.email = h.email AND h.email = '$email' ";   
            }
        }
    }
    
    $result = $mysqli->query($query);
    $result1 = $mysqli->query($query1);
    // if($result) {
    //     echo 'success';
    // } else {
    //     echo 'fail';
    // }
    

    
   //header("Location:  http://momenttrip.web.engr.illinois.edu/favourite.php");
   //exit;
?>

<!--<div id="top"></div>-->
<section class="gallery">
	<div class="row">
	   
		<ul>
			<a href="#" class="close"></a>
			<?php
                while($row = mysqli_fetch_array($result)) {
            	    echo '<li>';
            		    echo '<a href=touristAttractionDetail.php?id='.$row['tourist_id'].'>';
            			    echo '<img src=' .$row['image']. ' alt="" width="300" height="200">';
            			echo '</a>';
                    echo '</li>';
                }			
			    
			
			
			?>
		</ul>

	</div> <!-- / row -->
	 <div class="ui label">
              Total
              <?php
              $row1 = mysqli_fetch_array($result1);
		    //echo $row1['count'];
              echo '<div class="detail">'.$row1['count'].'</div>';
              //<div class="detail">333</div>
              ?>
            </div>
</section> <!-- / projects -->
<script type="text/javascript">
    function returnFun() {
        window.location.href = 'favourite.php';
    }
    function regist() {
        <?php
            session_start();
            $_SESSION['email'] = $email;
        ?>
        window.location.href = 'photogallery.php';
    }
    </script>
    
<div class="lolcontent">

  
          <div style="width:25%; margin-top: 25px; float:left;">
            <input class ="ui button" input type="button" name="lyp" id="lbutton"  value="More Option?" onclick="regist()"/>
        </div>
            
        <div style="width:50%; margin-top: 5px;float:left;">
            <?php
            echo '<h1 align="center" style="color: white; font-family: Snell Roundhand;"> Spur-of-the-Moment Trip </h1>';
            ?>
        </div>
        
        <div style="width:25%; float:left;" >
            <div id="box">
            
            <input class ="ui button" input type="button" name="lyp" id="button" value="Return" onclick="returnFun()"/>
            </div>
        </div>

</div>