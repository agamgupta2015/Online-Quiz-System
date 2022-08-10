<?php 
# Logout function for Admin Login
session_start();
if(isset($_SESSION['email'])){
session_destroy();}
$ref= @$_GET['q'];
header("location:index.php");
?>