<?php
    $id = $_GET['id'];
    $rate = $_GET['rate'];
    if($rate < 1) {
        // echo 'case1';
        include 'booknow_consql.php';
        $query = "SELECT * FROM `trip_ratings` WHERE `id` = '$id'";
        $result = $mysqli->query($query);
        $row = mysqli_fetch_array($result);
        
        session_start();
        $_SESSION['id'] = $id;
        $email = $_SESSION['email'];
        
        $query1 = "SELECT* from `trip_ratings` WHERE `id` = '$id'";
        $result1 = $mysqli->query($query1);
        $row1 = mysqli_fetch_array($result1);
        $country1=$row1['Country'];
        $city1=$row1['city'];
        $tourist_attraction1=$row1['tourist_attraction'];
        $type1=$row1['types'];
            
        $query2 = "INSERT INTO `history_admin`(tourist_id, email, country, city, tourist_attraction, type) VALUES('$id','$email','$country1','$city1','$tourist_attraction1','$type1')";
        $result2 = $mysqli->query($query2);
    }
    if($rate > 0) {
        //echo 'case2';
        session_start();
        $id = $_SESSION['id'];
        $_SESSION['id'] = $id;
        $email = $_SESSION['email'];
        
        include 'booknow_consql.php';
        $query3 = "UPDATE `trip_ratings`
SET `num_visit` = `num_visit` + 1
WHERE `id` = '$id'";
        $result3 = $mysqli->query($query3);
        
        $query5 = "UPDATE `trip_ratings`
SET `score` = (`score`*(`num_visit`-1) + '$rate')/(`num_visit`)
WHERE `id` = '$id'";
        $result5 = $mysqli->query($query5);
        
        $query4 = "SELECT * FROM `trip_ratings` WHERE `id` = '$id'";
        $result4 = $mysqli->query($query4);
        $row = mysqli_fetch_array($result4);
        
        
        
    }
?>

<script type="text/javascript">
    function func() {
        window.location.href = 'favourite.php?flag=1';
    }
    function backFun() {
        window.location.href = 'photogallery.php';
    }
    function rateFunc() {
        var a = document.getElementById('ratebox').value;
        // a="touristAttractionDetail.php?id='$id'";
        window.location.href = "touristAttractionDetail.php?rate="+a;
    }
</script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/button.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/icon.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/input.min.css">

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/label.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/label.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/input.css">


<!--citation:https://codepen.io/thomasvaeth/pen/bgWmJq-->
<link rel="stylesheet" href=touristAttractionDetail.css>
<article class="post">
  <div>
    <div class="absolute-bg" style="background-image: url('https://source.unsplash.com/f9C8ytxaItI/2000x1200');"></div>
    <?php
        echo '<div class="absolute-bg" style="background-image: url('.$row[image].');"></div>';
    ?>
  </div>
  <div class="post__container">
    <span class="post__category">Spur-of-the-Moment Trip</span>
    
    <div class="post__content">
      <header>
        <!--<h1 class="post__header"><span>Visiting</span> <span>the</span> <span>beach</span></h1>-->
        <?php
        
            echo '<h1 class="post__header">';
            echo '<span>'. $row['tourist_attraction']. '</span></h1>';
        ?>
    
        
        
      </header>
        <?php
        echo '<p class="post__text">'.$row['ratings'].' from TripAdvisor</p>';
        echo '<p class="post__text">'.$row['types'].'</p>';
        echo '<p class="post__text">'.$row['description'].'</p>';
        ?>
    </div>
    
    <!--<script>-->
    <!--$('.rating')-->
    <!--  .rating({-->
    <!--    initialRating: 3,-->
    <!--    maxRating: 5-->
    <!--  })-->
    <!--;-->

    <!--</script>-->

    <!--<div class="ui massive star rating"></div>-->
    
    <!--<div class="ui action input">-->
    <!--  <input type="text" placeholder="0-5">-->
    <!--  <button class="ui button">Submit</button>-->
    <!--</div>-->
    
    <div class="post__link">
        <div class="ui label">
          <i class="certificate icon"></i> Rate: <?php echo round($row['score'],2); ?>
        </div>
        <div class="ui action input">
          <input id="ratebox" type="text" placeholder="0-5">
          <button class="ui icon button" onClick="rateFunc()">
            <i id="certificate_icon" class="check icon"></i>
          </button>
        </div>
        <button class="ui button" onClick= "backFun()">
          Back
        </button>
      <div class="ui labeled button" tabindex="0">
          <div class="ui button" id="favBot" onClick= "func()">
            <i id="heart_icon" class="heart icon"></i> Favourite
          </div>
        </div>
    </div>
  </div>
</article>