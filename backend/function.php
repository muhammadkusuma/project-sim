<?php
require 'getConnection.php';
$conn = getConnection();

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = $data["password"];
    $password2 = $data["password2"];

    $query = "SELECT user VALUES ('','$username','$password' WHERE username='$username')";

    if ($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username','$password')";
    $conn->exec($sql);

    return $conn->lastInsertId();
}
