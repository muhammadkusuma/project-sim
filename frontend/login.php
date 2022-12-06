<?php
session_start();
require '../backend/function.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql="SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            header("Location: ../index.php");
            exit;
        }
    }
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Area</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="login">
    <div class="container-fluid container-login">
        <div class="row row-login">
            <div class="col card login">

                <form action="" method="post" class="card-body card-login">
                    <h3 class="card-title text-center mb-4">Login Please</h3>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Username"
                            name="username" required>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password"
                            name="password" required>
                        <label for="Password">Password</label>
                    </div>
    
                    <button type="submit" name="login" class="btn btn-primary mb-1 btn-login">Login</button>
                    <a href="../index.php" class="btn btn-outline-primary mb-3 btn-login">Back</a>
                </form>


            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.js"></script>
</body>

</html>