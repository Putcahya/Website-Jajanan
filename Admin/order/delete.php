<?php

session_start();
require '../../conn.php';

if (!isset($_SESSION["login"]) ) {
    header("location:../login.php");
    exit;
}

$id = $_GET["id"];

if (delete_menu($id) > 0) {
    echo "<script>
            alert('Data Berhasil Di Hapus');
            document.location.href = 'order.php';
        </script>";
} else {
    echo "<script>
        </script>";
}

?>