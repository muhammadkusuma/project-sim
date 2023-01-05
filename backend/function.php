<?php
require 'getConnection.php';
$conn = getConnection();


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
function registrasi($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = $data["password"];
    $password2 = $data["password2"];

    if ($password !== $password2) {
        echo "<script>
            alert('konfirmasi password tidak sesuai');
        </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password,level) VALUES ('$username','$password','pembeli')";
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
    $ukuranFile = $_FILES['fotoObat']['size'];
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


function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $nama_obat = $data["nama_obat"];
    $kategori_obat = $data["kategori_obat"];
    $harga_obat = $data["harga_obat"];
    $stok_obat = $data["stok_obat"];
    $exp_obat = $data["exp_obat"];
    $fotoLama = $data["fotoLama"];

    if ($_FILES['fotoObat']['error'] === 4) {
        $fotoObat = $data['fotoLama'];
    } else {
        $fotoObat = upload();
    }

    $sql = "UPDATE barang SET nama_obat='$nama_obat', kategori_obat='$kategori_obat', harga_obat='$harga_obat', stok_obat='$stok_obat', exp_obat='$exp_obat', foto_obat='$fotoObat' WHERE id_obat=$id";
    $conn->exec($sql);

    return $conn->lastInsertId();
}


function hapus($id)
{
    global $conn;
    $sql = "DELETE FROM barang WHERE id_obat=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    return $stmt->rowCount();
}


function beli($data)
{
    global $conn;
    $id = $data["id_obat"];
    $jumlah_obat = $data["jumlah_obat"];
    $harga_obat = $data["harga_obat"];
    $nama= $data["nama"];
    $alamat= $data["alamat"];
    $nohp= $data["hp"];
    $jumlahobat = intval($jumlah_obat);
    $hargaobat = intval($harga_obat);
    $hargaasli = $jumlahobat * $hargaobat;
    $id_pendaftar=$_SESSION['id'];
    // $harga= strval($hargaasli);
    $harga = "$hargaasli";

    $sql = "INSERT INTO transaksi (id_obat, jumlah, total_harga, status, tanggal)
                    VALUES ($id, $jumlah_obat, $hargaasli, 'DIPROSES',curdate())";
    $sql .= "UPDATE barang SET stok_obat = stok_obat - $jumlah_obat WHERE id_obat = $id;";
    $conn->exec($sql);
    var_dump($sql);
    // die;
    return $conn->lastInsertId();

    // $sql=query("INSERT INTO transaksi (id_obat, jumlah, total_harga, status, tanggal)
    //                 VALUES ('$id', '$jumlah_obat', '$hargaasli', 'DIPROSES',curdate())");
    // $sql=query("UPDATE barang SET stok_obat = stok_obat - $jumlah_obat WHERE id_obat = $id");




    // $id = $_GET["id_obat"];
    // $jumlah_obat = $data["jumlah_obat"];
    // $harga_obat = $data["harga_obat"];
    // $nama= $data["nama"];
    // $alamat= $data["alamat"];
    // $nohp= $data["hp"];
    // $jumlahobat = intval($jumlah_obat);
    // $hargaobat = intval($harga_obat);
    // $hargaasli = $jumlahobat * $hargaobat;
    // $id_pendaftar=$_SESSION['id'];
    // // $harga= strval($hargaasli);
    // $harga = "$hargaasli";

    // $sql = "INSERT INTO transaksi (id_obat, jumlah, total_harga, status, tanggal, nama, alamat, hp, id_pendaftar)
    //                 VALUES ('$id', '$jumlah_obat', '$hargaasli', 'DIPROSES',curdate()), '$nama','$alamat','$nohp','$id_pendaftar')";
    // $sql .= "UPDATE barang SET stok_obat = stok_obat - $jumlah_obat WHERE id_obat = $id;";
    // $conn->exec($sql);
    // var_dump($sql);
    // // die;
    // return $conn->lastInsertId();
    
}


function unik()
{
    $abc = rand(1000, 9999);
    return $abc;
}