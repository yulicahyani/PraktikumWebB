<?php 
    // include 'koneksi.php';
    // if ($_SESSION) {
    //     $id_user = $_SESSION["id_user"];
    // }
    // else {
    //     header("Location: login.php");
    // }

    // $id_user = $_SESSION["id_user"];
    // session_start();
    
    include 'koneksi.php';
    if ($_SESSION['login']) {
        $id_user = $_SESSION["id_user"];
        // if (!$_SESSION['toko']) {
        //     header("Location: tambah-toko.php");
        // }
    }
    else {
        header("Location: login.php");
    }

    $id_user = $_SESSION["id_user"]; 
    $conn = mysqli_connect("localhost","root","","acraf");
    // $id_user = 1;

    //SIMPAN DATA
    if (isset($_POST['submit'])) {
        $error = $_FILES['gambar']['error'];
        if ($error === 4) {
            $namaGambar = 'no-image.png';
        }else{
            $namaGambar = $id_toko."-".$_FILES['gambar']['name'];
            $tmpName = $_FILES['gambar']['tmp_name'];
            move_uploaded_file($tmpName, 'img/'.$namaGambar);
        }

        $nama = $_POST['nama'];
        $expert = $_POST['expert'];
        $status = $_POST['status'];
        $alamat = $_POST['alamat'];
        $id_kota = $_POST['kota'];
        $rekeneing = $_POST['rekeneing'];
        $deskripsi = $_POST['deskripsi'];
        
        mysqli_query($conn,"INSERT INTO toko VALUES ('','$id_user','$nama','$alamat','$deskripsi','$status','$namaGambar','$rekeneing','$expert',$id_kota) ");

        $_SESSION['toko']=true;
        header("Location: informasi-toko.php");
        exit;
    }

    $kategori = ['Paint','Furniture','Handcraft','Souvenir','Statue'];
    //AMBIL DATA TOKO    
    // $data= $koneksi->query("SELECT * FROM toko WHERE id_user = '$id_user'");
    // $row= $data->fetch_assoc();

    // $id_toko=$row['id_toko'];
    // $nama_toko=$row['nama_toko'];
    // $alamat_toko=$row['alamat_toko'];
    // $deskripsi_toko=$row['deskripsi_toko'];
    // $status_toko=$row['status_toko'];
    // $gambar_toko=$row['gambar_toko'];
    // $id_kota=$row['id_kota'];

    // //AMBIL DATA KOTA
    // $data_kota= $koneksi->query("SELECT nama_kota FROM kota WHERE id_kota = '$id_kota'");
    // $detail_kota= $data_kota->fetch_assoc();
    // $nama_kota=$detail_kota['nama_kota'];



    

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

        <!-- Navbar Informasi Toko -->
        <!-- <div id="sub-nav">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                <h4 class="color-palette1"><i class="fas fa-store mr-2"></i> INFORMASI TOKO</h4>
            </nav>
        </div> -->

            <!-- edit informasi toko -->
            <!-- <hr  id="informasi-toko"><br><br> -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div id="sub-nav">
                    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                        <span class="navbar-brand"><h3 class="color-palette1"><i class="fas fa-edit mr-2"></i> TOKO BARU</h3></span>
                        <button class="btn btn-success btn-sm my-2 my-lg-0 ml-auto" type="submit" name="submit">SIMPAN</button>
                        <!-- <a href="informasi-toko.php" class="btn btn-danger btn-sm ml-2">BATAL</a> -->
                    </nav>
                </div>

                <!-- input edit data -->
                <div class="form-group mt-3 mx-2">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="exampleFormControlInput1">Nama Toko</label>
                            <input type="text" class="form-control " id="exampleFormControlInput1" name="nama" required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="exampleFormControlSelect1">Expert</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="expert">
                                <option value="">Tidak ada</option>
                                <?php for ($i=0; $i < 5 ; $i++) { 
                                    if (strtolower($kategori[$i])!=strtolower($item['kategori'])) { ?>
                                        <option value="<?= $kategori[$i]; ?>"><?= $kategori[$i]; ?></option>
                                    <?php    
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="status" required>
                                <option value="buka">Buka</option>
                                <option value="tutup">Tutup</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3 mx-2">
                    <div class="form-row">
                        <div class="form-group col-md-10">
                          <label for="inputCity">Alamat Toko</label>
                          <input type="text" class="form-control" name="alamat" required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputState">Kota</label>
                        <?php $sql_kota= mysqli_query($conn, "SELECT * FROM kota"); ?>
                           <select class="form-control" name="kota">
                               <?php  while ($row_kota = mysqli_fetch_array($sql_kota)) {  ?>
                                <option value="<?= $row_kota['id_kota']; ?>"> <?php echo $row_kota['nama_kota']; ?></option>
                               <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3 mx-2">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label id="exampleFormControlInput1" for="exampleFormControlInput1">No Rekening</label>
                            <input type="number" class="form-control " id="exampleFormControlInput1" name="rekeneing" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleFormControlFile1">Gambar</label>
                            <input type="file" accept=".jpg,.jpeg,.png" class="form-control-file " name="gambar" id="exampleFormControlFile1">
                        </div>
                    </div>
                </div>
                <div class="form-group mx-2">
                </div>

                <div class="form-group mx-2">
                    <label for="exampleFormControlTextarea1">Deskripsi</label>
                    <textarea class="form-control " id="exampleFormControlTextarea1" rows="8" name="deskripsi" required></textarea>
                </div>
                <!-- end input edit data -->
            </form>
        
    </div>

    <br>
</body>
    <!-- javacript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script.js"></script>
</html>