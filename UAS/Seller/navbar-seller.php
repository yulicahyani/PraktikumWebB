<div id="home">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="informasi-toko.php"><img src="img/logos.png" alt=""></a>
        <h4 class="mr-2 mt-1 text-white">Seller</h4>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <!-- start right nav -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i> Profil</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="profil.php">My Acount</a>
                        <a class="dropdown-item" href="informasi-toko.php">My Store</a>
                        <a class="dropdown-item" href="../index.php">Back to ACRAFT</a>
                        <a class="dropdown-item" href="../logout.php">Log Out</a>
                    </div>
                </li>
                <li>
                <form action='../searchnav.php' method='post'class="form-inline">
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
</div>