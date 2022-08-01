<?php

session_start();

require '../../conn.php';

if ( !isset($_SESSION["login"]) ){
    
    header("location:login.php");
    exit;
}


if (isset($_POST["add"])) {

    if(add_menu($_POST) > 0) {
        echo "<script>
                alert('Data Berhasil DiTambahkan ');
            </script>";
    }else {
        echo "<script>
                alert('Data Gagal DiTambahkan ');
            </script>";
    }
}

$menu = query("SELECT * FROM menu");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.css">
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
                            <li><a class="nav-link active text-white" aria-current="page" href="../index.php">Home</a></li>
                            <li><a class="nav-link active text-white" aria-current="page" href="menu.php">Daftar
                                    Menu</a></li>
                            <li><a class="nav-link active text-white" aria-current="page"
                                    href="../order/order.php">Transaksi</a></li>
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
                                <li><a class="dropdown-item" href="../user/edit.php"><i
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah
                Menu</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Nama Menu" required>
                                </div>
                                <div class="mb-3">
                                    <input type="file" name="foto" id="foto" required class="form-control">
                                </div>
                                <div class="mb-3">
                                    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"
                                        placeholder="Deskripsi" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga"
                                        required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="add">ADD</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped responsive mt-4 w-100 text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>aksi</th>
                </tr>
                <?php $i=1; ?>
                <?php foreach($menu as $row){ ?>

                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["nama"] ?></td>
                    <td><img src="../../upload/img/<?= $row['foto'] ?>" width="100px"></td>
                    <td>Rp. <?php echo number_format($row["harga"],2,',','.' ) ?></td>
                    <td><?= $row["deskripsi"]  ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id_menu'] ?>" class="btn btn-outline-warning"><i
                                class="bi bi-pencil-square me-3"></i>Edit</a>
                        <a href="delete.php?id=<?php echo $row['id_menu'] ?>" onclick="
                return confirm('Yakin Ingin menghapus data ini?')" class="btn btn-outline-danger mx-2"><i
                                class="bi bi-trash-fill me-3"></i>Hapus</a>
                    </td>
                </tr>

                <?php $i++ ?>
                <?php } ?>
            </table>
        </div>
    </div>

    <script src="../../js/bootstrap.js"></script>
</body>

</html>