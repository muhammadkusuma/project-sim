<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../frontend/login.php");
    exit;
}
require '../../backend/function.php';
echo "Halaman User";
