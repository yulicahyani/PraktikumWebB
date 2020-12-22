<nav  class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <a class="navbar-brand" href="index.php"><img src="img/logos.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" >
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <!-- start left nav -->
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="index.php"> Home </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="daftarexpert.php">Paint</a>
                      <a class="dropdown-item" href="daftarexpert.php">Furniture</a>
                      <a class="dropdown-item" href="daftarexpert.php">Souvenir</a>
                      <a class="dropdown-item" href="daftarexpert.php">Statue</a>
                      <a class="dropdown-item" href="daftarexpert.php">Handicraft</a>
                    </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="keranjang.php"><i class="fas fa-cart-plus"></i> Cart </a>
                  </li>
                  <!-- Login -->
                  <!-- <li class="nav-item">
                      <a class="nav-link" href="#login"><i class="fas fa-user-circle"></i> Login </a>
                  </li> -->

                  <!-- after login -->
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> Profil</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="pesanan_saya.php">My Order</a>
                      <a class="dropdown-item" href="Seller/profil.php">My Acount</a>
                      <a class="dropdown-item" href="Seller/informasi-toko.php">My Store</a>
                      <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                  </li>  
                  <!-- end after login -->                
              </ul>
              <!-- end left nav -->

              <!-- start right nav -->
              <ul class="navbar-nav ml-auto">
    
                <li>
                <form action='searchnav.php' method='post'class="form-inline">
                  <div id="top-search">
                    <input class="form-control mr-sm-2 rounded-pill" type="search" placeholder="Search" name='key'aria-label="Search">
                    <button class="btn btn-outline-warning my-2 my-sm-0 rounded-pill" type="submit" name='search'>Search</button>
                  </div>
                </form>
              </li>
              </ul>
              <!-- end right nav -->
          </div>
      </nav>