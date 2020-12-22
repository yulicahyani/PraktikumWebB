<?php
session_start();
$id_user = $_SESSION["id_user"];
$conn = mysqli_connect("localhost","root","","acraf");



// QUERY GET DATA
$query="SELECT * FROM detail_pesanan dp
INNER JOIN pesanan p ON dp.id_pesanan=p.id_pesanan
INNER JOIN item i ON dp.id_item=i.id_item
INNER JOIN users u ON dp.id_user=u.id_user
INNER JOIN toko t ON p.id_toko=t.id_toko
INNER JOIN kota k ON u.id_kota=k.id_kota
INNER JOIN status_pesanan sp ON dp.id_sp=sp.id_sp
INNER JOIN ongkir o ON p.id_ongkir=o.id_ongkir
INNER JOIN jasa_pengiriman jp ON o.id_jp=jp.id_jp
WHERE dp.id_user=$id_user AND dp.id_sp=5";

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

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="refresh" content="3600">
    <meta name="keywords" content="Art and Handcraf">
    <meta name="description" content="Platform penjualan barang seni dan kerajinan tangan">
    <meta name="author" content="Tim Acraf">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/fe118aecdc.js" crossorigin="anonymous"></script>
    <!-- Js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    
    <title>Pesanan Saya</title>
  </head>
  <body style="background-color: whitesmoke;" data-spy="scroll" data-target="#navbarResponsive">
    <!-- home section -->
    <div id="home">
      <!-- navbar -->
      <?php include "navbar.php";?>
      <!--end navbar -->
    </div>

    <!--Start Pesanan Saya-->
    <section class="mt-5">
      <div class="container">
        <div class="row">
          <h3 class="mt-4">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt-cutoff" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v13h-1V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51L2 2.118V15H1V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zM0 15.5a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
              <path fill-rule="evenodd" d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-8a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
            </svg>
            PESANAN SAYA
          </h3>
        </div>

        <!--Menu untuk pesanan saya-->
          <div class="mt-3">
            <!-- Nav tabs -->
            <ul class="nav nav-pills nav-justified shadow-sm p-3 bg-white rounded" id="myTab" role="tablist">
              <li style="width: 300px;" class="nav-item mr-5" role="presentation">
                <a class="nav-link text-dark"  href="pesanan_saya.php" ><b>Belum Bayar</b> </a>
              </li>
              <li class="nav-item mr-5" role="presentation">
                <a class="nav-link text-dark " href="pesanan_dikemas.php" ><b>Dikemas</b></a>
              </li>
              <li class="nav-item mr-5" role="presentation">
                <a class="nav-link text-dark"  href="pesanan_dikirim.php" ><b>Dikirim</b></a>
              </li>
              <li class="nav-item mr-5" role="presentation">
                <a class="nav-link text-dark"  href="pesanan_selesai.php"><b>Selesai</b></a>
              </li>
              <li class="nav-item mr-5" role="presentation">
                <a class="nav-link text-dark active"  href="pesanan_dibatalkan.php"><b>Dibatalkan</b></a>
              </li>
            </ul>
            </div>
        <!--Menu untuk pesanan saya-->

        <!-- table pesanan -->
    <?php if ($count_row>0) { ?>
        <table class="table table-striped mt-3 shadow p-3 mb-3 bg-white rounded">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">KATEGORI</th>
                    <th scope="col">PRODUK</th>
                    <th scope="col">TANGGAL PEMESANAN</th>
                    <th scope="col">TANGGAL PENGIRIMAN</th>
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
                    <td><?= $row['nama_item']; ?></td>
                    <td><?= $row['tgl_pesan']; ?></td>
                    <td><?= $row['tgl_kirim']; ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td><?= $row['username']; ?></td>
                    <td class="text-center">
                        <a href="#" class="modal-detail" 
                        data-nama_item="<?= $row["nama_item"]; ?>" 
                        data-kategori="<?= $row["kategori"]; ?>"
                        data-catatan="<?= $row["catatan"]; ?>"
                        data-nama_depan="<?= $row["nama_depan"]; ?>"
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
                            <img src="Seller/img/<?= $row['gambar_item']; ?>" style="display: none;">
                            <button type="button" class="bg-primary text-white rounded border-0"><i class="fas fa-info-circle" data-toggle="tooltip" title="Detail"></i></button>
                        </a>
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
                            <h6><span id="nama_depan"></span> <i>(<span id="username"></span>)</i></h6>
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
                                    <td><span id="tgl_kirim"></td>
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

    <br>
    </section>
</body>
    <!-- javacript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script.js"></script>

    <script>
        $(function() {
            $('.modal-detail').on('click', function() {
                var nama_item = $(this).attr('data-nama_item');
                $('#nama_item').text(nama_item);
                var kategori = $(this).attr('data-kategori');
                $('#kategori').text(kategori);
                var catatan = $(this).attr('data-catatan');
                $('#catatan').text(catatan);
                var nama_depan = $(this).attr('data-nama_depan');
                $('#nama_depan').text(nama_depan);
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
