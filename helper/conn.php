<?php
$host = 'localhost';
$user = 'kala';
$password = 'kala';
$database = 'zillion';

$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 ?>