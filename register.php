<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container py-5">
        <?php
        if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
 
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
 
            $errors = array();
 
            if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
             array_push($errors,"All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
             array_push($errors, "Email is not valid");
            }
            if (strlen($password)<8) {
             array_push($errors,"Password must be at least 8 charactes long");
            }
            if ($password!==$passwordRepeat) {
             array_push($errors,"Password does not match");
            }
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
             array_push($errors,"Email already exists!");
            }
            if (count($errors)>0) {
             foreach ($errors as  $error) {
                 echo "<div class='alert alert-danger'>$error</div>";
             }
            }else{
 
             $sql = "INSERT INTO users (fullname, email, password) VALUES ( ?, ?, ? )";
             $stmt = mysqli_stmt_init($conn);
             $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
             if ($prepareStmt) {
                 mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $password);
                 mysqli_stmt_execute($stmt);
                 echo "<div class='alert alert-success'>You are registered successfully.</div>";
             }else{
                 die("Something went wrong");
             }
            }
         }
        ?>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-header bg-dark text-white text-center">Register</div>
                        <div class="card-body">
                            <form action="register.php" method="post">
                                <div class="form-group">
                                    <label for="fullname">Full Name:</label>
                                    <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Enter Full Name" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="repeat_password">Repeat Password:</label>
                                    <input type="password" id="repeat_password" name="repeat_password" class="form-control" placeholder="Repeat Password" required>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="submit" value="Register" name="submit" class="btn btn-dark btn-block">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="login.php" class="btn btn-outline-secondary">Login Here</a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>