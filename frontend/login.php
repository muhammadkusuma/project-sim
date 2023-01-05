<?php
session_start();
require '../backend/function.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    $username = "SELECT username FROM users WHERE username = '$username'";
    $result1 = $conn->query($username);
    $row1= $result1->fetch(PDO::FETCH_ASSOC);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id'] = $row['id_pendaftar'];
            $_SESSION['username'] = $row1['username'];
            header("Location: dashboard/user.php");
            if ($row['level'] == 'admin') {
                $_SESSION['admin'] = true;
                $_SESSION['id'] = $row['id_pendaftar'];
                $_SESSION['username'] = $row1['username'];
                $_SESSION['level']= $row['level'];
                header("Location: dashboard/index.php");
            }
            if ($row['level'] == 'manager') {
                $_SESSION['manager'] = true;
                $_SESSION['id'] = $row['id_pendaftar'];
                $_SESSION['username'] = $row1['username'];
                $_SESSION['level']= $row['level'];
                header("Location: dashboard/manager.php");
            }
            exit;
        } else {
            $error = true;
            echo "<script>alert('Username/Password Salah')</script>";
        }
        // cek login level admin
    }
    $error = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Area</title>
    <link rel="stylesheet" href="dashboard/assets/css/main/app.css">
    <link rel="stylesheet" href="dashboard/assets/css/pages/auth.css">
    <link rel="shortcut icon" href="dashboard/assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="dashboard/assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">

                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>

                    <form action="" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <!-- <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div> -->
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3" type="submit" name="login">Log in</button>
                        <a href="../index.php" class="btn btn-outline-primary btn-block btn-lg shadow-lg mt-1">Home</a>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="signup.php" class="font-bold">Sign
                                up</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>