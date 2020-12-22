<?php


session_start();
require 'functions.php';

$id_user=$_SESSION['id_user'];
$id_item=$_POST["id_item"];

$data=query("SELECT * FROM detail_pesanan WHERE (id_item=$id_item)AND(id_user=$id_user)AND(id_sp=6)");
if($data){
    //salin data
    $catatan=$data['0']['catatan'];
    $tgl_pesan=$data[0]['tgl_pesan'];
    $tgl_kirim=$data[0]['tgl_kirim'];
    $tgl_selesai=$data[0]['tgl_selesai'];
    $pesan_batal=$data[0]['pesan_batal'];
    $id_pesanan=$data[0]['id_pesanan'];

    //operasi update jumlah dan harga
    $produk=query("SELECT * FROM item WHERE id_item=$id_item");
    $id_dp=$data[0]['id_dp'];
    $jumlah=$data[0]['jumlah']+1;
    $subtotal=$jumlah*$produk[0]['harga'];

    //update ke db
    $query= "UPDATE detail_pesanan SET
    id_dp=$id_dp,
    jumlah=$jumlah,
    catatan='$catatan',
    harga_subtotal=$subtotal,
    id_user = $id_user,
    tgl_pesan = '$tgl_pesan',
    tgl_kirim = '$tgl_kirim',
    tgl_selesai = '$tgl_selesai',
    pesan_batal ='$pesan_batal',
    id_pesanan =$id_pesanan,
    id_item =$id_item,
    id_sp =6
    WHERE id_dp=$id_dp
    ";

    mysqli_query($conn, $query);
    
    if(mysqli_affected_rows($conn)> 0) {
        header("Location:searchnav.php");
    } else{
        echo "
            <script>
                alert('Maaf, terjadi kesalahan :(');
                document.location.href='searchnav.php';
            </script>
        ";
    }


}else{

    $data=query("SELECT * FROM item INNER JOIN toko USING(id_toko) WHERE id_item='$id_item'");
    foreach($data as $d){
        $toko=$d['id_toko'];
        $harga=$d['harga'];
    }

    if( addCart($toko,$id_user)> 0) {

        if( addDetailPesanan($harga,$id_item,$id_user)> 0) {
            header("Location:searchnav.php");
        }else{
            echo "
            <script>
                alert('Maaf terjadi kesalahan dalam add produk');
                document.location.href='searchnav.php';
            </script>
        ";
        }
    }
    
}



?>




?>