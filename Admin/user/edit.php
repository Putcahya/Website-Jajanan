<?php

session_start();

require '../../conn.php';

if ( !isset($_SESSION["login"]) ){
    
    header("location:login.php");
    exit;
}

$result = mysqli_query($conn, 'SELECT * FROM users WHERE id_user= '.$_SESSION["id"].'');
$row = mysqli_fetch_assoc($result);

if (isset ($_POST["edit"])) {
    if ( edit_profile ($_POST) > 0) {
        echo "
            <script>
                alert('Profil Berhasil diubah....!');
                document.location.href = 'edit.php';
            </script>
        ";

    } else {
        echo "
        <script>
            alert('Profil Gagal diubah.....!');
            document.location.href = 'edit.php';
        </script>
    ";
    }
}


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
                            <li><a class="nav-link active text-white" aria-current="page" href="../Menu/menu.php">Daftar
                                    Menu</a></li>
                            <li><a class="nav-link active text-white" aria-current="page" href="../orderorder.php">Transaksi</a>
                            </li>
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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Profil</h1>
            </div>

            <form action="" class="mb-3" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama"
                        value="<?php echo $row["nama"] ?>" required>
                </div>

                <div class="mb-3">
                    <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No Telephon"
                        value="<?php echo $row["no_hp"] ?>" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-primary" name="edit">Ubah Profil</button>
                </div>

            </form>

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Ganti Password</h1>
            </div>

            <form action="" class="mb-3" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" id="id" value="<?= $_SESSION['id'] ?>">

                <div class="mb-3">
                    <input type="password" class="form-control" name="oldpassword" id="oldpassword"
                        placeholder="Password Lama" required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="newpass" id="newpass" placeholder="Password Baru"
                        required>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" name="confirm" id="comfirm"
                        placeholder="Konfirmasi Password Baru" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-primary" name="password">Ubah
                        Password</button>
                </div>

            </form>

        </div>
    </div>

    <script src="../../js/bootstrap.js"></script>
</body>

</html>