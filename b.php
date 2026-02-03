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
    <h1>b.php</h1>

    <?php
    echo $_SESSION['name'];
    echo $_SESSION['nickname'];
    ?>
</body>
</html>
