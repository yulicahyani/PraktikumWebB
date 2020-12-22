<?php 
$conn = mysqli_connect("localhost","root","","acraf");

$id_dp = $_POST["id_dp"];
$id_item = $_POST["id_item"];
$stock = $_POST["stock"];
date_default_timezone_set('Asia/Jakarta');
$date = date('Y-m-d');

// echo 'id : '.$id_dp.', item :'.$id_item.', stock :'.$stock.', Indonesian Timezone: ' . $date;


mysqli_query($conn,"UPDATE detail_pesanan SET id_sp='3', tgl_kirim='$date' WHERE id_dp=$id_dp");
if (mysqli_affected_rows($conn)>0) {
	if ($stock==1) {
		$stock--;
		mysqli_query($conn,"UPDATE item SET stock=$stock, status_item='kosong' WHERE id_item=$id_item");
	}else{
		$stock--;
		mysqli_query($conn,"UPDATE item SET stock=$stock WHERE id_item=$id_item");
	}
	header('location:pesanan-baru.php');
}else{
	echo "<script>
			alert('pesanan gagal ditolak');
			document.location.href = 'pesanan-baru.php';
		</script>";
}

 ?>