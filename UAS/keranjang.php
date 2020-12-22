<?php
session_start();
$id_user = $_SESSION["id_user"];
$conn = mysqli_connect("localhost","root","","acraf");

if (isset($_POST['chekout'])) {
    $id_dp=$_POST['id'];

    $result=mysqli_query($conn,"SELECT * FROM detail_pesanan dp
        INNER JOIN pesanan p ON dp.id_pesanan=p.id_pesanan
        WHERE id_sp=1 and id_user=$id_user");
        $row = mysqli_fetch_assoc($result);
        $toko1=$row['id_toko'];
        //echo $toko1;
    
    if (mysqli_affected_rows($conn)>0){
        $result=mysqli_query($conn,"SELECT * FROM detail_pesanan dp
            INNER JOIN pesanan p ON dp.id_pesanan=p.id_pesanan
            WHERE id_dp=$id_dp");
            $row = mysqli_fetch_assoc($result);
            $toko2=$row['id_toko'];
            //echo $toko2;
            
            if ($toko1==$toko2) {
                mysqli_query($conn,"UPDATE detail_pesanan SET id_sp=1 WHERE id_dp=$id_dp");
                echo "<script>
                    alert('Item berhasil di Check Out.');
                    document.location.href = 'keranjang.php';
                </script>";
            }
            else{
                echo "<script>
                        alert('Item berada pada toko yang berbeda. Silahkan Check Out item pada toko yang sama.');
                        document.location.href = 'keranjang.php';
                    </script>";
            }

    }
    else{
        mysqli_query($conn,"UPDATE detail_pesanan SET id_sp=1 WHERE id_dp=$id_dp");
        echo "<script>
                        alert('Item berhasil di Check Out.');
                        document.location.href = 'keranjang.php';
                    </script>";
    }
}

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
        WHERE dp.id_user=$id_user AND dp.id_sp=6 ORDER BY p.id_toko";

$result=mysqli_query($conn,$query);
$pesanan = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pesanan[] = $row;

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

    <title>Keranjang Belanja</title>
  </head>
  <body style="background-color: whitesmoke;" data-spy="scroll" data-target="#navbarResponsive">
  
    <!-- home section -->
    <div id="home">
        <!-- navbar -->
         <?php include "navbar.php";?>
        <!--end navbar -->
      </div>

    <!--Keranjang-->
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mt-2">
                    <h3 class="mt-4 mr-5">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                        </svg>
                        KERANJANG BELANJA
                    </h3>
                </div>
                
                <div class="mt-1 col-md-4 d-flex justify-content-end">
                    <a href="checkout.php" class="mt-4 ml-5 "><button type="button" class="btn btn-info">Check Out 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm.354-7.646a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                    </svg></button></a>
                </div>
                
            </div>
                <div class="row mt-3">
                <table class="table">
                    <thead class="bg-thead shadow-sm p-3 mb-5 rounded">
                        <tr>
                            
                            <th scope="col" class="text-white">Image</th>
                            <th scope="col" class="text-white">Toko</th>
                            <th scope="col" class="text-white">Produk</th>
                            <th scope="col" class="text-white">Harga</th>
                            <th scope="col" class="text-white">Sub Total</th>
                            <th scope="col" class="text-white">Jumlah</th>
                            <th scope="col" class="text-white"></th>
                        </tr>
                    </thead>
                    <tbody class="shadow-sm p-3 mb-5 bg-white rounded">
                
                    <?php foreach($pesanan as $p){ ?>
                    <tr>
                        <div>
                            <!--menampilkan daftar belanjaan dari suatu toko-->
                            <tr>
                                
                                <td><img  style="width: 4rem;" src="Seller/img/<?= $p['gambar_item']; ?>" alt=""></td>
                                <td><?= $p['nama_toko']; ?></td>
                                <td><?= $p['nama_item']; ?></td>
                                <td><?= $p['harga']; ?></td>
                                <td><?= $p['harga_subtotal']; ?></td>
                                <td>
                                    <?= $p['jumlah']?>
                                </td>
                                <form action="" method="post">
                                <td>
                                <button type="button" class="btn btn-color" onclick="jmlitem(<?= $p['id_dp']; ?>,<?= $p['harga']; ?>)">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="deleteitem(<?= $p['id_dp']; ?>,<?= $p['id_pesanan'];?>)">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                        </svg>
                                    </button>
                                    
                                        <input type="hidden" name="id" value="<?= $p["id_dp"]?>">
                                        <button type="submit" name="chekout" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm.354-7.646a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
                                            </svg>
                                        </button>
                                    
                                </td>
                                </form>
                            </tr>
                        </div>
                    <?php } ?>
                </tbody> 

                </table>


                </div>
        </div>
    </section>
    <!--Akhir keranjang-->

    <!-- modal ubah jumlah produk -->
    <div class="modal fade" id="jmlmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Jumlah Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="jumlah_item.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_dp" id="id_dp">
                        <input type="number" name="jml" id="">
                        <input type="hidden" name="harga" id="harga_item">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" name="jml_item" class="btn btn-primary">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    
                    <form action="delete_item.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_dp" id="id_dp1">
                            <input type="hidden" name="id_pesanan" id="id_pesanan">
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
    
  </body>
</html>

<script>
       function jmlitem(id,harga){
            // open modal
            $('#jmlmodal').modal('show');
            // set id
            $('#id_dp').val(id);
            $('#harga_item').val(harga);
        }

        function deleteitem(dp,pesanan){
            // open modal
            $('#deletemodal').modal('show');
            // set id
            $('#id_dp1').val(dp);
            $('#id_pesanan').val(pesanan);
        }
</script>

<!-- <script>
    $('.btn-number').click(function(e){
        e.preventDefault();
        
        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                
                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                } 
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {
        
        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());
        
        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });

    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script> -->