<?php

session_start();

require '../conn.php';

if ( !isset($_SESSION["login"]) ){
    
    header("location:login.php");
    exit;
}

$menu = mysqli_query($conn,"SELECT COUNT(*)  FROM  menu");
$jumlahmenu= mysqli_fetch_array($menu)[0];

$transaksi = mysqli_query($conn,"SELECT COUNT(*)  FROM  transaksi");
$jumlahtransaksi = mysqli_fetch_array($transaksi)[0];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>JajananDamars</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow" style="background-color:brown">
        <div class="container ">
            <a class="navbar-brand text-white" href="#"><b>JajananDamars</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="navbar-nav text-center">
                            <li><a class="nav-link active text-white" aria-current="page" href="index.php">Home</a></li>
                            <li><a class="nav-link active text-white" aria-current="page" href="Menu/menu.php">Daftar
                                    Menu</a></li>
                            <li><a class="nav-link active text-white" aria-current="page"
                                    href="order/order.php">Transaksi</a></li>
                        </div>
                    </div>
                    <ul class="nav navbar-nav navbar-right navbar-light">
                        <li class="nav-item dropdown text-center">
                            <a class="nav-link dropdown-toggle active text-white" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                                    class="bi bi-person-circle me-2 "></i>
                                Profil
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="user/edit.php"><i
                                            class="bi bi-gear-fill me-2"></i>Edit Profil</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="logout.php" onclick="
                return confirm('Yakin akan logout?')"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>

    <div class="container mt-5">
        <div class="pt-5 pb-3">
            <div class="alert alert-secondary rounded rounded-3" role="alert">
                <h2 class=" ps-5 pt-5"><b>Selamat Datang Di JajananDamars</b></h2>
                <h5 class=" ps-5 pb-5">Halo <b><?= $_SESSION["nama"] ?></b> .Anda login sebagai <b>Admin</b>
                </h5>
            </div>
            <div class="pt-4">
                <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jumlah Menu</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 ms-2">
                                                <?=$jumlahmenu?> buah
                                            </div>
                                        </div>
                                        <div class="col-auto me-4">
                                            <i class="bi bi-menu-button-fill " style="font-size: 2rem;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jumlah Transaksi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 ms-2">
                                                <?=$jumlahtransaksi?> buah
                                            </div>
                                        </div>
                                        <div class="col-auto me-4">
                                            <i class="bi bi-wallet-fill " style="font-size: 2rem;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/bootstrap.js"></script>
</body>

</html>







