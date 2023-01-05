<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../frontend/login.php");
    exit;
}
require '../../backend/function.php';


$id = $_GET['id_transaksi'];


// update status di database transaksi
$sql = query("update transaksi set status = 'DIBATALKAN' where id_transaksi = '$id'");

header("Location: admin-transaksi.php");