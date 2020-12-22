<?php
session_start();
$id_user = $_SESSION["id_user"];
$conn = mysqli_connect("localhost","root","","acraf");

if(isset($_POST['batal'])){
  $resultidpp=mysqli_query($conn,"SELECT id_pesanan FROM detail_pesanan WHERE id_user=$id_user AND id_sp=1");
  $id_p = [];
  while ($row = mysqli_fetch_assoc($resultidpp)) {
      $id_p[] = $row;
  }

  mysqli_query($conn,"DELETE FROM detail_pesanan WHERE id_sp=1 and id_user=$id_user");

  foreach($id_p as $id){
    if($id != $id_pesanan){
      mysqli_query($conn,"DELETE FROM pesanan WHERE id_pesanan=$id and id_user=$id_user");
    }
  }
  header("location:index.php");
}

if(isset($_POST['bayar'])){
    $resultidpp=mysqli_query($conn,"SELECT id_pesanan FROM detail_pesanan WHERE id_user=$id_user AND id_sp=1");
    $id_p = [];
    while ($row = mysqli_fetch_assoc($resultidpp)) {
        $id_p[] = $row;
    }

    $resultid=mysqli_query($conn,"SELECT id_pesanan FROM detail_pesanan WHERE id_user=$id_user AND id_sp=1 ORDER BY id_pesanan asc LIMIT 1");
    $row = mysqli_fetch_assoc($resultid);
    $id_pesanan = $row['id_pesanan'];

    mysqli_query($conn,"UPDATE detail_pesanan SET id_pesanan=$id_pesanan WHERE id_sp=1 and id_user=$id_user");
    mysqli_query($conn,"UPDATE detail_pesanan SET id_sp=2 WHERE id_pesanan=$id_pesanan and id_user=$id_user");
    
    foreach($id_p as $id){
      if($id != $id_pesanan){
        mysqli_query($conn,"DELETE FROM pesanan WHERE id_pesanan=$id and id_user=$id_user");
      }
    }
    header("location:pesanan_dikemas.php");
}

//belum bayar
$query1="SELECT * FROM detail_pesanan dp
INNER JOIN pesanan p ON dp.id_pesanan=p.id_pesanan
INNER JOIN item i ON dp.id_item=i.id_item
INNER JOIN users u ON dp.id_user=u.id_user
INNER JOIN toko t ON p.id_toko=t.id_toko
INNER JOIN kota k ON u.id_kota=k.id_kota
INNER JOIN status_pesanan sp ON dp.id_sp=sp.id_sp
INNER JOIN ongkir o ON p.id_ongkir=o.id_ongkir
INNER JOIN jasa_pengiriman jp ON o.id_jp=jp.id_jp
WHERE dp.id_user=$id_user AND dp.id_sp=1";



$result1=mysqli_query($conn,$query1);
$pesanan_belumbayar = [];
while ($row = mysqli_fetch_assoc($result1)) {
  $pesanan_belumbayar[] = $row;

}

//ngambil id_pesanan
$resultid=mysqli_query($conn,"SELECT id_pesanan FROM detail_pesanan WHERE id_user=$id_user AND id_sp=1 ORDER BY id_pesanan asc LIMIT 1");
$row = mysqli_fetch_assoc($resultid);
$id_pesanan = $row['id_pesanan'];

if($id_pesanan!=''){
  $resultong=mysqli_query($conn,"SELECT * FROM pesanan p 
  INNER JOIN ongkir o  ON p.id_ongkir=o.id_ongkir
  INNER JOIN jasa_pengiriman jp ON o.id_jp=jp.id_jp 
  WHERE p.id_pesanan=$id_pesanan");
  
  $ongkir = [];
  while ($row = mysqli_fetch_assoc($resultong)) {
      $ongkir[] = $row;
  
  }
}

$resulthrg=mysqli_query($conn,"SELECT id_dp, harga_subtotal, id_pesanan FROM detail_pesanan WHERE id_user=$id_user AND id_sp=1");
$dp = [];
while ($row = mysqli_fetch_assoc($resulthrg)) {
    $dp[] = $row;
}
$total_harga = 0;
foreach($dp as $s){
    $total_harga=$total_harga + $s['harga_subtotal'];
}


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
                <a class="nav-link text-dark active"  href="pesanan_saya.php" ><b>Belum Bayar</b> </a>
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
                <a class="nav-link text-dark"  href="pesanan_dibatalkan.php"><b>Dibatalkan</b></a>
              </li>
            </ul>
          </div>

        <?php if(count($pesanan_belumbayar)>0){ ?>
        <div class="mt-3 shadow p-3 mb-3 bg-white rounded">
          <!--Alamat pengiriman-->
          <?php
          foreach($pesanan_belumbayar as $p){
            if($p['id_pesanan']==$id_pesanan){ ?>
            <div class="py-2">
              <div><?= $p['nama_depan'] ?></div>
              <div><?= $p['handphone'] ?></div>
              <div><?= $p['alamat_user'] ?></div>
            </div>
            <?php }
          }
          ?>
              

                <!--Daftar pesanan-->
                <div class="mt-3">
                  <table class="table">
                      <thead>
                          <div>
                              <tr>
                                  <th style="font-size: 20px; color: #780116;" colspan="2" scope="col" class="text-left">
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-check-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm.354-7.646a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                      </svg>
                                      Produk Dipesan
                                  </th>
                                  <th scope="col">Harga satuan</th>
                                  <th scope="col">Jumlah</th>
                                  <th scope="col">Sub Total</th>
                              </tr>
                          </div>
                      </thead>
                      <tbody>
                        <?php 
                        
                        foreach($pesanan_belumbayar as $p){
                          if($p['id_pesanan']==$id_pesanan){ ?>
                          <div>
                              <tr>
                                  <th>
                                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shop" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                      </svg>
                                      <?= $p['nama_toko'];?>
                                  </th>
                              </tr>
                          </div>

                          <?php } ?>
                          
                          <div>
                              <tr>
                                  <td>
                                      <img  style="width: 3rem;" src="Seller/img/<?= $p['gambar_item']; ?> " alt="">
                                  </td>
                                  <td><?= $p['nama_item'];?></td>
                                  <td>Rp. <?= $p['harga'];?></td>
                                  <td><?= $p['jumlah'];?></td>
                                  <td>Rp. <?= $p['harga_subtotal'];?></td>
                              </tr>
                          </div>
                          <?php }?>

                          <?php 
                        
                        foreach($pesanan_belumbayar as $p){?>
                          <?php if($p['id_pesanan']==$id_pesanan){ ?>
                            <div>
                              <tr>
                                  <th>
                                  </th>
                              </tr>
                              <tr>
                                  <td colspan="2">
                                      <h4>No. Pesanan : <?= $id_pesanan;?></h4>
                                      <p>Tgl Pesanan : <?= $p['tgl_pesan'];?></p>
                                    </td>
                                  <td>
                                    <p>
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-truck" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                        Opsi Pengiriman :
                                      </p>
                                    <p><?= $p['nama_jp'];?></p>
                                  </td>
                                  <td>
                                      <p>
                                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar-day-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-4.785-6.145a.425.425 0 0 1-.43-.425c0-.242.192-.43.43-.43a.428.428 0 1 1 0 .855zm.336.563v4.105h-.672V8.418h.672zm-6.867 4.105v-2.3h2.261v-.61H4.684V7.801h2.464v-.61H4v5.332h.684zm3.296 0h.676V9.98c0-.554.227-1.007.953-1.007.125 0 .258.004.329.015v-.613a1.806 1.806 0 0 0-.254-.02c-.582 0-.891.32-1.012.567h-.02v-.504H7.98v4.105z"/>
                                          </svg>
                                          Diterima :
                                      </p>
                                      <p>
                                      <?= $p['lama_pengiriman'];?> hari
                                      </p>
                                  </td>
                                  <td>
                                      <p>
                                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                              <path fill-rule="evenodd" d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                                            </svg>
                                          Ongkos Kirim
                                      </p>
                                      <p>Rp. <?= $p['harga_ongkir'];?></p>
                                  </td>
                              </tr>
                          </div>

                          <?php } ?>

                        <?php }?>


                      </tbody>
                      
                  </table>
                </div>

                <div class="mt-5 row">
                  <div class="mx-auto">
                      <table class="table table-borderless">
                      <?php foreach($ongkir as $o){?>
                          <tr>
                              <td>Subtotal untuk Produk</td>
                              <th><h5>Rp. <?= $total_harga ?></h5></th>
                          </tr>
                          <tr>
                              <td>Total Ongkos Kirim</td>
                              <th><h5>Rp. <?= $o['harga_ongkir'] ?></h5></th>
                          </tr>
                          <tr>
                              <td>Total Pembayaran</td>
                              <th style="color: #780116;"><h3>Rp.<?= $o['harga_total'] ?></h3></th>
                          </tr>
                          <tr>
                            <td>Metode Pembayaran</td>
                            <th><?= $o['metode_pembayaran'] ?></th>
                        </tr>
                      <?php } ?>
                      </table>
                  </div>
                </div>


            <div class="mx-auto row">
              <button class="px-2 py-2 btn btn-success mr-3" type="button" data-toggle="modal" data-target="#exampleModal">Bayar Sekarang</button>
              <form action="" method="post">
                <button class="px-2 py-2 btn btn-danger" type="submit" name="batal">Batalkan Pesanan</button>
              </form>
          </div>
        </div>
        <?php } ?>

      </div>
    </section>
    <!--End Pesanan Saya-->

    <!-- Modal Bayar Sekarang -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Pembayaran Pesanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <p>Metode Pembayaran : Transfer Bank</p>
                    <?php foreach($pesanan_belumbayar as $p){ 
                        if($id_pesanan==$p['id_pesanan']){ ?>
                    <h3 style="color: #780116;">No. Rekening : <?= $p['rekening'] ?></h3><br>
                    <?php }
                    }?>
                    <p>Metode Pembayaran : COD</p>
                    <h3 style="color: #780116;">Pembayaran dilakukan di tempat. Tidak perlu melakukan konfirmasi pembayaran.</h3>
                          
                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="" method="post">
                      <button type="submit" name="bayar" class="btn btn-success">Konfirmasi Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
    
  </body>
<script>
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })
 </script>
    
</html>
