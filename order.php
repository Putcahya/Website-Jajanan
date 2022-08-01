<?php

require 'conn.php';

$id= $_GET["id"];

if(isset($_POST["order"])){
    if(order($_POST) > 0){
        echo"
            <script>
                alert('Order Berhasil Pesananmu Akan Segera diantar');
            </script>
        ";
    }else{
        echo"
            <script>
                alert('Order Gagal');
            </script>
        ";
    }
}

$menu = query("SELECT * FROM menu WHERE id_menu = $id")[0];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>JajananDamars</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow">
        <div class="container ">
            <a class="navbar-brand " style="color: brown;" href="#"><b>JajananDamars</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="navbar-nav text-center">
                            <li><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="pt-5 pb-3 ">
            <form action="" method="post">
                <div class="mb-3">
                    <input type="hidden" name="id_menu" id="id" class="form-control" value="<?= $menu['id_menu'] ?>">
                </div>
                <div class="mb-3">
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Pemesan">
                </div>
                <div class="mb-3">
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Pengiriman">
                </div>
                <div class="mb-3">
                    <input type="text" name="nohp" id="nohp" class="form-control" placeholder="No Hp">
                </div>
                <div class="mb-3">
                    <button type="submit" name="order" class="btn btn-warning">Beli</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/bootstrap.js"></script>
</body>

</html>