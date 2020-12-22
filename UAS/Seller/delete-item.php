<?php 
/*
Proses penghapusan item pada toko :

jika item tersebut terdapat pada detail pesanan dalam status dikeranjang, belum dibayar atau kirim
> jika dikeranjang, detail pesanan tsb langsung terhapus
> jika dibelum dibayar, detail pesanan tsb langsung terhapus
> jika dikemas, tolak semua pesanan dengan berikan alasan 'mohon maaf barang ini sudah tidak tersedia lagi', dan set id_item menjadi null
> jika kirim, penghapusan tidak bisa dilakukan

jika tidak
> detail pesanan dgn status selesai, id_item pada detail pesanan tsb diberikan nilai NULL (atau dihapus aja)
*/

$conn = mysqli_connect("localhost","root","","acraf");

$id = $_POST['delete_id'];

// penolakan pesanan pada ststus dikemas
mysqli_query($conn,"UPDATE detail_pesanan SET id_sp=5, pesan_batal='Mohon maaf barang ini sudah tidak tersedia lagi.', id_item=NULL WHERE id_item=$id AND id_sp=2");

// cek jika terdapat pesanan pada status kirim
mysqli_query($conn,"SELECT * FROM detail_pesanan WHERE id_item=$id AND id_sp=3");
if (mysqli_affected_rows($conn)>0) {
	echo "<script>
			alert('Item tidak dapat dihapus karena item tersebut masih terdapat dalam proses pengiriman pesanan.');
			document.location.href = 'etalase.php';
		</script>";
}else{
	// dikeranjang
	// mysqli_query($conn,"DELETE FROM detail_pesanan WHERE id_item = $id AND id_sp=..");

	// belum dibayar
	mysqli_query($conn,"DELETE FROM detail_pesanan WHERE id_item = $id AND id_sp=1");
	
	// selesai
	mysqli_query($conn,"DELETE FROM detail_pesanan WHERE id_item = $id AND id_sp=4");

	// hapus item
	mysqli_query($conn,"DELETE FROM item WHERE id_item = $id");

	header('location:etalase.php');
}


// mysqli_query($conn,"DELETE FROM detail_pesanan WHERE id_item = $id");
// if (mysqli_affected_rows($conn)>0) {
// 	header('location:etalase.php');
// }else{
// 	echo "<script>
// 			alert('Item gagal dihapus');
// 			document.location.href = 'etalase.php';
// 		</script>";
// }

// mysqli_query($conn,"DELETE FROM item WHERE id_item = $id");
// if (mysqli_affected_rows($conn)>0) {
// 	header('location:etalase.php');
// }else{
// 	echo "<script>
// 			alert('Item gagal dihapus');
// 			document.location.href = 'etalase.php';
// 		</script>";
// }

 ?>