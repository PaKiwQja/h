<?php
echo "<h3>รหัสสำหรับ Admin คนที่ 1 (1234)</h3>";
echo password_hash("1234", PASSWORD_DEFAULT);
echo "<hr>";

echo "<h3>รหัสสำหรับ Admin คนที่ 2 (4321)</h3>";
echo password_hash("4321", PASSWORD_DEFAULT);
?>