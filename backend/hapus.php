<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header("Location: ../frontend/login.php");
    exit;
}
require 'function.php';
$id = $_GET["id_obat"];

if (hapus($id)>0){
    echo "<script>
               alert('data berhasil dihapus');
               document.location.href='../frontend/dashboard/data.php';
            </script>";

}else {
    echo "<script>
               alert('data gagal dihapus');
               document.location.href='../frontend/dashboard/data.php';
            </script>";
}
