<?php 

$conn = mysqli_connect("localhost","root","","arcraf");

$id_produk = $_GET["id_produk"];

mysqli_query($conn,"DELETE FROM tb_produk WHERE id_produk = $id_produk");

if (mysqli_affected_rows($conn)>0) {
	echo "
		<script>
			alert('data berhasil dihapus');
			document.location.href = 'etalase.php';
		</script>
	";
}
?>