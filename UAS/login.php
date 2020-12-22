 <?php 
 require 'koneksi.php';

if (isset($_POST["submit"])){

  $username = $_POST["username"];
  $password = mysqli_escape_string($koneksi, $_POST["password"]);


  $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
  

  //cek username
  if (mysqli_num_rows($cek ) === 1){
    $row = mysqli_fetch_assoc($cek);
    //cek password
    if ($password == $row["passwords"]) {
      $_SESSION['login'] = true;
      $_SESSION["username"] = $row["username"];
      $_SESSION["id_user"] = $row["id_user"];
      $_SESSION["email"] = $row["email"];
      $id_user=$_SESSION["id_user"];

      $cek = mysqli_query($koneksi, "SELECT * FROM toko WHERE id_user = $id_user");

      if (mysqli_num_rows($cek) ===1) {
      	$row = mysqli_fetch_assoc($cek);
      	$_SESSION['toko'] =true;
      	$_SESSION['id_toko']= $row["id_toko"];
        // echo "<h1>berhasil</h1>";
      }

      header("Location: index.php");
      exit;
    }
  }
  $error = true;
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
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/fe118aecdc.js" crossorigin="anonymous"></script>

    <title>LOGIN</title>
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



    <!-- form-login -->
    <div class="container">
        <h3 class="text-center"><b><u> LOGIN </u></b></h3><br>
        <form action="" method="POST">
            <div class="form-group">
                <label> username </label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label> password </label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-warning"> Sign In </button>
            </div>
            <div class="form-group">
                <p style="text-align: center;"><small> Don't have an account? <a href="signup.php" class="sign-link"> <b><u> Sign up here! </u></b></a> </small></p>
            </div>            
        </form>
    </div>
    <!-- end form-login -->
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