<?php 
session_start();
if (!isset($_SESSION['manager'])) {
    header("Location: ../frontend/login.php");
    exit;
}
require '../../backend/function.php';
echo 'Halaman Manager';
