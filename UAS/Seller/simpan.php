<?php 
session_start();

include'koneksi.php'; 

$id_user = $_SESSION["id_user"];
//AMBIL DATA USER
  $id_user = $_SESSION["id_user"];
  $data_lama= $koneksi->query("SELECT * FROM users WHERE id_user = '$id_user'");
  $row_user= $data_lama->fetch_assoc();
  $password_user = mysqli_real_escape_string($koneksi, $row_user ['passwords']);

function simpan ($data){
  global $koneksi;
	$nama_depan=$data['nama_depan'];
	$nama_belakang=$data['nama_belakang'];
	$username=$data['username'];
	$email=$data['email'];
	$handphone=$data['handphone'];
	$tgl_lahir=$data['tgl_lahir'];
	$alamat_user=$data['alamat_user'];
	$provinsi=$data['provinsi'];
	$kode_pos=$data['kode_pos'];
	$id_kota=$data['id_kota'];
	$password = mysqli_real_escape_string($koneksi, $data ['password']);
  $password_baru = mysqli_real_escape_string($koneksi, $data ['password_baru']);
  $conpassword_baru = mysqli_real_escape_string($koneksi, $data ['conpassword_baru']);

    //cek konfirmasi password lama
      if ($password_user !== $password){
          echo "<script>
          alert('Password lama anda tidak sesuai');
          </script>";
          return false;
      } 
     //cek konfirmasi password baru
      if ($password_baru !== $conpassword_baru){
          echo "<script>
          alert('Konfirmasi password tidak sesuai');
          </script>";
          return false;
      } 

      mysqli_query($koneksi, "UPDATE users SET nama_depan ='$nama_depan', nama_belakang='$nama_belakang', handphone='$handphone', tgl_lahir = '$tgl_lahir',alamat_user='$alamat_user',provinsi='$provinsi',kode_pos='$kode_pos',passwords='$password_baru',id_kota='$id_kota'  WHERE id_user='$id_user';");


      return mysqli_affected_rows($koneksi);
}

 ?>