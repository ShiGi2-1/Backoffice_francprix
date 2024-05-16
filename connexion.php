<?php
$servername = "localhost";
$username = "root";
$password = "";
$basededonnees = "franprix";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $basededonnees);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";


?>