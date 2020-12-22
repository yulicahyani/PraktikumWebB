<?php

session_start();
require 'functions.php';
$id_user=$_SESSION['id_user'];


if(isset($_POST["select"])){
  if($_POST['kategori']==''){
    $toko=query("SELECT * FROM toko INNER JOIN kota ON kota.id_kota=toko.id_toko INNER JOIN users USING(id_user)");
  }else{
    $kategori=$_POST['kategori'];
    $toko=query("SELECT * FROM toko INNER JOIN kota ON kota.id_kota=toko.id_toko INNER JOIN users USING(id_user) WHERE expert='$kategori'");
  }
}else{
  $id_toko=$_POST['id_toko'];
  if($id_toko){
    $toko=query("SELECT * FROM toko INNER JOIN kota ON kota.id_kota=toko.id_toko INNER JOIN users USING(id_user) where id_toko=$id_toko");
  }else{
    $toko=query("SELECT * FROM toko INNER JOIN kota ON kota.id_kota=toko.id_toko INNER JOIN users USING(id_user)");
  }
 
}



?>


<!DOCTYPE html>
<html>
<head>
    <title>Acraf | Category</title>
    <!-- meta tag -->
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="3600">
    <meta name="keywords" content="Art and Handcraf">
    <meta name="description" content="Platform penjualan barang seni dan kerajinan tangan">
    <meta name="author" content="Tim Acraf">
    <!-- link css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/fe118aecdc.js" crossorigin="anonymous"></script>
</head>
<body data-spy="scroll" data-target="#navbarResponsive">

    <!-- home section -->
    <div id="home">
    <!-- navbar -->
        <?php include "navbar.php" ?>
    <!--end navbar -->


    <!-- daftarexpert   -->
    <div id="daftarexpert">
        <h3 class="heading text-center">Category</h3>
        <div class="heading-underline"></div>
       
      <form class="mt-5"action="" method="post">
      <div class="row product-select justify-content-end">
        <!-- pilih berdasarkan jenis -->
        <div class="col-md-2">
          <div class="form-group">
            <select class="form-control rounded-pill" name="kategori" id="">
              <option value="">- semua kategori</option>
              <option value="Paint">Paint</option>
              <option value="Furniture">Furniture</option>
              <option value="Statue">Statue</option>
              <option value="Souvenir">Souvenir</option>
              <option value="Handcraft">Handcraft</option>
            </select>
          </div>
        </div>        
      <!-- button select -->
      <div class="form-group">
        <button type="submit" name="select" class="btn btn-warning rounded-pill">Select</button>
      </div>
    </div>
    </form>
        
        <div class="row mb-5 mt-5">
          <?php foreach($toko as $t){?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <h5><?=$t['nama_toko']?></h5>
                    </div>
                    <div class="card-body">
                      <div class="row">
                          <!-- Profil expert -->
                          <div class="col-md-5 pr-5 border-right">
                            <div class="card image-expert">
                                <img class="card-img" src="Seller/img/<?= $t['gambar_toko'] ?>" alt="Card image">
                            </div>
        
                            <div class="card">
                                <card-body>
                                    <table class="table table-borderless">
                                        <tbody>
                                          <tr>
                                            <td class="text-right">Nama Pemilik</td>
                                            <td>:</td>
                                            <th scope="row" class="text-left"><?= ' '.$t['nama_depan'].''.$t['nama_belakang']?></th>
                                          </tr>
                                          <tr>
                                            <td class="text-right">Expert</td>
                                            <td>:</td>
                                            <th scope="row" class="text-left"> <?=$t['expert']?></th>
                                          </tr>
                                          <tr>
                                            <td class="text-right">No. Telp</td>
                                            <td>:</td>
                                            <th scope="row" class="text-left"><?=$t['handphone']?></th>
                                          </tr>
                                          <tr>
                                            <td class="text-right">Email</td>
                                            <td>:</td>
                                            <th scope="row" class="text-left"><?=$t['email']?></th>
                                          </tr>
                                          <tr>
                                            <td  class="text-right">Alamat Toko</td>
                                            <td>:</td>
                                            <th scope="row" class="text-left"><?=$t['alamat_toko']?></th>
                                          </tr>
                                          <tr>
                                            <td  class="text-right">Kabupaten</td>
                                            <td>:</td>
                                            <th scope="row" class="text-left"><?=$t['nama_kota']?></th>
                                          </tr>
                                        </tbody>
                                      </table>
                                </card-body>
                            </div>
                          </div>
                          <!-- end profil expert -->
                          <!-- start produk expert -->
                          <div class="col-md-7">
                              <div class="row produk-expert">
                              <?php 
                                  $x=$t['id_toko'];
                                  $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN users USING(id_user) WHERE (stock>0) AND (id_toko=$x) LIMIT 6");
                                  foreach($produk as $data) {
                              ?>
                                <!-- produk1 -->
                                <div class="col-md-4 mt-2">
                                    <div class="card text-center">
                                      <img  class="card-img-top"src="Seller/img/<?=$data['gambar_item']?>" alt="">
                                      <div class="card-body">
                                        <p class="product-title color-palette1"><?=$data['nama_item']?></p>
                                        <p class="product-owner">by <?= ' '.$data['nama_depan'].' '.$data['nama_belakang']?></p>
                                        <p class="procuct-price">Rp. <?= $harga = "Rp " . number_format($data["harga"],0,',','.') ?></p>
                                        <button type="button" class="btn btn-warning color-edit rounded-pill" data-toggle="modal" data-target="#exampleModalCenter" onclick="additem(<?= $data['id_item']; ?>)"
                                        > Add </button>
                                        <a type="button" class="btn btn-outline-warning rounded-pill detail" data-toggle="modal" data-target="#exampleModal"
                                        data-namaproduk="<?= $data["nama_item"]; ?>" 
                                        data-kategori="<?= $data["kategori"]; ?>" 
                                        data-harga="<?= $data["harga"]; ?>" 
                                        data-status="<?= $data["status_item"]; ?>" 
                                        data-stok="<?= $data["stock"]; ?>" 
                                        data-alamat="<?= $data["alamat_toko"]; ?>" 
                                        data-deskripsi="<?= $data["deskripsi_item"]; ?>" 
                                        data-foto="<?= $data["gambar_item"]; ?>" 
                                        
                                        >Detail <img src="Seller/img/<?= $data['gambar_item']; ?>" style="display: none;"></a>

                                      </div>
                                    </div>
                                  </div>
                                  <!-- produk1 --> 
                                 <?php } ?>
                              </div>
                             
                              <div class="row justify-content-end">
                                  <?php if($produk==NULL){?>
                                    <p class='text-center'><i><?='Tidak Ditemukan Produk'?></i></p>
                                  <?php } else {?>   
                                    <form action="expertitem.php"></form>
                                     <a href="expertitem.php?id=<?=$t['id_toko']?>" class="btn color-edit mt-5 mr-3">Lihat semuanya</a>
                                  <?php }?>  
                              </div>
                          </div>
                          <br><br>
                          <!-- end produk expert -->
                      </div>
                    </div>
                  </div>
            </div>
            <?php }?>
        </div>

     <!-- modal detail -->
        <!-- Modal -->
        <div class="detail">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="row justify-content-center"> <img src=""  class="text-center rounded-circle imagepreview" alt=""></div>
                    <div class="row justify-content-center">
                        <table class="table table-borderless">
                        <tbody>
                            <tr>
                            <td class="text-right">Nama</td>
                            <td>:</td>
                            <th scope="row" class="text-left"><span id="namaproduk"></span></th>
                            </tr>
                            <tr>
                            <td  class="text-right">Kategori</td>
                            <td>:</td>
                            <th scope="row" class="text-left"><span id="kategori"></span></th>
                            </tr>
                            <tr>
                            <td  class="text-right">Harga</td>
                            <td>:</td>
                            <th scope="row" class="text-left">Rp. <span id="harga"></span></th>
                            </tr>
                            <tr>
                            <td  class="text-right">Stok</td>
                            <td>:</td>
                            <th scope="row" class="text-left"><span id="stok"></span></th>
                            </tr>
                            <tr>
                            <td  class="text-right">Dikirim dari</td>
                            <td>:</td>
                            <th scope="row" class="text-left"><span id="lokasi"></span></th>
                            </tr>
                            <tr>
                            <td  class="text-right">Status</td>
                            <td>:</td>
                            <th scope="row" class="text-left"><span id="status"></span></th>
                            </tr>
                            <tr>
                            <td  class="text-right">Deskripsi</td>
                            <td>:</td>
                            <th scope="row" class="text-left"><span id="deskripsi"></span></th>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <!-- end modal -->



      
      <!-- modal add -->
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambahkan ke Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Anda ingin menambahkan barang ke Cart?
            </div>
            <div class="modal-footer">
              <form action="addkeranjang-3.php" method="POST">
                     <input type="hidden" id="additem_id" name="id_item">
                     <button type="submit" name="add" class="btn btn-success">Yes</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </form>
            </div>
            </div>
        </div>
        </div>
      <!-- end modal add -->
      <?php if($toko==NULL){ ?>
        <p class="text-center"> <i>Hasil Tidak Ditemukan</i> </p><br>
      <?php  } ?>
      <br><br><br>
    </div>
    <!-- end daftar expert -->
    
    <!-- java script modal -->
    <script>
        $(document).ready(function(){

          $(document).on('click', '.detail', function(){
            var nama_produk = $(this).attr('data-namaproduk');
            var kategori_produk = $(this).attr('data-kategori');
            var harga_produk = $(this).attr('data-harga');
            var status_produk = $(this).attr('data-status');
            var stok_produk = $(this).attr('data-stok');
            var alamat_produk = $(this).attr('data-alamat');
            var deskripsi_produk = $(this).attr('data-deskripsi');
            var foto_produk = $(this).attr('data-foto');

            var id_item = $(this).attr('id_item');
            var id_toko = $(this).attr('id_toko');


            $('#namaproduk').text(nama_produk);
            $('#kategori').text(kategori_produk);
            $('#harga').text(harga_produk);
            $('#status').text(status_produk);
            $('#stok').text(stok_produk);
            $('#lokasi').text(alamat_produk);
            $('#deskripsi').text(deskripsi_produk);
            $('#fotoproduk').text(foto_produk);

            $('#id_item').text(id_item);
            $('#id_toko').text(id_toko);

            $('.imagepreview').attr('src', $(this).find('img').attr('src'));

          })
        })
        
      </script>
      <script language="javascript">
        function additem(id){
            // set id
            $('#additem_id').val(id);
        }
      </script>
    <!-- akhir javascript modal -->
       

   <!-- start footer -->
   <?php include "footer.php" ?>
  <!-- end footer -->
    
</body>
    <!-- javacript -->
    <!-- javacript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>