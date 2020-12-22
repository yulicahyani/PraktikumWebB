<?php 
$conn = mysqli_connect("localhost","root","","acraf");

$id = $_POST["id_dp"];
$alasan = $_POST["alasan"];

// echo $id;
// exit;
mysqli_query($conn,"UPDATE detail_pesanan SET id_sp=5, pesan_batal='$alasan' WHERE id_dp=$id");
if (mysqli_affected_rows($conn)>0) {
	header('location:pesanan-baru.php');
}else{
	echo "<script>
			alert('pesanan gagal ditolak');
			document.location.href = 'pesanan-baru.php';
		</script>";
}

 ?>