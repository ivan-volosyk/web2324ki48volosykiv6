<?php
$host = "localhost";
$db   = "feedback_db";
$user = "root";
$pass = "";
$conn = new mysqli($host, $user, $pass, $db);

$name = $_REQUEST["name"];
$email = $_REQUEST["email"];
$message = $_REQUEST["message"];
$stmt = $conn->prepare("INSERT INTO feedback_table (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);
$stmt->execute();
$stmt->close();
$conn->close();

?>