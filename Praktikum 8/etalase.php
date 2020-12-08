<?php 
$conn = mysqli_connect("localhost","root","","arcraf");

$result = mysqli_query($conn,"SELECT * FROM tb_produk");
$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Acraf | Art and Handcraf</title>
    <!-- meta tag -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="3600">
    <meta name="keywords" content="Art and Handcraf">
    <meta name="description" content="Platform penjualan barang seni dan kerajinan tangan">
    <meta name="author" content="Tim Acraf">
    <!-- link css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/fe118aecdc.js" crossorigin="anonymous"></script>
</head>
<body data-spy="scroll" data-target="#navbarResponsive" class="bg-light">

    <!-- navbar -->
    <div id="home">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="informasi-toko.html"><img src="img/logos.png" alt=""></a>
            <h4 class="mr-2 mt-1 text-white">Seller</h4>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <!-- start right nav -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> Profil</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="profil.html">My Acount</a>
                            <a class="dropdown-item" href="informasi-toko.html">My Store</a>
                            <a class="dropdown-item" href="../index.html">Back to ACRAFT</a>
                            <a class="dropdown-item" href="../login.html">Log Out</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Pesanan 1</a>
                        <a class="dropdown-item" href="#">Pesanan 2</a>
                        <a class="dropdown-item" href="#">Pesanan 3</a>
                        <a class="dropdown-item" href="#">Pesanan 3</a>
                        </div>
                    </li>
                    <li>
                    <form class="form-inline">
                    <div id="top-search">
                        <input class="form-control mr-sm-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-warning my-2 my-sm-0 rounded-pill" type="submit">Search</button>
                    </div>
                    </form>
                </li>
                </ul>
                <!-- end right nav -->
            </div>
        </nav>
    </div>
    <!--end navbar -->

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-white font-weight-bold" style="background-color: #780116;"><i class="fas fa-list mr-2"></i> MENU</li>
            <a href="informasi-toko.html" class="list-group-item list-group-item-action"><i class="fas fa-store mr-2"></i> Informasi Toko</a>
            <a href="etalase.php" class="list-group-item list-group-item-action"><i class="fas fa-boxes mr-2"></i> Etalase</a>
            <a href="pesanan-baru.html" class="list-group-item list-group-item-action"><i class="fas fa-shopping-cart mr-2"></i> Pesanan</a>
        </ul>
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-white font-weight-bold" style="background-color: #780116;"><i class="fas fa-list mr-2"></i> KATEGORI</li>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-palette mr-2"></i> Paint</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-couch mr-2"></i> Furniture</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-shapes mr-2"></i> Handcraft</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-gift mr-2"></i> Souvenir</a>
            <a href="#" class="list-group-item list-group-item-action"><i class="fab fa-atlassian mr-2"></i> Statue</a>
        </ul>
    </div>
    <!-- end seidebar -->

    <!-- content -->
    <div class="main">
        <!-- sub-navbar -->
        <div id="sub-nav">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                <span class="navbar-brand"><h4 class="color-palette1"><i class="fas fa-boxes mr-2"></i> ETALASE</h4></span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- right nav -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Semua Kategori</a>
                            <a class="dropdown-item" href="#">Paint</a>
                            <a class="dropdown-item" href="#">Furniture</a>
                            <a class="dropdown-item" href="#">Handcraft</a>
                            <a class="dropdown-item" href="#">Souvenir</a>
                            <a class="dropdown-item" href="#">Statue</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Urutkan</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Terbaru</a>
                                <a class="dropdown-item" href="#">Terlama</a>
                                <a class="dropdown-item" href="#">Harga Tertinggi</a>
                                <a class="dropdown-item" href="#">Harga Termurah</a>
                                <a class="dropdown-item" href="#">Tersedia</a>
                                <a class="dropdown-item" href="#">Habis</a>
                            </div>
                        </li>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2 rounded-pill" type="search" placeholder="Cari barang di toko ini" aria-label="Search">
                            <button class="btn btn-outline-dark my-2 my-sm-0 rounded-pill" type="submit">Search</button>
                        </form>
                    </ul>
                </div>
                <!-- end right nav -->
            </nav>
        </div>
        <!-- end sub-navbar -->
                
        <!-- menu dibawah navbar -->
        <div class="row mt-3">
            <div class="col-md-8 mt-2">
                <h5>Semua Kategori</h5>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="tambah-barang.php" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i><b>Tambah Barang</b></a>
            </div>   
        </div>
        <!-- end menu dibawah navbar -->

        <!-- item -->
        <div class="row mt-4">
            <!-- produk -->
            <?php foreach ($items as $item) { ?>
            <div class="col-sm-3">
                <div class="card" style="width: 15rem;" >
                    <a href="deskripsi-barang.php?id_produk=<?= $item['id_produk']; ?>"> <img src="img/<?= $item['gambar']; ?>" class="card-img-top" alt=""></a>
                    <div class="card-body bg-white">
                        <h5 class="card-title color-palette1"><?= $item['nama']; ?></h5>
                        <div class="row">
                            <div class="col-md-7 h6"><p class="text-success">Rp. <?= $item['harga']; ?></p></div>
                            <div class="col-md-5 text-right font-weight-bold h6"><?= $item['status']; ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="deskripsi-barang.php?id_produk=<?= $item['id_produk']; ?>" class="btn btn-outline-primary btn-block rounded-pill">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <a href="" class="btn btn-outline-danger btn-block rounded-pill" data-target="#modalHapus" data-toggle="modal">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        


        </div>
                <div class="row justify-content-end page-number mt-4 mr-2">
                    <p>Page : &nbsp&nbsp&nbsp</p>
                    <span class='btn color-edit2 rounded-circle ml-1'><a style='text-decoration:none;' class="text-dark"href="#">1</a></span>
                    <span class='btn color-edit2 rounded-circle ml-1'><a style='text-decoration:none;' class="text-dark"href="#">2</a></span>
                    <span class='btn color-edit2 rounded-circle ml-1'><a style='text-decoration:none;' class="text-dark"href="#">3</a></span>
                </div>
        <!-- end item -->
    </div>
    <!-- end content -->

    <!-- modal hapus -->
    <div class="modal fade" id="modalHapus" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Attention</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin ingin menghapus item ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="delete.php?id_produk=<?= $item['id_produk']; ?>" class="btn btn-primary">Ya, hapus</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal hapus -->
    <br>
</body>
    <!-- javacript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script.js"></script>
</html>