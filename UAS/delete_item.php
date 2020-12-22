<?php

$id = $_POST['id_dp'];
$idp = $_POST['id_pesanan'];

$conn = mysqli_connect("localhost","root","","acraf");
mysqli_query($conn,"DELETE FROM detail_pesanan WHERE id_dp = $id");
mysqli_query($conn,"DELETE FROM pesanan WHERE id_pesanan = $idp");

header("location:keranjang.php");
?>