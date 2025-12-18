<?php
session_start();
unset($_SESSION['USER-ID']);
echo '<script> location.href="login.php"</script>';
die();