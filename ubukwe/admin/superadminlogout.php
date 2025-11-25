<?php
session_start();
unset($_SESSION['admin_username']);
session_destroy();
echo "<script>window.open('./superadminlogin.php','_self');</script>";
?>