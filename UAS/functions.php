<?php
//KONEKSI DATABASE
$conn=mysqli_connect('localhost','root','','acraf');

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows=[];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[]= $row;
    }
    return $rows;
}


function addCart($toko,$user){
    global $conn;
     //ambil data dari setiap form
     $id_toko= $toko;
     $id_user= $user;
    //query insert data
    $query= "INSERT INTO pesanan VALUES('',1,'1',1,$id_toko)";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function addDetailPesanan($harga,$id_item,$id_user){
    global $conn;
    $data=query("SELECT * FROM pesanan ORDER BY id_pesanan DESC LIMIT 1");
    foreach($data as $d){
        $id_pesanan=$d["id_pesanan"];
    }

    $query= "INSERT INTO detail_pesanan VALUES('',1,'',$harga,$id_user,'','','','',$id_pesanan,$id_item,6)";    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}





?>