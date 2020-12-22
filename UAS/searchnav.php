<?php
session_start();
require 'functions.php';
$key='';
$id_user=$_SESSION['id_user'];
if(isset($_POST['search'])){
    $key=$_POST['key'];
    if($key!=''){
    $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN users USING(id_user) INNER JOIN kota ON kota.id_kota=toko.id_kota  WHERE (stock>0) AND ((nama_item LIKE '%$key%') OR (deskripsi_item LIKE '%$key%') OR (kategori LIKE '%$key%') OR (harga LIKE '%$key%') OR (nama_toko LIKE '%$key%') OR (alamat_toko LIKE '%$key%') OR (kota.nama_kota LIKE '%$key%') )");
    }else{
        $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN users USING(id_user) INNER JOIN kota ON kota.id_kota=toko.id_kota  WHERE (stock>0)"); 
    }
}else{
    if(!isset($_POST["select"])){
        $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN users USING(id_user)   WHERE stock>0");
      } else{
        
        if((!isset($_POST["kategori"])) && (!isset($_POST["harga"])) && (!isset($_POST["kota"])) ){}
        else if( ($_POST["kategori"]=='') && ($_POST["harga"]=='') && ($_POST["kota"]=='') ){
          $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN users USING(id_user) WHERE stock>0");
        }
        //berdasarkan kategori
        else if( ($_POST["kategori"]!='') && ($_POST["harga"]=='') && ($_POST["kota"]=='') ){
          $kategori=$_POST["kategori"];
          $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN users USING(id_user) WHERE stock>0 AND kategori='$kategori' ");
        }
      
       // berdasarkan kota
        else if( ($_POST["kategori"]=='') && ($_POST["harga"]=='') && ($_POST["kota"]!='') ){
          $kota=$_POST["kota"];
          $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN kota ON kota.id_kota=toko.id_kota INNER JOIN users USING(id_user)  WHERE kota.nama_kota='$kota'");
        }
      
        //berdasarkan harga
        else if( ($_POST["kategori"]=='') && ($_POST["harga"]!='') && ($_POST["kota"]=='') ){
          $harga=$_POST["harga"];
          if($harga==5000000){  $hargaMax=99999999999; }
          else {$hargaMax=$harga+1000000; }
          $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN users USING(id_user) WHERE (stock>0 ) AND  (harga BETWEEN $harga AND $hargaMax)");
        }
      
        //berdasarkan kategori dan harga
          else if( ($_POST["kategori"]!='') && ($_POST["harga"]!='') && ($_POST["kota"]=='') ){
            $harga=$_POST["harga"];
            if($harga==5000000){  $hargaMax=99999999999; }
            else {$hargaMax=$harga+1000000; }
            $kategori=$_POST["kategori"];
            $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN users USING(id_user) WHERE (stock>0 ) AND (harga BETWEEN $harga AND $hargaMax) AND (kategori='$kategori') ");
          }
      
          //berdasarkan kategori dan kota
          else if( ($_POST["kategori"]!='') && ($_POST["harga"]=='') && ($_POST["kota"]!='') ){
            $kota=$_POST["kota"];
            $kategori=$_POST["kategori"];
            $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN kota ON kota.id_kota=toko.id_kota INNER JOIN users USING(id_user) WHERE (stock>0 ) AND (kota.nama_kota='$kota') AND (kategori='$kategori')");
          }
      
          //berdasarkan harga dan kota
          else if( ($_POST["kategori"]=='') && ($_POST["harga"]!='') && ($_POST["kota"]!='') ){
            $harga=$_POST["harga"];
            if($harga==5000000){  $hargaMax=99999999999; }
            else {$hargaMax=$harga+1000000; }
            $kota=$_POST["kota"];
            $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN kota ON kota.id_kota=toko.id_kota INNER JOIN users USING(id_user) WHERE (stock>0 ) AND (kota.nama_kota='$kota') AND  (harga BETWEEN $harga AND $hargaMax)");
          }
      
           //berdasarkan harga dan kota dan kategori
          else if( ($_POST["kategori"]!='') && ($_POST["harga"]!='') && ($_POST["kota"]!='') ){
            $harga=$_POST["harga"];
            if($harga==5000000){  $hargaMax=99999999999; }
            else {$hargaMax=$harga+1000000; }
            $kota=$_POST["kota"];
            $kategori=$_POST["kategori"];
            $produk=query("SELECT * FROM item INNER JOIN toko USING(id_toko) INNER JOIN kota ON kota.id_kota=toko.id_kota INNER JOIN users USING(id_user) WHERE (stock>0 ) AND (kota.nama_kota='$kota') AND  (harga BETWEEN $harga AND $hargaMax) AND (kategori='$kategori')");
          }
        
      }


}

$kota=query("SELECT * FROM kota");


?>

<!DOCTYPE html>
<html>
<head>
    <title>Acraf | Art and Handcraf</title>
    <!-- meta tag -->
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="3600">
    <meta name="keywords" content="Art and Handcraf">
    <meta name="description" content="Platform penjualan barang seni dan kerajinan tangan">
    <meta name="author" content="Tim Acraf">
    <!-- link css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
    <!-- fontawesome -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fe118aecdc.js" crossorigin="anonymous"></script>
</head>
<body data-spy="scroll" data-target="#navbarResponsive">

    <!-- home section -->
    <div id="home">
        <!-- navbar -->
        <?php include "navbar.php";?>
        <!--end navbar -->

        <!-- product -->
  <div id="product">
    <h3 class="heading text-center">Product</h3>
    <div class="heading-underline"></div>
   
      <!-- form query -->
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
      <!-- pilih berdasarkan harga -->
        <div class="col-md-3">
          <div class="form-group">
            <select class="form-control rounded-pill" name="harga" id="">
              <option value="">- semua harga</option>
              <option value="5000000"> > Rp. 5.000.000</option>
              <option value="4000000">Rp. 4.0000.0000 - Rp. 5.000.000</option>
              <option value="3000000">Rp. 3.0000.0000 - Rp. 4.000.000</option>
              <option value="2000000">Rp. 2.0000.0000 - Rp. 3.000.000</option>
              <option value="1000000">Rp. 1.0000.0000 - Rp. 2.000.000</option>
              <option value="0"> < Rp. 1.0000.0000</option>
            </select>
          </div>
        </div>
      <!-- pilih berdasarkan kota -->
        <div class="col-md-2">
          <div class="form-group">
            <select class="form-control rounded-pill" name="kota" id="">
              <option value="">- semua kota</option>
              <?php foreach($kota as $k) {?>
                <option value="<?=$k['nama_kota']?>"><?=$k['nama_kota']?></option>
              <?php }?>
            </select>
          </div>
        </div>
      <!-- button select -->
      <div class="form-group">
        <button type="submit" name="select" class="btn btn-warning rounded-pill">Select</button>
      </div>
    </div>
    </form>
    <!-- end form query -->
    
    <!-- startproduct sale -->
    <!-- row produk -->
    <div class="row justify-content-center">
      <!-- produk -->
      <?php foreach ($produk as $data): ?>
      <div class="col-md-2">
        <div class="card text-center">
          <img  class="card-img-top"src="Seller/img/<?php echo $data["gambar_item"]?>" alt="">
          <div class="card-body">
            <p class="product-title color-palette1"><?php echo $data["nama_item"] ?></p>
            <p class="product-owner">by <?php echo $data["nama_depan"].' '.$data["nama_belakang"] ?></p>
            <p class="procuct-price"><?php echo  $harga = "Rp " . number_format($data["harga"],0,',','.'); ?></p>
            <button type="button" class="btn btn-warning rounded-pill" data-toggle="modal" data-target="#exampleModalCenter" onclick="additem(<?= $data['id_item']; ?>)"
            > Add </button>
            <a type="button" class="btn btn-outline-warning rounded-pill detail" data-toggle="modal"  onclick="addtoko(<?= $data['id_toko']; ?>)"
            data-target="#exampleModal"
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
      <?php endforeach; ?>
      <!-- akhir produk -->
    </div>
    <!-- row produk -->  

    <!-- modal detail -->
        <!-- Modal -->
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
                      <form action="daftarexpert.php" method="POST">
                        <input type="hidden" id="addtoko_id" name="id_toko">
                        <button type="submit" name="add_id_toko" class="btn btn-info">Lihat Toko</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                     </form>
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
                Apakah anda ingin memasukan barang ini ke Cart?
            </div>
            <div class="modal-footer">
                <form action="addkeranjang.php" method="POST">
                     <input type="hidden" id="additem_id" name="id_item">
                     <button type="submit" name="add" class="btn btn-success">Yes</button>
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </form>
                
            </div>
            </div>
        </div>
        </div>
      <!-- end modal add -->
    </div>
    <!-- end product sale -->

    <?php if($produk==NULL){ ?>
        <p class="text-center"> <i>Hasil Tidak Ditemukan</i> </p><br>
    <?php  } ?>
          
  
</div>
<!-- end product -->


  <!-- partner section -->
    <div id="partner">
      <h3 class="heading text-center">Our Partner</h3>
      <div class="heading-underline"></div>
      <div class="row justify-content-center">
        <div class="col-md-10 text-center">
          <a href="#" target="blank"><img src="img/partner/1.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/2.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/3.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/4.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/5.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/6.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/7.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/8.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/9.jpg" alt=""></a>
          <a href="#" target="blank"><img src="img/partner/10.jpg" alt=""></a>
        </div>
      </div>     
    </div>
    <!-- end partner section -->

    
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
        function addtoko(id){
            // set id
            $('#addtoko_id').val(id);
        }
      </script>

    <!-- start footer -->
    <?php include "footer.php" ?>
    <!-- end footer -->
    
</body>
    <!-- javacript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>