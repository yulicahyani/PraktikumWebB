<?php 

include'koneksi.php'; 

function regist ($data){
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
  $conpassword = mysqli_real_escape_string($koneksi, $data ['conpassword']);

    //cek email ada atau tidak
      $result = mysqli_query($koneksi, "SELECT email FROM users WHERE email = '$email'");
      if (mysqli_fetch_assoc($result)){
        echo "<script>
              alert ('email sudah terdaftar!');
              </script>";
              return false;
      }

    //cek username ada atau tidak
      $result = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
      if (mysqli_fetch_assoc($result)){
        echo "<script>
              alert ('Username telah digunakan!');
              </script>";
              return false;
      }

     //cek konfirmasi password
      if ($password !== $conpassword){
          echo "<script>
          alert('Konfirmasi password tidak sesuai');
          </script>";
          return false;
      } 

      mysqli_query($koneksi, "INSERT INTO users VALUES('','$nama_depan','$nama_belakang','$username','$email','$handphone','$tgl_lahir','$alamat_user','$provinsi','$kode_pos','$password','$id_kota')");


      return mysqli_affected_rows($koneksi);
}

 ?>