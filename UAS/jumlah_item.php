<?php
    $id = $_POST['id_dp'];
    $jml = $_POST['jml'];
    $harga = $_POST['harga'];
    
    $subtotal = $jml*$harga;

    $conn = mysqli_connect("localhost","root","","acraf");
    mysqli_query($conn,"UPDATE detail_pesanan SET jumlah = $jml, harga_subtotal=$subtotal WHERE id_dp=$id");

    header("location:keranjang.php");
?>