<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apotik Jaya Abadi</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="frontend/css/style.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-md">
            <a class="navbar-brand" href="#">Apotik Jaya Abadi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cara Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- caraousel -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="..." class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- produk terbaru -->
    <section id="terbaru">
        <div class="container-md mt-3 card p-4">
            <div class="row">
                <div class="col-md-12">
                    <h2>Produk Terbaru</h2>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Nama Obat</h5>
                            <p class="card-text">Kegunaan</p>
                            <p class="btn btn-outline-danger">Dengan Resep</p>
                            <br>
                            <a href="#" class="btn btn-primary btn-beli">Beli</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-2">
                    <a href="#">Lihat Produk lainnya</a>
                </div>
            </div>
        </div>
    </section>
    <!-- produk unggulan -->
    <section id="unggulan">
        <div class="container-md mt-3 card p-4">
            <div class="row">
                <div class="col-md-12">
                    <h2>Produk Unggulan</h2>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Nama Obat</h5>
                            <p class="card-text">Kegunaan</p>
                            <p class="btn btn-outline-danger">Dengan Resep</p>
                            <br>
                            <a href="#" class="btn btn-primary btn-beli">Beli</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-2">
                    <a href="#">Lihat Produk lainnya</a>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <div class="row">
                <!-- tentang kami -->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Tentang Kami</h5>
                    <p>
                        Apotik Jaya Abadi adalah apotik yang berada di Jl. Raya Cibadak No. 1, Cibadak, Kec. Cibadak,
                        Kota Tasikmalaya, Jawa Barat 46151
                    </p>
                </div>
                <!-- kontak -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Kontak</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-dark">Telp : 0265-321321</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Email :</a>
                        </li>
                    </ul>
                </div>
                <!-- sosial media -->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Sosial Media</h5>
                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-dark">Facebook</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Instagram</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2022 Apotik Jaya Abadi
        </div>
    </footer>

    <script src="bootstrap/js/bootstrap.js"></script>
</body>

</html>