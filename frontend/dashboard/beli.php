<?php

require '../../backend/function.php';
session_start();

$id = $_GET["id_obat"];
$id_pendaftar = $_SESSION['id'];

// query data produk berdasarkan id
$obat = query("SELECT * FROM barang WHERE id_obat = $id")[0];
// $obat = query("Select * from barang;");


if (isset($_POST["beli"])) {
    // if (beli($_POST) == 0) {
    //     echo "
    //         <script>
    //             alert('pembelian berhasil');
    //             document.location.href = '../dashboard/transaksi.php';
    //         </script>
    //     ";
    // } else {
    //     echo "
    //         <script>
    //             alert('gagal pembelian');
    //             document.location.href = '../frontend/dashboard/user.php';
    //         </script>
    //     ";
    // }

    $id = $_GET["id_obat"];
    $jumlah_obat = $_POST["jumlah_obat"];
    $harga_obat = $_POST["harga_obat"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $nohp = $_POST["hp"];
    $jumlahobat = intval($jumlah_obat);
    $hargaobat = intval($harga_obat);
    $hargaasli = $jumlahobat * $hargaobat;
    // $harga= strval($hargaasli);
    $harga = "$hargaasli";
    $kode_unik = rand(1000, 9999);

    $sql = "INSERT INTO transaksi (id_obat, jumlah, total_harga, status, tanggal, id_pendaftar, kode_unik)
                    VALUES ('$id', '$jumlah_obat', '$hargaasli', 'DIPROSES',curdate(),$id_pendaftar, $kode_unik);";
    $sql .= "UPDATE barang SET stok_obat = stok_obat - $jumlah_obat WHERE id_obat = $id;";
    $conn->exec($sql);
    // nambah data pengirim
    $sql1 = "INSERT INTO penerima (id_pendaftar, id_obat, nama_penerima, alamat_penerima, no_telp_penerima, kode_unik)
                    VALUES ($id_pendaftar,'$id', '$nama', '$alamat', '$nohp', $kode_unik);";
    $conn->exec($sql1);
    header("Location: ../dashboard/transaksi.php");
    return $conn->lastInsertId();
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="assets/css/shared/iconly.css">

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="index.html">
                                <img src="assets/images/logo/favicon.png" alt="Logo" srcset="">
                            </a>

                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  active ">
                            <a href="user.php" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="transaksi.php" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>


                        <li class="sidebar-item">
                            <a href="../../backend/logout.php" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Log Out</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>



            <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row ">
                        <div class="col">
                            <div class="card">
                                <div class="col-md card-body">
                                    <div class="form-group">
                                        <!-- menampilkan gambar -->
                                        <label for="jumlah_obat">Foto Obat</label>
                                        <br>
                                        <img src="../img/<?= $obat["foto_obat"]; ?>" width="150">
                                    </div>
                                    <div class="form-group mt-2">
                                        <input type="hidden" name="id_obat" value="<?= $obat['id_obat']; ?>">
                                        <label for="nama_obat">Nama Obat</label>
                                        <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?= $obat["nama_obat"]; ?>" readonly>

                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="harga_obat">Harga</label>
                                        <input type="number" class="form-control" id="harga_obat" name="harga_obat" value="<?= $obat["harga_obat"]; ?>" readonly>
                                        <input type="hidden" name="harga_obat" value="<?= $obat["harga_obat"]; ?>">
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="stok_obat">Stok Obat</label>
                                        <input type="number" class="form-control" id="stok_obat" name="stok_obat" value="<?= $obat["stok_obat"]; ?>" readonly>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="jumlah_obat">Jumlah Pembelian</label>
                                        <input type="number" class="form-control" id="jumlah_obat" min="1" max="100" name="jumlah_obat" required>
                                        <!--  -->
                                    </div>


                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="col">
                        <!-- detail pengiriman -->
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Pengiriman</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nama Alamat No HP -->
                                <div class="form-group mt-2">
                                    <label for="nama">Nama Penerima</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="alamat">Alamat Penerima</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="hp">No HP Penerima</label>
                                    <input type="number" class="form-control" id="hp" name="hp" required>
                                </div>
                                <div class="col-md-12">
                                    <?php
                                    $sql = query("select stok_obat from barang where id_obat='$id'");

                                    // var_dump($sql[0] ['stok_obat']);
                                    if ($sql[0]['stok_obat'] == 0) {
                                        echo "<button type='button' class='btn btn-primary' disabled>Stok Habis</button>";
                                    } else {
                                        echo "<input type='submit' class='btn btn-primary' name='beli' value='Beli'>";
                                    }
                                    ?>
                                    <!-- <input type="submit" class="btn btn-primary" name="beli" value="Beli"> -->
                                </div>
                            </div>
                        </div>
                    </div>
            </form>


        </div>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

</body>

</html>