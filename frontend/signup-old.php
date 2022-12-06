<!-- <?php
// session_start();
// require '../backend/function.php';

// if (isset($_POST["register"])) {
    // if (registrasi($_POST) > 0) {
        // echo "<script>
                    // alert('Akun baru berhasil dibuat!');
                    // document.location.href = 'login.php';
                // </script>";
    // } else {
        // echo PDO::errorInfo();
    // }
// } -->
// ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Area</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body id="signup">
    <div class="container-fluid container-signup">
        <div class="row row-signup">
            <div class="col card signup">
                <form action="" method="post" class="card-body card-signup">
                    <h3 class="card-title text-center mb-4">Signup</h3>
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
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password2" placeholder="Confirmation Password"
                            name="password2" required>
                        <label for="Password">Confirmation Password</label>
                    </div>
                    <button type="submit" name="register" class="btn btn-primary mb-1 btn-signup">Signup</button>
                    <a href="../index.php" class="btn btn-outline-primary mb-3 btn-signup">Back</a>
                </form>


            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.js"></script>
</body>

</html>