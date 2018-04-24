<?php
    include_once('booknow_consql.php');
     //ini_set('display_errors',1);
    if(isset($_GET['id'])){
        $id = $_GET[id];
        $sql_delete="DELETE FROM `history_user` WHERE `id` = '$id'";
        // if($sql_delete == 0) echo "failed!";
        $res = $mysqli->query($sql_delete);
        header("refresh:1; url = favourite.php");
        //$res= $mysqli->query($sql_delete) or die("Failed".mysql_error());
        // if($res == 0) echo "failed!";
        // echo "<meta http-equiv='refresh' content='0;url=favourite.php'";
    }
