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

// QUERY GET ID TOKO
$result = mysqli_query($conn,"SELECT * FROM toko WHERE id_user = $id_user");
$toko = mysqli_fetch_assoc($result);
$idToko=$toko['id_toko'];

// QUERY GET DATA
$query="SELECT *, CONCAT(nama_depan,' ',nama_belakang) AS nama_user FROM detail_pesanan dp
            INNER JOIN pesanan p ON dp.id_pesanan=p.id_pesanan
            INNER JOIN item i ON dp.id_item=i.id_item
            INNER JOIN users u ON dp.id_user=u.id_user
            INNER JOIN kota k ON u.id_kota=k.id_kota
            INNER JOIN status_pesanan sp ON dp.id_sp=sp.id_sp
            INNER JOIN ongkir o ON p.id_ongkir=o.id_ongkir
            INNER JOIN jasa_pengiriman jp ON o.id_jp=jp.id_jp
            WHERE p.id_toko='$idToko' AND dp.id_sp=2 ";

// QUERY SEARCH
if (isset($_POST['cari'])) {
    $key=$_POST['key'];
    if ($key!='') {
        $query .= "AND (nama_item LIKE '%$key%' OR kategori LIKE '%$$key%' OR tgl_pesan LIKE '%$$key%' OR tgl_kirim LIKE '%$$key%' OR tgl_selesai LIKE '%$$key%' OR username LIKE '%$$key%' OR nama_jp LIKE '%$$key%' OR alamat_user LIKE '%$$key%' OR nama_depan LIKE '%$key%' OR nama_belakang LIKE '%$key%' OR username LIKE '%$key%' OR nama_kota LIKE '%$key%') ";        
    }
}

// QUERY KATEGORI & URUTAN
if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    if (isset($_GET['urutan'])) {
        $urutan = $_GET['urutan'];
        if ($urutan=='Terbaru') {
            $query .= "AND kategori='$kategori' ORDER BY tgl_pesan DESC";
        }elseif ($urutan=='Terlama') {
            $query .= "AND kategori='$kategori' ORDER BY tgl_pesan ASC";
        }
    }else {
        $query .= "AND kategori='$kategori'";
    }
}else{
    if (isset($_GET['urutan'])) {
        $urutan = $_GET['urutan'];
        if ($urutan=='Terbaru') {
            $query .= "ORDER BY tgl_pesan DESC";
        }elseif ($urutan=='Terlama') {
            $query .= "ORDER BY tgl_pesan ASC";
        }
    }
}

// PAGINATION
$result=mysqli_query($conn,$query);
$count_row = mysqli_num_rows($result);
$jum_halaman = ceil($count_row/15);
$index = 0;
if (isset($_GET['halaman'])) {
    $page=$_GET['halaman'];
    $index = (15 * $page) - 15;
}
$query .= " LIMIT $index,15";
$result=mysqli_query($conn,$query);

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
                <a href="pesanan-baru.php" class="navbar-brand"><h4 class="color-palette1"><i class="fas fa-shopping-cart mr-2"></i> PESANAN</h4></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- right nav -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Kategori</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="pesanan-baru.php">Semua Kategori</a>
                            <a class="dropdown-item" href="?kategori=Paint">Paint</a>
                            <a class="dropdown-item" href="?kategori=Furniture">Furniture</a>
                            <a class="dropdown-item" href="?kategori=Handcraft">Handcraft</a>
                            <a class="dropdown-item" href="?kategori=Souvenir">Souvenir</a>
                            <a class="dropdown-item" href="?kategori=Statue">Statue</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Urutkan</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (isset($kategori)){ ?>
                                    <a class="dropdown-item" href="?kategori=<?= $kategori; ?>&urutan=Terbaru">Terbaru</a>
                                    <a class="dropdown-item" href="?kategori=<?= $kategori; ?>&urutan=Terlama">Terlama</a>
                                <?php } else { ?>
                                    <a class="dropdown-item" href="?urutan=Terbaru">Terbaru</a>
                                    <a class="dropdown-item" href="?urutan=Terlama">Terlama</a>
                                <?php } ?>
                            </div>
                        </li>
                        <form action="" method="POST" class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2 rounded-pill" name="key" type="search" placeholder="Cari pesanan" aria-label="Search" autocomplete="off">
                            <button class="btn btn-outline-dark my-2 my-sm-0 rounded-pill" type="submit" name="cari">Search</button>
                        </form>
                    </ul>
                </div>
                <!-- end right nav -->
            </nav>
        </div>
        <!-- end sub-navbar -->
                
        <!-- menu pesanan -->
        <ul class="nav nav-tabs mt-3">
            <li class="nav-item">
                <a class="nav-link active font-weight-bold" href="pesanan-baru.php">Pesanan Baru</a>
            </li>
            <li class="nav-item ml-4">
                <a class="nav-link" href="pesanan-terkirim.php">Pesanan Terkirim</a>
            </li>
            <li class="nav-item ml-4">
                <a class="nav-link" href="pesanan-selesai.php">Pesanan Selesai</a>
            </li>
        </ul>
        <!-- end menu pesanan -->

        <!-- table pesanan -->
    <?php if ($count_row>0) { ?>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">PRODUK</th>
                    <th scope="col">TANGGAL PEMESANAN</th>
                    <th scope="col">JUMLAH</th>
                    <th scope="col">PEMBELI</th>
                    <th scope="col" class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no=1;
                while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $row['kategori']; ?></td>
                    <td><a href="deskripsi-barang.php?id=<?= $row['id_item']; ?>"><?= $row['nama_item']; ?></a></td>
                    <td><?= $row['tgl_pesan']; ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td class="text-center">
                        <a href="#" class="modal-detail" 
                        data-nama_item="<?= $row["nama_item"]; ?>" 
                        data-kategori="<?= $row["kategori"]; ?>"
                        data-catatan="<?= $row["catatan"]; ?>"
                        data-nama_user="<?= $row["nama_user"]; ?>"
                        data-username="<?= $row["username"]; ?>"
                        data-handphone="<?= $row["handphone"]; ?>"
                        data-alamat_user="<?= $row["alamat_user"]; ?>"
                        data-nama_kota="<?= $row["nama_kota"]; ?>"
                        data-jumlah="<?= $row["jumlah"]; ?>"
                        data-harga="<?= $row["harga"]; ?>"
                        data-harga_subtotal="<?= $row["harga_subtotal"]; ?>"
                        data-harga_total="<?= $row["harga_total"]; ?>"
                        data-metode_pembayaran="<?= $row["metode_pembayaran"]; ?>"
                        data-nama_jp="<?= $row["nama_jp"]; ?>"
                        data-lama_pengiriman="<?= $row["lama_pengiriman"]; ?>"
                        data-harga_ongkir="<?= $row["harga_ongkir"]; ?>"
                        data-nama_sp="<?= $row["nama_sp"]; ?>"
                        data-tgl_pesan="<?= $row["tgl_pesan"]; ?>"
                        data-tgl_kirim="<?= $row["tgl_kirim"]; ?>"
                        data-tgl_selesai="<?= $row["tgl_selesai"]; ?>"

                        >
                            <img src="img/<?= $row['gambar_item']; ?>" style="display: none;">
                            <button type="button" class="bg-primary text-white rounded border-0"><i class="fas fa-info-circle" data-toggle="tooltip" title="Detail"></i></button>
                        </a>

                        <button type="button" class=" bg-success text-white rounded border-0" onclick="kirimpesanan(<?= $row['id_dp']; ?>,<?= $row['id_item']; ?>,<?= $row['stock']; ?>)"><i class="fas fa-check-circle" data-toggle="tooltip" title="Kirim"></i></button>

                        <button type="button" class=" bg-danger text-white rounded border-0" onclick="tolakpesanan(<?= $row['id_dp']; ?>)"><i class="fas fa-times-circle" data-toggle="tooltip" title="Tolak"></i></button>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- end table pesanan -->
        
        <!-- page -->
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
        <!-- end page -->
    <?php } ?>
    </div>
    <!-- end content -->

    <!-- modal detail -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DETAIL PESANAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form> 
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="" class="imagepreview shadow" width="250">
                        </div>
                        <div class="col-md-7">
                            <h6><span id="nama_user"></span> <i>(<span id="username"></span>)</i></h6>
                            <span id="handphone"></span><br>
                            <span id="alamat_user"></span> - <span id="nama_kota"></span></p>
                            <hr>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <th>Produk</th>
                                    <td><span id="nama_item"></span></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><span id="kategori"></span></td>
                                </tr>
                                <tr>
                                    <th>Catatan</th>
                                    <td>
                                        <!-- <span id="catatan"></span> -->
                                        <textarea class="form-control mt-2" rows="2" id="catatan" style="background-color:rgb(255, 255, 255);" readonly></textarea>    
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table table-sm">
                                <tr>
                                    <th>Jumlah</th>
                                    <td><span id="jumlah"></span> pcs</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>Rp <span id="harga"></span></td>
                                </tr>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>Rp <span id="harga_subtotal"></span></td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>Rp <span id="harga_total"></span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-sm">
                                <tr>
                                    <th>Pembayaran</th>
                                    <td><span id="metode_pembayaran"></span></td>
                                </tr>
                                <tr>
                                    <th>Jasa Pengiriman</th>
                                    <td><span id="nama_jp"></span></td>
                                </tr>
                                <tr>
                                    <th>Lama</th>
                                    <td><span id="lama_pengiriman"></span> hari</td>
                                </tr>
                                <tr>
                                    <th>Ongkos kirim</th>
                                    <td>Rp <span id="harga_ongkir"></span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-sm">
                                <tr>
                                    <th>Status</th>
                                    <td><span id="nama_sp"></td>
                                </tr>
                                <tr>
                                    <th>Pesan</th>
                                    <td><span id="tgl_pesan"></td>
                                </tr>
                                <tr>
                                    <th>Kirim</th>
                                    <td> -</td>
                                </tr>
                                <tr>
                                    <th>Selesai</th>
                                    <td> -</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal detail -->

    <!-- modal kirim -->
    <div class="modal fade" id="modalKirim" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Attention</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="kirim-pesanan.php" method="POST">
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin mengirim pesanan ini?</p>
                        <input type="hidden" name="id_dp" id="id_dp">
                        <input type="hidden" name="id_item" id="id_item">
                        <input type="hidden" name="stock" id="stock">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button  type="submit" name="kirim" class="btn btn-primary">Ya, kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal kirim -->

    <!-- modal tolak -->
    <div class="modal fade" id="modalTolak" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Penolakan Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="tolak-pesanan.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_dp" id="id_dpp">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alasan anda menolak pesanan ini ..." name="alasan" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" nama="tolak" class="btn btn-primary">kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal tolak -->
    <br>
</body>
    <!-- javacript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script.js"></script>

    <script>
        function tolakpesanan(id){
            // open modal
            $('#modalTolak').modal('show');
            // set id
            $('#id_dpp').val(id);
        }

        function kirimpesanan(dp,item,stok){
            // open modal
            $('#modalKirim').modal('show');
            // set id
            $('#id_dp').val(dp);
            $('#id_item').val(item);
            $('#stock').val(stok);
        }

        $(function() {
            $('.modal-detail').on('click', function() {
                var nama_item = $(this).attr('data-nama_item');
                $('#nama_item').text(nama_item);
                var kategori = $(this).attr('data-kategori');
                $('#kategori').text(kategori);
                var catatan = $(this).attr('data-catatan');
                $('#catatan').text(catatan);
                var nama_user = $(this).attr('data-nama_user');
                $('#nama_user').text(nama_user);
                var username = $(this).attr('data-username');
                $('#username').text(username);
                var handphone = $(this).attr('data-handphone');
                $('#handphone').text(handphone);
                var alamat_user = $(this).attr('data-alamat_user');
                $('#alamat_user').text(alamat_user);
                var nama_kota = $(this).attr('data-nama_kota');
                $('#nama_kota').text(nama_kota);
                var jumlah = $(this).attr('data-jumlah');
                $('#jumlah').text(jumlah);
                var harga = $(this).attr('data-harga');
                $('#harga').text(harga);
                var harga_subtotal = $(this).attr('data-harga_subtotal');
                $('#harga_subtotal').text(harga_subtotal);
                var harga_total = $(this).attr('data-harga_total');
                $('#harga_total').text(harga_total);
                var metode_pembayaran = $(this).attr('data-metode_pembayaran');
                $('#metode_pembayaran').text(metode_pembayaran);
                var nama_jp = $(this).attr('data-nama_jp');
                $('#nama_jp').text(nama_jp);
                var lama_pengiriman = $(this).attr('data-lama_pengiriman');
                $('#lama_pengiriman').text(lama_pengiriman);
                var harga_ongkir = $(this).attr('data-harga_ongkir');
                $('#harga_ongkir').text(harga_ongkir);
                var nama_sp = $(this).attr('data-nama_sp');
                $('#nama_sp').text(nama_sp);
                var tgl_pesan = $(this).attr('data-tgl_pesan');
                $('#tgl_pesan').text(tgl_pesan);
                var tgl_kirim = $(this).attr('data-tgl_kirim');
                $('#tgl_kirim').text(tgl_kirim);
                var tgl_selesai = $(this).attr('data-tgl_selesai');
                $('#tgl_selesai').text(tgl_selesai);
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#modalDetail').modal('show');   
            });     
        });
    </script>

</html>