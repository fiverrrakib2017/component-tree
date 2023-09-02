<?php
$servername = "localhost";
$username = "root";
$password = "";
$databse_name="task";
// Create connection
$con = new mysqli($servername, $username, $password ,$databse_name);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

?>