<?php 
// session_start();
    
include 'koneksi.php';
if ($_SESSION['login']) {
    $id_user = $_SESSION["id_user"];
    if (!$_SESSION['toko']) {
        header("Location: tambah-toko.php");
    }
}
else {
    header("Location: login.php");
}

$id_user = $_SESSION["id_user"];
// $id_user = '1';

# QUERY READ DATA
$query = "SELECT i.* FROM item i INNER JOIN toko t USING (id_toko) INNER JOIN users u USING (id_user) WHERE u.`id_user`=$id_user ";

// QUERY SEARCH
if (isset($_POST['cari'])) {
    $key=$_POST['key'];
    if ($key!='') {
        $query .= "AND (nama_item LIKE '%$key%' OR kategori LIKE '%$key%' OR status_item LIKE '%$key%') ";        
    }
}

# RUN QUERY
$conn = mysqli_connect("localhost","root","","acraf");
if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    if (isset($_GET['urutan'])) {
        $urutan = $_GET['urutan'];
        if ($urutan == 'Tersedia' or $urutan == 'Kosong') {
            $query .= "AND kategori='$kategori' AND status_item='$urutan'";
        }elseif ($urutan=='Harga Tertinggi') {
            $query .= "AND kategori='$kategori' ORDER BY harga DESC";
        }elseif ($urutan=='Harga Termurah') {
            $query .= "AND kategori='$kategori' ORDER BY harga ASC";
        }
    }else {
        $query .= "AND kategori='$kategori'";
    }
}else{
    if (isset($_GET['urutan'])) {
        $urutan = $_GET['urutan'];
        if ($urutan == 'Tersedia' or $urutan == 'Kosong') {
            $query .= "AND status_item='$urutan'";
        }elseif ($urutan=='Harga Tertinggi') {
            $query .= "ORDER BY harga DESC";
        }elseif ($urutan=='Harga Termurah') {
            $query .= "ORDER BY harga ASC";
        }
    }
}

# PAGINATION
$result = mysqli_query($conn,$query);
$count_row = mysqli_num_rows($result);
$jum_halaman = ceil($count_row/8);
$index = 0;
if (isset($_GET['halaman'])) {
    $page=$_GET['halaman'];
    $index = (8 * $page) - 8;
}

# INPUT DATA IN ARRAY
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
    <?php include 'navbar-seller.php' ?>
    <!--end navbar -->


    <!-- Sidebar -->
    <?php include 'sidebar-seller.php' ?>
    <!-- end seidebar -->

    <!-- content -->
    <div class="main">
        <!-- sub-navbar -->
        <div id="sub-nav">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                <a href="etalase.php" class="navbar-brand"><h4 class="color-palette1"><i class="fas fa-boxes mr-2"></i> ETALASE</h4></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- right nav -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="etalase.php">Semua Kategori</a>
                            <a class="dropdown-item" href="?kategori=Paint">Paint</a>
                            <a class="dropdown-item" href="?kategori=Furniture">Furniture</a>
                            <a class="dropdown-item" href="?kategori=Handcraft">Handcraft</a>
                            <a class="dropdown-item" href="?kategori=Souvenir">Souvenir</a>
                            <a class="dropdown-item" href="?kategori=Statue">Statue</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Urutkan</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (isset($kategori)) { ?>
                                    <a class="dropdown-item" href="?kategori=<?= $kategori; ?>&urutan=Harga Tertinggi">Harga Tertinggi</a>
                                    <a class="dropdown-item" href="?kategori=<?= $kategori; ?>&urutan=Harga Termurah">Harga Termurah</a>
                                    <a class="dropdown-item" href="?kategori=<?= $kategori; ?>&urutan=Tersedia">Tersedia</a>
                                    <a class="dropdown-item" href="?kategori=<?= $kategori; ?>&urutan=Kosong">Kosong</a>
                                <?php } else { ?>
                                    <a class="dropdown-item" href="?urutan=Harga Tertinggi">Harga Tertinggi</a>
                                    <a class="dropdown-item" href="?urutan=Harga Termurah">Harga Termurah</a>
                                    <a class="dropdown-item" href="?urutan=Tersedia">Tersedia</a>
                                    <a class="dropdown-item" href="?urutan=Kosong">Kosong</a>
                                <?php } ?>
                            </div>
                        </li>
                        <form action="" method="POST" class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2 rounded-pill" name="key" type="search" placeholder="Cari barang di toko ini" aria-label="Search" autocomplete="off">
                            <button class="btn btn-outline-dark my-2 my-sm-0 rounded-pill" name="cari" type="submit">Search</button>
                        </form>
                    </ul>
                </div>
                <!-- end right nav -->
            </nav>
        </div>
        <!-- end sub-navbar -->
                
        <!-- menu dibawah navbar -->
        <div class="row mt-3">
            <?php if (isset($kategori)) { ?>
                <div class="col-md-8 mt-2">
                    <h5><?= $kategori; ?> <?php if(isset($urutan)) echo " > " . $urutan; ?></h5>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="tambah-barang.php?kategori=<?= $kategori; ?>" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i><b>Tambah Barang</b></a>
                </div>   
            <?php }else { ?>
                <div class="col-md-8 mt-2">
                    <h5>Semua Kategori <?php if(isset($urutan)) echo "> " . $urutan; ?></h5>
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="tambah-barang.php" class="btn btn-success"><i class="fas fa-plus-circle mr-2"></i><b>Tambah Barang</b></a>
                </div>
            <?php } ?>
        </div>
        <!-- end menu dibawah navbar -->

    <?php if ($count_row>0) { ?>
        <!-- item -->
        <?php 
        for ($i=0; $i <= 1; $i++) { ?>
            <div class="row mt-4">
            <?php 
            for ($j=0; $j < 4 ; $j++) { 
                if (isset($items[$index])) { ?>
                    <div class="col-sm-3">
                        <div class="card" style="width: 15rem;" >
                            <a href="deskripsi-barang.php?id=<?= $items[$index]['id_item']; ?>"><img src="img/<?= $items[$index]['gambar_item']; ?>" class="card-img-top" alt=""></a>
                            <div class="card-body bg-white">
                                <h5 class="card-title color-palette1"><?= $items[$index]['nama_item']; ?></h5>
                                <div class="row">
                                    <div class="col-md-7 h6"><p class="text-success">Rp <?= $items[$index]['harga']; ?></p></div>
                                    <div class="col-md-5 text-right font-weight-bold h6"><?= $items[$index]['status_item']; ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="deskripsi-barang.php?id=<?= $items[$index]['id_item']; ?>#edit" class="btn btn-outline-primary btn-block rounded-pill">Edit</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-outline-danger btn-block rounded-pill" onclick="deleteitem(<?= $items[$index]['id_item']; ?>)">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                        
                <?php
                $index++;
                }
            } ?>
            </div>
        <?php
        }
        ?>

        <!-- pagination -->
        <div class="row justify-content-end page-number mt-4 mr-2">
            <p>Page : &nbsp&nbsp&nbsp</p>
            <?php for ($i=1; $i <= $jum_halaman; $i++) { 
                if (isset($kategori)) {
                    if (isset($urutan)) { ?>
                        <span class='btn color-edit2 rounded-circle ml-1'><a style='text-decoration:none;' class="text-dark"href="?kategori=<?= $kategori; ?>&urutan=<?= $urutan; ?>&halaman=<?= $i; ?>"><?= $i; ?></a></span>
                    <?php } else { ?>
                        <span class='btn color-edit2 rounded-circle ml-1'><a style='text-decoration:none;' class="text-dark"href="?kategori=<?= $kategori; ?>&halaman=<?= $i; ?>"><?= $i; ?></a></span>
                    <?php }
                } else {
                    if (isset($urutan)) { ?>
                        <span class='btn color-edit2 rounded-circle ml-1'><a style='text-decoration:none;' class="text-dark"href="?urutan=<?= $urutan; ?>&halaman=<?= $i; ?>"><?= $i; ?></a></span>
                    <?php } else { ?>
                        <span class='btn color-edit2 rounded-circle ml-1'><a style='text-decoration:none;' class="text-dark"href="?halaman=<?= $i; ?>"><?= $i; ?></a></span>
                    <?php } 
                } ?>
            <?php } ?>
        </div>
        <!-- end pagination -->

        <!-- end item -->
    <?php } ?>
    </div>
    <!-- end content -->

    <!-- modal hapus -->
    <div class="modal fade" id="deletemodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Hapus Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="delete-item.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <!-- <p>Apakah anda yakin ingin menghapus item ini?</p> -->
                        <p>Jika anda menghapus item ini, semua pesanan dengan item ini akan ditolak.</p>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="delete_item" class="btn btn-primary"> Hapus</button>
                    </div>
                </form>
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


    <script language="javascript">
        function deleteitem(id){
            // open modal
            $('#deletemodal').modal('show');
            // set id
            $('#delete_id').val(id);
        }
    </script>
</html>