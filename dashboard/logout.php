<?php
session_start();

if(isset($_SESSION['user'])) {
	session_destroy();
	header('Location: ../user/login.php');
} else {
	header('Location: ../user/login.php');
}

 ?>