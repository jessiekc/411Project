
 <table border="1" align="center" style="line-height:25px;">
        <tr>
            <th>Tourist ID</th>
            <th>Country</th>
            <th>City</th>
            <th>Tourist Attraction</th>
        </tr>

        <?php
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" .$row['tourist_id']."</td>";
                echo "<td>" .$row['country']."</td>";
                echo "<td>" .$row['city']."</td>";
                echo "<td>" .$row['tourist_attraction']."</td>";
            }
        ?>
        
    </table>
<table class="ui compact celled definition table">
  <thead class="full-width">
    <tr>
      <th>Tourist ID</th>
      <th>Country</th>
      <th>City</th>
      <th>Tourist Attraction</th>
      <th></th>
    </tr>
  </thead>
<?php
    include 'booknow_consql.php';

    session_start();
    $ID = $_GET[id];
    
    $_SESSION["test_val"] = $ID;
    
    $query = "SELECT* FROM `history_user` WHERE `id` = '$ID'";
    $result = $mysqli->query($query);
?>







  <tbody>
    <tr>
      <form  action="historyedit.php" method="POST"/>
      <td><input type="text" name="country" placeholder="united state"  autocomplete="off" /></td>
      <td><input type="text" name="city" placeholder="Chicago"  autocomplete="off"/></td>
      <td><input name="tourist_attraction" type="text"  placeholder="Chicago River"  autocomplete="off"/></td>
      <td><button/>SUBMIT </button></td>
      </form>
    </tr>
   
    
  </tbody>
  
</table>


