<?php

session_start();
$id_user = $_SESSION["id_user"];
$conn = mysqli_connect("localhost","root","","acraf");



if (isset($_POST['simpan'])) {
    //get inputan
    $catatan = $_POST['catatan'];
    $id_ongkir = $_POST['pengiriman'];
    $metode_pembayaran = $_POST['bayar'];

    //tangal pesan
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d');


    //harga ongkir
    $result2=mysqli_query($conn,"SELECT harga_ongkir FROM ongkir WHERE id_ongkir=$id_ongkir");
    $row = mysqli_fetch_assoc($result2);
    $harga_ongkir = $row['harga_ongkir'];
    echo $harga_ongkir;

    //menghitung total pembayaran
    $result3=mysqli_query($conn,"SELECT id_dp, harga_subtotal, id_pesanan FROM detail_pesanan WHERE id_user=$id_user AND id_sp=1");
    $dp = [];
    while ($row = mysqli_fetch_assoc($result3)) {
        $dp[] = $row;
    }
    $total_harga = 0;
    foreach($dp as $s){
        $total_harga=$total_harga + $s['harga_subtotal'];
    }

    $total_bayar = $total_harga + $harga_ongkir;

    // //update detail pesanan
    // //update tanggal
    mysqli_query($conn,"UPDATE detail_pesanan SET tgl_pesan='$date' WHERE id_sp=1 and id_user=$id_user");

    //update catatan
    $l=0;
    foreach($dp as $s){
        $x=$s['id_dp'];
        $c=$catatan[$l];
        mysqli_query($conn,"UPDATE detail_pesanan SET catatan='$c' WHERE id_dp=$x");
        $l++;
    }
    
    //update pesanan
    foreach($dp as $s){
        $x=$s['id_pesanan'];
        mysqli_query($conn,"UPDATE pesanan SET harga_total=$total_bayar, metode_pembayaran='$metode_pembayaran', id_ongkir=$id_ongkir WHERE id_pesanan=$x");
    }

    header("location:pesanan_saya.php");

}

// QUERY GET DATA
$query="SELECT *, u.id_kota as kota_akhir, t.id_kota as kota_awal FROM detail_pesanan dp
        INNER JOIN pesanan p ON dp.id_pesanan=p.id_pesanan
        INNER JOIN item i ON dp.id_item=i.id_item
        INNER JOIN users u ON dp.id_user=u.id_user
        INNER JOIN toko t ON p.id_toko=t.id_toko
        INNER JOIN kota k ON u.id_kota=k.id_kota
        INNER JOIN status_pesanan sp ON dp.id_sp=sp.id_sp
        INNER JOIN ongkir o ON p.id_ongkir=o.id_ongkir
        INNER JOIN jasa_pengiriman jp ON o.id_jp=jp.id_jp
        WHERE dp.id_user=$id_user AND dp.id_sp=1";



$result=mysqli_query($conn,$query);
$pesanan = [];
while ($row = mysqli_fetch_assoc($result)) {
$pesanan[] = $row;

}

$resultid=mysqli_query($conn,"SELECT id_pesanan FROM detail_pesanan WHERE id_user=$id_user AND id_sp=1 ORDER BY id_pesanan asc LIMIT 1");
$row = mysqli_fetch_assoc($resultid);
$id_pesanan = $row['id_pesanan'];

foreach($pesanan as $p){
    if($p['id_pesanan']==$id_pesanan){
        $kota_awal= $p['kota_awal'];
        $kota_akhir= $p['kota_akhir'];
    }
}

//ngambil data ongkir
$result1=mysqli_query($conn,"SELECT * FROM ongkir o 
INNER JOIN destinasi d ON o.id_destinasi=d.id_destinasi
INNER JOIN jasa_pengiriman jp ON o.id_jp=jp.id_jp 
WHERE d.id_awal=$kota_awal and d.id_akhir=$kota_akhir");

$ongkir = [];
while ($row = mysqli_fetch_assoc($result1)) {
    $ongkir[] = $row;

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <title>CheckOut</title>
</head>

<body style="background-color: whitesmoke;" data-spy="scroll" data-target="#navbarResponsive">
    <!-- home section -->
    <div id="home">
        <!-- navbar -->
        <?php include "navbar.php";?>
        <!--end navbar -->
    </div>

    
    <!--Start CheckOut-->
        <div class="container mt-5">
        <form action="" method="post">
            <div class="row mb-3">
                <h3 class="mt-4">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-check-square-fill"
                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    CHECK OUT
                </h3>
            </div>
            <!--Alamat Pengiriman-->
            <div class="row py-2 shadow-sm p-3 bg-white rounded">
                <div>
                    <div class="mb-2 alamat">
                        <div>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt-fill"
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                            <b>Alamat Pengiriman</b>
                        </div>
                    </div>
                    <?php
                    foreach($pesanan as $p){
                        if($p['id_pesanan']==$id_pesanan){ ?>

                    
                    <div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Nama :</label>
                                    <input class="form-control" type="text" name="nama" id="nama" value="<?= $p['nama_depan'];?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">No Telepon :</label>
                                    <input class="form-control" type="text" name="notelp" id="notelp" value="<?= $p['handphone'];?>">
                                </div>
                            </div>
                            <label for="">Alamat :</label>
                            <div><textarea class="form-control" name="alamat" id="alamat" cols="100" rows="3"><?= $p['alamat_user'];?></textarea>
                            </div>
                        </div>
                    </div>
                <?php }
                    } ?>
                </div>
            </div>

        
            <!--Daftar pesanan-->
            <div class="row mt-3 shadow-sm p-3 bg-white rounded">
                <table class="table shadow p-3 mb-3 bg-white rounded">
                    <thead>
                        <div>
                            <tr>
                                <th style="font-size: 20px; color: #780116;" colspan="2" scope="col" class="text-left">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-check-fill"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm.354-7.646a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
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
                        $r=0;
                        foreach($pesanan as $p){ 
                            if($p['id_pesanan']==$id_pesanan){
                        ?>
                        
                        <div>
                            <tr>
                                <th>
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shop"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z" />
                                    </svg>
                                    <?= $p['nama_toko'];?>
                                </th>
                            </tr>
                        </div>
                        <?php }?>
                        
                        <div>
                            <tr>
                                <td>
                                    <img style="width: 3rem;" src="Seller/img/<?= $p['gambar_item'];?>" alt="">
                                </td>
                                <td><?= $p['nama_item'];?></td>
                                <td><?= $p['harga'];?></td>
                                <td><?= $p['jumlah'];?></td>
                                <td><?= $p['harga_subtotal'];?></td>
                            </tr>
                        </div>

                        <tr>
                                <td colspan="2">
                                    <div class="form-group">
                                        <label for="">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                class="bi bi-chat-square-text-fill" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-2.5a1 1 0 0 0-.8.4l-1.9 2.533a1 1 0 0 1-1.6 0L5.3 12.4a1 1 0 0 0-.8-.4H2a2 2 0 0 1-2-2V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z" />
                                            </svg>
                                            Pesan :
                                        </label>
                                        <input class="form-control" type="text" name="catatan[<?=$r?>]" id="catatan" placeholder="(Opsional) Tinggalkan pesan ke penjual">
                                    </div>
                                </td>
                            </tr>
                        
                            <?php $r++;?>
                        <?php } ?>

                        
                        <div>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label>
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-truck"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                            </svg>
                                            Opsi Pengiriman :
                                        </label>
                                        <select class="form-control" name="pengiriman" id="pengiriman">
                                            <?php foreach($ongkir as $o){ ?>
                                                <option value="<?= $o['id_ongkir']?>"><?= $o['nama_jp']." - ".$o['harga_ongkir']." - ".$o['lama_pengiriman']?> hari</option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </div>

                    </tbody>



                </table>
            </div>


            <!--Metode Pembayaran-->
            <div class="row mt-3 shadow-sm p-3 mb-3 bg-white rounded">
                <div>
                    <div class="mb-3" style="font-size: 20px; color: #780116;">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-credit-card-fill"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4z" />
                            <path fill-rule="evenodd"
                                d="M0 7v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7H0zm3 2a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H3z" />
                        </svg>
                        <b>Metode Pembayaran</b>
                    </div>

                    <div class="mt-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="bayar" id="bayar" value="Transfer Bank">
                                </div>
                            </div>
                            <div style="width: 300px;" class="border px-5">
                                <label for="">Transfer Bank</label>
                            </div>
                        </div>

                        <div class=" mt-2 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="radio" name="bayar" id="bayar" value="COD">
                                </div>
                            </div>
                            <div style="width: 300px;" class="border px-5">
                                <label for="">COD (Bayar Di Tempat)</label>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        
            <!--Buat Pesanan-->
            <div class="mt-5 row shadow-sm p-3 mb-5 bg-white rounded">
                <div class="mx-auto">
                    <table class="table table-borderless">
                        <tr>
                            <td colspan="2" class="text-center">
                                <button type="submit" class="px-5 py-2 btn btn-success" name="simpan" id="simpan">SIMPAN</button>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        
            </form>
        </div>
    <!--End CheckOut-->
    
</body>

</html>