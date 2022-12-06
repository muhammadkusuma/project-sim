<?php
require 'getConnection.php';
$conn = getConnection();

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = $data["password"];
    $password2 = $data["password2"];

    // $query = "SELECT user VALUES ('','$username','$password' WHERE username='$username')";

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

function tambah_obat($data)
{
    global $conn;
    $fotoObat = upload();
    if (!$fotoObat) {
        return false;
    }

    $nama_obat = $data["nama_obat"];
    $kategori_obat = $data["kategori_obat"];
    $harga_obat = $data["harga_obat"];
    $stok_obat = $data["stok_obat"];
    $exp_obat = $data["exp_obat"];

    $sql = "INSERT INTO barang (foto_obat, nama_obat, kategori_obat, harga_obat, stok_obat, exp_obat) 
    VALUES ('$fotoObat','$nama_obat','$kategori_obat','$harga_obat','$stok_obat','$exp_obat')";
    $conn->exec($sql);

    return $conn->lastInsertId();
}

function upload()
{
    $namaFile = $_FILES['fotoObat']['name'];
    $ukuranFile = $_FILES['fotObat']['size'];
    $error = $_FILES['fotoObat']['error'];
    $tmpName = $_FILES['fotoObat']['tmp_name'];

    if ($error == 4) {
        echo "<script>
            alert('pilih gambar terlebih dahulu');
        </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
            alert('file yang diupload bukan gambar');
        </script>";
        return false;
    }

    if ($ukuranFile > 5000000) {
        echo "<script>
            alert('ukuran gambar terlalu besar, dibawah 5Mb');
        </script>";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/' . $namaFileBaru);

    return $namaFileBaru;
}

function query($query)
{
    global $conn;
    $result = $conn->query($query);
    $rows = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }

    return $rows;
}
