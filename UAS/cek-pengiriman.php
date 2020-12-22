<?php 

function cekKirim($id){

	$conn = mysqli_connect("localhost","root","","acraf");

	date_default_timezone_set('Asia/Jakarta');
	$date1 = date('Y-m-d');

	$result=mysqli_query($conn,"SELECT * FROM detail_pesanan  INNER JOIN pesanan USING(id_pesanan) INNER JOIN ongkir USING(id_ongkir) WHERE id_user=$id AND id_sp=3;");
	while ($row = mysqli_fetch_assoc($result)) {
	    $date2=$row['tgl_kirim'];
	    $lama=$row['lama_pengiriman'];
	    $id_dp=$row['id_dp'];

	    $diff = abs(strtotime($date2) - strtotime($date1));
	    $years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
	    
	    // echo $date2.'<br>';
	    if ($days>=$lama) {
	    	// echo "lewat 1 hari <br>";
	    	mysqli_query($conn,"UPDATE detail_pesanan SET id_sp=4 WHERE id_dp=$id_dp");
	    }
	}
}


?>