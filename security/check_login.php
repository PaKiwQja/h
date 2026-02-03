<?php
    session_start();
    if(empty($_SESSION['aid'])){
        echo"Access Denied";
        echo'<meta http-equiv="refresh" content="5; url=http://10.119.195.230/h/index.php">';
        exit;
    }
?>