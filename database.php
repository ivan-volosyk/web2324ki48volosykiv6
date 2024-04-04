<?php
$host = "localhost";
$db   = "google_db";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);

$sql_users = "CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
  )";
  
if ($conn->query($sql_users) !== TRUE) {
 echo "Error creating users table: " . $conn->error;
}

?>