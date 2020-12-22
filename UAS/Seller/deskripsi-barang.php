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

$conn = mysqli_connect("localhost","root","","acraf");
$id = $_GET['id'];

if (isset($_POST['submit'])) {
    $error = $_FILES['gambar']['error'];
    if ($error === 4) {
        $namaGambar = $_POST['gambarLama'];
    }else{
        $namaGambar = $id."-".$_FILES['gambar']['name'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmpName, 'img/'.$namaGambar);
    }


    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];

    mysqli_query($conn,"UPDATE item SET nama_item='$nama', stock=$stok, deskripsi_item='$deskripsi', gambar_item='$namaGambar', kategori='$kategori', harga=$harga, status_item='$status' WHERE id_item=$id");

}


$result = mysqli_query($conn,"SELECT * FROM item WHERE id_item=$id");
$item = mysqli_fetch_assoc($result);

$toko = $item['id_toko'];
$result = mysqli_query($conn,"SELECT * FROM toko WHERE id_toko = $toko");
$alamat = mysqli_fetch_assoc($result);

$kategori = ['Paint','Furniture','Handcraft','Souvenir','Statue'];
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
        <div class="row">
            <!-- gambar -->
            <div class="col-md-6">
                <img src="img/<?= $item['gambar_item']; ?>" class="d-block w-100" alt="...">
            </div>
            <!-- end gambar -->
            
            <!-- dekripsi -->
            <div class="col-md-6">
                <!-- title -->
                <h2 class="font-weight-bold color-palette1"> <?= $item['nama_item']; ?> </h2>
                <div class="row">
                    <div class="col-md-9"><hr></div>
                    <div class="col-md-3">
                        <a href="#edit"><i class="fas fa-edit bg-primary p-2 text-white rounded btn-sm" data-toggle="tooltip" title="Edit"></i></a>
                        <a href="#" onclick="deleteitem(<?= $item['id_item']; ?>)"><i class="fas fa-trash-alt bg-danger p-2 text-white rounded btn-sm" data-toggle="tooltip" title="Hapus"></i></a>
                    </div>
                </div>
                <!-- end title -->
                
                <!-- table -->
                <table class="table table-borderless table-sm">
                    <tr>
                        <td>Kategori</td>
                        <th><?= $item['kategori']; ?></th>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <th>Rp. <?= $item['harga']; ?></th>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <th><?= $item['stock']; ?> pcs</th>
                    </tr>
                    <tr>
                        <td>Dikirim Dari</td>
                        <th><?= $alamat['alamat_toko']; ?></th>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <th><?= $item['status_item']; ?></th>
                    </tr>
                </table><hr>
                <!-- end table -->

                <!-- textarea deskripsi barang -->
                <h6 class="ml-2 mb-3">Deskripsi</h6>
                <textarea class="form-control m-2" rows="8" style="background-color:rgb(255, 255, 255);" readonly><?= $item['deskripsi_item']; ?>
                </textarea>
                <!-- end textarea deskripsi barang -->
            </div>
            <!-- end deskripsi -->

        </div>
        <!-- edit barang -->
        <hr  id="edit"><br><br>
            <form action="deskripsi-barang.php?id=<?= $id; ?>" method="POST" enctype="multipart/form-data">
                <div id="sub-nav">
                    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
                        <span class="navbar-brand" href="#"><h3 class="color-palette1"><i class="fas fa-edit mr-2"></i> Edit Barang</h3></span>
                        <button class="btn btn-success btn-sm my-2 my-lg-0 ml-auto" type="submit" name="submit">SIMPAN</button>
                        <a href="deskripsi-barang.php?id=<?= $id; ?>" class="btn btn-danger btn-sm ml-2">BATAL</a>
                    </nav>
                </div>
                <!-- input data2 -->
                <div class="row mt-3">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Produk</label>
                            <input type="text" class="form-control" name="nama" id="exampleFormControlInput1" value="<?= $item['nama_item']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Kategori</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                <option value="<?= $item['kategori']; ?>"><?= $item['kategori']; ?></option>
                                <?php for ($i=0; $i < 5 ; $i++) { 
                                    if (strtolower($kategori[$i])!=strtolower($item['kategori'])) { ?>
                                        <option value="<?= $kategori[$i]; ?>"><?= $kategori[$i]; ?></option>
                                    <?php    
                                    }
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Harga</label>
                            <input type="number" class="form-control" name="harga" id="exampleFormControlInput1" value="<?= $item['harga']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Stok</label>
                            <input type="number" class="form-control" name="stok" id="exampleFormControlInput1" value="<?= $item['stock']; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" name="status" id="exampleFormControlSelect1" required>
                                <option value="<?= $item['status_item']; ?>"><?= $item['status_item']; ?></option>
                                <?php if (strtolower($item['status_item']) == 'tersedia') { ?>
                                    <option value="kosong">kosong</option>
                                <?php } else {?>
                                    <option value="tersedia">tersedia</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Dikirim Dari</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" value="<?= $alamat['alamat_toko']; ?>" style="background-color:rgb(255, 255, 255);" readonly>
                            <small>*hanya dapat diubah pada halaman informasi toko</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="hidden" name="gambarLama" value="<?= $item['gambar_item']; ?>">
                            <label for="exampleFormControlFile1">Gambar</label>
                            <input type="file" accept=".jpg,.jpeg,.png" class="form-control-file" id="exampleFormControlFile1" name="gambar">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Deskripsi</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="8" name="deskripsi"><?= $item['deskripsi_item']; ?></textarea>
                </div>
                <!-- end input data2 -->
            </form>
        <!-- end edit barang -->
        
    </div>
    <!-- end content -->
    <br>

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
                        <p>Apakah anda yakin ingin menghapus item ini?</p>
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