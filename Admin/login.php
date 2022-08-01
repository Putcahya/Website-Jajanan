<?php

session_start();

require '../conn.php';

if (isset ($_POST['login'] ) ) {
    
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]) ;
    $password =  mysqli_real_escape_string($conn, $_POST["pass"]);

    $result = mysqli_query($conn, "SELECT * FROM users WHERE nama = '$nama' ");
    
    // cek username
    if ( mysqli_num_rows($result) === 1 ) {
        
        // cek password
        $row = mysqli_fetch_assoc($result);
        //$session = mysqli_fetch_object($result);
        if ( password_verify($password, $row["password"] ) ) {
            //set session
            $_SESSION["login"] = true;
            $_SESSION['nama'] = $row["nama"];
            $_SESSION["id"] =  $row["id_user"];

            echo " <script>
                    window.location='index.php'
                </script>";
            exit;
        }else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
if ( isset($_SESSION["login"]) ){
    header("location:index.php");
    exit;
}


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
    <nav class="navbar navbar-expand-lg navbar-light  fixed-top shadow" style="background-color:brown">
        <div class="container ">
            <a class="navbar-brand text-white" href=" #"><b>JajananDamars</b></a>
            <ul class="nav navbar-nav navbar-right navbar-light">
                <a href="signup.php">
                    <button type="submit" class="btn btn-outline-light me-2 my-2">Daftar</button>
                </a>
                <a href="login.php">
                    <button type="submit" class="btn btn-outline-light me-2 my-2">Login</button>
                </a>
            </ul>
        </div>
    </nav>

    <div class="container-fluid vh-100 pt-2" style="margin-top:50px">
        <div class="" style="margin-top:50px">
            <div class="rounded d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                    <div class="text-center">
                        <h3 class="text-dark"><b>Masuk</b></h3>
                    </div>
                    <form action="" method="post">
                        <div class="p-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text " style="background-color:brown">
                                    <i class="bi bi-person-fill text-white"></i>
                                </span>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama"
                                    htmlspecialchars>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text " style="background-color:brown">
                                    <i class="bi bi-lock-fill text-white"></i>
                                </span>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="password"
                                    htmlspecialchars>
                            </div>

                            <?php if(isset($error)) {?>
                            <div class="alert alert-danger" role="alert">
                                <p>username / password salah</p>
                            </div>
                            <?php }; ?>
                            <button class="btn btn-outline-success text-center mt-2" type="submit" name="login">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>

</html>