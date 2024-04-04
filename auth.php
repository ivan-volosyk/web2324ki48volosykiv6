<?php
session_start();
            $email = $_POST["email"];
            $password= "temp";
            $username="temp";

         require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

           if ($user) {

            }else{

                $sql = "INSERT INTO users (email, password,username) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {

                mysqli_stmt_bind_param($stmt,"sss", $email, $password,$username);
                mysqli_stmt_execute($stmt);

                 $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            }else{
                die("Something went wrong");
            }
            }

             $_SESSION["user"] = $user;
                header("Location: index.php");
                 die();

?>