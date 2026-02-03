<?php
    session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ธีรภัทร์ มาตวังแสง (อีคิว)</title>
</head>

<body>
    <h1>a.php</h1>

    <?php
    $_SESSION['name'] = "ธีรภัทร์ มาตวังแสง";
    $_SESSION['nickname'] ="อีคิว";
   
    
    echo $_SESSION['name'];
    echo $_SESSION['nickname'];
    ?>
</body>
</html>
