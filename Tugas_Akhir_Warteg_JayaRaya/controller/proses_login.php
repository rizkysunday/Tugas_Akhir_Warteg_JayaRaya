<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$user = "rizky";
$pass = "12345";

if($username == $user && $password == $pass){

$_SESSION['login'] = true;
$_SESSION['username'] = $username;

if(isset($_POST['remember'])){
setcookie("username",$username,time()+(86400*7),"/");
}

header("Location: ../index.php");
exit;

}else{

header("Location: ../login.php?error=1");
exit;

}
?>