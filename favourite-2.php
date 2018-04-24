

<link rel="stylesheet" href=favourite_style.css>

<?php
    include 'booknow_consql.php';
    
    session_start();
    $flag = $_GET['flag'];
    //echo $flag;

    $email=$_SESSION['email'];
    $id=$_SESSION['id'];
    echo $email;
    if(email != "" && $flag == 1) {
        $query1 = "SELECT* from `trip_ratings` WHERE `id` = '$id'";
        $result1 = $mysqli->query($query1);
        $row1 = mysqli_fetch_array($result1);
        $country1=$row1['Country'];
        $city1=$row1['city'];
        $tourist_attraction1=$row1['tourist_attraction'];
        $type1=$row1['types'];
        
        $query1 = "INSERT INTO `history_user`(tourist_id, email, country, city, tourist_attraction, type) VALUES('$id','$email','$country1','$city1','$tourist_attraction1','$type1')";
        $result2 = $mysqli->query($query1);
    }
    
    $query = "SELECT* from `history_user` WHERE `email` = '$email'";
    $result = $mysqli->query($query);
    
    $_SESSION['email'] = $email;
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

</head>
<body>
    
     <script type="text/javascript">
     $(function(){
      $('#keywords').tablesorter(); 
    });
    function regist() {
        <?php
            session_start();
            $_SESSION['email'] = $email;
        ?>
        window.location.href = 'photogallery.php';
    }
     function searchFlight() {
        <?php
            session_start();
            $_SESSION['email'] = $email;
        ?>
        window.location.href = 'pi.php';
    }
    function mapFunc(){
        window.location.href = 'map.php';
    }
    function ticket(){
        window.location.href = 'index.php';
    }
    </script>
    
    
    <h1 >Favourite booking information</h1>
    
    <table id="inputform" class="ui compact celled definition table">
  <thead class="full-width">
    <tr>
      <th>type</th>
      <th>rate</th>
      <th>city</th>
      <th></th>
    </tr>
  </thead>

  <tbody>
    <tr>
      <form action="historyedit.php" method="POST"/>
      <td><input type="text" name="type" placeholder="historic sites"  autocomplete="off" /></td>
      <td><input type="text" name="rate" placeholder="3"  autocomplete="off"/></td>
      <td><input type="text" name="city" placeholder="Chicago"  autocomplete="off"/></td>
      <td><button/>SUBMIT </button></td>
      </form>
    </tr>
   
    
  </tbody>
  
  
</table>
    
    <table  id="keywords" border="1" align="center" ">
        <thead>
        <tr >
            <th><span>Tourist ID</span></th>
            <th><span>Country</span></th>
            <th><span>City</span></th>
            <th><span>Tourist Attraction</span></th>
            <th><span>DELETE</span></th>
            <!--<th><span>EDIT</span></th>-->
        </tr>
        </thead>
        <tbody>
        <?php
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td class=lalign>" .$row['tourist_id']."</td>";
                echo "<td class=lalign>" .$row['country']."</td>";
                echo "<td class= lalign>" .$row['city']."</td>";
                echo "<td class= lalign>" .$row['tourist_attraction']."</td>";
                echo "<td><a href=favouritedelete.php?id=".$row['id'].">DELETE</a></td>";
                // echo "<td><a href=favouriteedit.php?id=".$row['id'].">EDIT</a></td>";
                // echo "<td><a href=historyedit.php?id=".$row['id'].">EDIT</a></td>";
            }
        ?>
        </tbody>
        
    </table>
    <div class="lolcontent">

          <div style="width:25%; margin-top: 25px; float:left;">
            <input class ="ui button" input type="button" name="lyp" id="lbutton"  value="Tourist Attraction Gallery" onclick="regist()"/>
        </div>
            
        <div style="width:50%; margin-top: 5px;float:left;">
            <h1 align="center" style="color: white; font-family: Chalkduster, fantasy	;font-weight: bold;font-size: 3.6em;line-height: 1.7em;">Spur-of-the-Moment Trip</h1>
        </div>
        
        <div style="width:25%; float:left;" >
            <div id="box">
            <input class ="ui button" input type="button" name="lyp" id="button" value="Still want more recommendation?" onclick="searchFlight()"/>
            </div>
        </div>
        <div style="width:25%; margin-top: 25px; float:left;">
            <input class ="ui button" input type="button" name="lyp" id="lbutton"  value="Popularity Map!" onclick="mapFunc()"/>
        </div>
        <div style="width:25%; float:right;" >
            <div id="box">
            <input class ="ui button" input type="button" name="lyp" id="button" value="Want cheap tickets?" onclick="ticket()"/>
            </div>
        </div>
</div>
        



</body>
</html>