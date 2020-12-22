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

$conn = mysqli_connect("localhost","root","","acraf");  
$result = mysqli_query($conn,"SELECT * FROM toko WHERE id_user = $id_user");
$toko = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    // $result=mysqli_query($conn,"SELECT * FROM item ORDER BY id_item DESC LIMIT 1");
    // if($result){
    //     $last_item = mysqli_fetch_assoc($result);
    //     $id_item = $last_item['id_item'] + 1;
    // }else{
    //     $id_item = 1;
    // }

    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];
    $id_toko = $toko['id_toko'];
    $error = $_FILES['gambar']['error'];

    if ($error === 4) {
        $namaGambar = 'no-image.png';
    }else{
        $namaGambar = $id_toko."-".$_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmpName, 'img/'.$namaGambar);
    }

    mysqli_query($conn,"INSERT INTO item VALUES ('','$nama',$stok,'$status','$deskripsi','$namaGambar','$kategori',$harga,$id_toko);");

    if (mysqli_affected_rows($conn)>0) {
        $result=mysqli_query($conn,"SELECT * FROM item WHERE id_toko=$id_toko ORDER BY id_item DESC LIMIT 1");
        $id_new = mysqli_fetch_assoc($result);
        $id = $id_new['id_item'];
        // $items = [];
        // while ($row = mysqli_fetch_assoc($result)) {
        //     $items[] = $row;
        // }
        // echo "<script>
        //         $('#gagal').modal('show');
        //     </script>";
        header("location:deskripsi-barang.php?id=$id");
        exit;
    }

}


if (isset($_GET['kategori'])) {
    $kategori=$_GET['kategori'];
}

$arr_kategori = ['Paint','Furniture','Handcraft','Souvenir','Statue'];

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

    <!-- form input barang -->
    <div class="main">
        <form action="" method="POST" enctype="multipart/form-data">
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
            <!-- <input type="hidden" name="id_toko" value="<?= $toko['id_toko']; ?>"> -->
            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="form-group">
                    <label for="exampleFormControlInput1">Nama Produk</label>
                    <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kategori</label>
                        <select class="form-control" name="kategori" id="exampleFormControlSelect1" required>
                            <?php if (isset($kategori)){ ?>
                                <option value="<?= $kategori; ?>"><?= $kategori; ?></option>
                            <?php } else { 
                                $kategori='nul';
                            } ?>

                            <?php for ($i=0; $i < 5; $i++) { 
                                if ($arr_kategori[$i]!=$kategori) { ?>
                                    <option value="<?= $arr_kategori[$i]; ?>"><?= $arr_kategori[$i]; ?></option>
                                <?php }
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Harga</label>
                        <input type="number" class="form-control" name="harga" id="exampleFormControlInput1" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Stok</label>
                        <input type="number" class="form-control" name="stok" id="exampleFormControlInput1" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Status</label>
                        <select class="form-control" name="status" id="exampleFormControlSelect1" required>
                            <option value="tersedia">Tersedia</option>
                            <option value="kosong">Kosong</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Dikirim Dari</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $toko['alamat_toko']; ?>" style="background-color:rgb(255, 255, 255);" readonly>
                        <small>*hanya dapat diubah pada halaman informasi toko</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Gambar</label>
                        <input type="file" accept=".jpg,.jpeg,.png" class="form-control-file" id="exampleFormControlFile1" name="gambar">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="7"></textarea>
            </div>
            <!-- end form input barang -->
        </form>
    </div>
    <!-- end form -->
    <br>

    <!-- modal -->
    <div class="modal fade" id="gagal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Gagal menambah item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal -->
</body>
    <!-- javacript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script.js"></script>
</html>