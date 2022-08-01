<?php

require 'conn.php';

$menu = query("SELECT * FROM menu ORDER BY id_menu DESC");


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
        <div class="pt-5 pb-3 justify-content-center">
            <div class=" d-flex flex-wrap ">
                <?php foreach($menu as $row) { ?>
                <div class=" box flex-row bg-highlight mb-4 px-4 justify-content-center">
                    <div class="item pb-4 my-5" style="height: 450px;">
                        <div class="text-center pt-0 mt-0 pb-4 mb-3" style="border-radius: 15px;">
                            <div class="card  text-white shadow pt-0 mt-0 h-auto mb-3"
                                style="width: 18rem; border-radius: 15px; background-color:brown;">
                                <img style="border-radius: 15px; height:300px; width: 18rem;"
                                    src="upload/img/<?php echo $row['foto'] ?>">
                                <div class="card-body">
                                    <h3><b><?php echo $row['nama'] ?></b></h3>
                                    <p><?= $row["deskripsi"] ?></p>
                                    <p>Rp. <?php echo number_format($row['harga'],2,',','.' )?></p>
                                    <a href="order.php?id=<?=$row['id_menu'] ?>">
                                        <button type="button" class="btn btn-outline-light">Beli</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="js/bootstrap.js"></script>
</body>

</html>