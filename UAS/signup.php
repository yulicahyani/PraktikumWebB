<?php 
session_start();

require'regist.php'; 

if(isset($_POST["register"])){
	if(regist($_POST) > 0){
		echo "<script> 
          alert ('user baru berhasil ditambahkan!');
          </script>";
	}else{
		echo mysqli_error($koneksi);
	}
}
 ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- link css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" type="text/css" href="css/signup.css">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/fe118aecdc.js" crossorigin="anonymous"></script>

    <title>SIGN UP</title>
  </head>
  <body>

    <!-- home section -->
    <div id="home">
        <!-- navbar -->
        <nav  class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <a class="navbar-brand" href="#"><img src="img/logos.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" >
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <!-- start left nav -->
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="index.php"> Home </a>
                  </li>        
              </ul>
              <!-- end left nav -->

              <!-- start right nav -->
              <ul class="navbar-nav ml-auto">
                <li>
              </li>
              </ul>
              <!-- end right nav -->
          </div>
      </nav>
      <!--end navbar -->

    <!-- form sign-up -->
    <div class="container">
      <h3 class="text-center"><b><u> REGISTER </u></b></h3><br>
      <form action="" method="POST">
        <div class="form-group">
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" name="nama_depan" placeholder="Nama Depan">
            </div>
            <div class="col">
              <input type="text" class="form-control" name="nama_belakang" placeholder="Nama Belakang">
            </div>
          </div>
        </div>

        <div class="form-group">
          <input type="text" name="username" class="form-control"  placeholder="Username">
        </div>

        <div class="form-group">
          <input type="email" name="email" class="form-control"  placeholder="Email">
        </div>

        <div class="form-group">
          <input type="text" class="form-control"  name="handphone" placeholder="Handphone">
        </div>

        
        <div class="form-group">
          <label for="tgl_lahir"> Tanggal Lahir </label>
          <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control">
        </div>


        <div class="form-group">
          <input type="text" name="alamat_user" class="form-control" placeholder="Alamat">
        </div>

        <div class="form-group">
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <?php 
                  $sql_kota= mysqli_query($koneksi, "SELECT * FROM kota");
               ?>
               <select class="form-control" name="id_kota">
                  <?php  while ($row_kota = mysqli_fetch_array($sql_kota)) {
                    ?>
                  <option value="<?php echo $row_kota['id_kota'] ?>"> <?php echo $row_kota['nama_kota'] ?></option>
                <?php } ?>
                </select>
            </div>

            <div class="col-md-3 mb-3">
              <input type="text" class="form-control" name="provinsi" placeholder="Provinsi" required>
            </div>

            <div class="col-md-3 mb-3">
              <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos" required>
            </div>
          </div>
        </div>
        
        <div class="form-group">
         <input type="password"  name="password" class="form-control" placeholder="Password" >
        </div>
        <div class="form-group">
         <input type="password"  name="conpassword" class="form-control" placeholder="Confirm Password" >
        </div> 

        <div class="form-group">
          <button type="submit" name="register" class="btn btn-warning"> Sign Up </button>
        </div>
        <div class="form-group">
           <p style="text-align: center;"><small> Already have an account? <a href="login.php" class="sign-link"> <b><u> Sign in here! </u></b></a> </small></p>
        </div>       

      </form>
      <!-- end form sign-up -->
    </div>
    
  </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>