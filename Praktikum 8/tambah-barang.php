<?php 

$conn = mysqli_connect("localhost","root","","arcraf");

if (isset($_POST["submit"])) {
	$nama = $_POST["nama"];
    $kategori = $_POST["kategori"];
    $harga = $_POST["harga"];
    $stok = $_POST["stok"];
    $status = $_POST["status"];
    $dikirim_dari = $_POST["dikirim_dari"];
    $gambar = $_POST["gambar"];
    $deskripsi = $_POST["deskripsi"];


	mysqli_query($conn,"INSERT INTO tb_produk VALUES ('','$nama','$kategori','$harga','$stok','$dikirim_dari','$status','$gambar','$deskripsi')");

	if (mysqli_affected_rows($conn)>0) {
		echo "
			<script>
				alert('data berhasil ditambahkan');
				document.location.href = 'etalase.php';
			</script>
		";
    }
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
    <div id="navbar-top">
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

    <!-- form input barang -->
    <div class="main">
        <form action="" method="post">
            <!-- sub-navbar -->
            <div id="sub-nav">
                <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                    <span class="navbar-brand"><h4 class="color-palette1"><i class="far fa-plus-square mr-2"></i> TAMBAH BARANG</h4></span>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- right nav -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <button class="btn btn-success btn-sm my-2 my-lg-0 ml-auto" type="submit" name="submit">SIMPAN</button>
                            <a href="etalase.php" class="btn btn-danger btn-sm ml-2">BATAL</a>
                        </ul>
                    </div>
                    <!-- end right nav -->
                </nav>
            </div>
            <!-- end sub-navbar -->
        
            <!-- input data2 -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" name="nama" class="form-control" id="nama" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" class="form-control" id="kategori" required>
                            <option value="Paint">Paint</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Handcraft">Handcraft</option>
                            <option value="Souvenir">Souvenir</option>
                            <option value="Statue">Statue</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" class="form-control" id="harga" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="number" name="stok" class="form-control" id="stok" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="dikirim_dari">Dikirim Dari</label>
                        <input type="text" name="dikirim_dari" class="form-control" id="dikirim_dari" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" name="gambar" class="form-control-file" id="gambar" required>
                        <!-- <small>Maksimal 5 gambar</small> -->
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="7"></textarea>
            </div>
            <!-- end form input barang -->
        </form>
    </div>
    <!-- end form -->
    <br>
</body>
    <!-- javacript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script.js"></script>
</html>