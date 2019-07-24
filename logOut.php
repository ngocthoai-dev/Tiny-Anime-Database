<?php
setcookie("user", $_COOKIE["user"], time() - 3600, "/");
setcookie("password", $_COOKIE["password"], time() - 3600, "/");
header("location: ./logIn_signUp.php");
?>