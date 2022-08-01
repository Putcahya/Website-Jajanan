<?php

$conn = mysqli_connect("localhost","root", "", "jajanandamars")
        or die ('gagal terkoneksi ke database');


function query ($query) {
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function signup($data) {
    global $conn;

    $nama = strtolower(stripslashes($data ["nama"] ) );
    $nohp = strtolower( stripslashes($data ["nohp"] ) );
    $password = mysqli_real_escape_string( $conn, $data ["password"] );
    $password2 = mysqli_real_escape_string( $conn, $data ["password2"] );

    //cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    //enskripsi password
    $password = password_hash($password , PASSWORD_DEFAULT);

    //tambahkan data ke database
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$nama', '$nohp','$password')");
    return mysqli_affected_rows($conn);

}

function edit_profile($data){
    global $conn;
    
    $id = $_SESSION["id"];
    $nama = htmlspecialchars($data['nama']);
    $nohp = htmlspecialchars($data["no_hp"]);

    //query ubah data
    $query ="UPDATE users SET
            nama = '$nama',
            no_hp = '$nohp'
            WHERE id_user = $id";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function edit_password($data){
    global $conn;
    
    $id = $data["id"];
    $oldpass= htmlspecialchars($data["oldpassword"]);
    $newpass = htmlspecialchars($data["newpass"]);
    $confirm = htmlspecialchars($data["confirm"]);

    $result = mysqli_query($conn,"SELECT * FROM users WHERE id_user = '$id' ");
    $row = mysqli_fetch_assoc($result);

     // cek password lama
    if (password_verify($oldpass,$row["password"])) {
        
        if($confirm === $newpass) {
            //enskripsi password baru
            $newpass = password_hash($newpass, PASSWORD_DEFAULT);

            $query = "UPDATE users SET password = '$newpass' WHERE id_user = $id";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);

        } else {
            echo "<script>
                alert ('Konfirmasi password salah');
        </script>";
            return false;
        }
    } else {
        echo "<script>
                alert ('password lama salah');
        </script>";
    }
}

function order($data){
    global $conn;

    $id = htmlspecialchars($data["id_menu"]);
    $nama = htmlspecialchars($data["nama"]);
    $no_hp = htmlspecialchars($data["nohp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO transaksi VALUES ('','$id','$nama','$alamat','$no_hp')";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}


function upload() {
    $namafile = $_FILES['foto']['name'];
    $sizefile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmp_name =$_FILES['foto']['tmp_name'];

    //cek jenis file
    $ekstensifileValid = ['jpg','jpeg','png'];
    $ekstensifile = explode('.', $namafile);
    $ekstensifile = strtolower(end($ekstensifile));
    if (!in_array($ekstensifile,$ekstensifileValid)) {
        echo "<script>
                alert('Format File yang anda upload tidak sesuai ');
            </script>";
        return false;
    }

    //cek ukuran file
    $maxsize = 10000000;
    if ($sizefile > $maxsize) {
        echo "<script>
                alert('Ukuran File yang Anda upload terlalu besar');
            </script>";
        return false;
    }

    move_uploaded_file($tmp_name, '../../upload/img/' . $namafile);

    return $namafile;

}

function add_menu($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);
    
    $foto = upload();

    
    //masukan data
    $query = "INSERT INTO menu VALUES ('','$nama','$foto','$deskripsi','$harga')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function edit_menu($data){
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $nama = htmlspecialchars($data["nama"]);
    $oldphoto = htmlspecialchars($data["oldphoto"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $harga = htmlspecialchars($data["harga"]);

    if($_FILES["foto"]["error"] === 4) {
        $foto = $oldphoto;
    } else {
        $foto = upload();
    }

    // update data 
    $query = "UPDATE menu SET
            nama = '$nama',
            foto = '$foto',
            deskripsi = '$deskripsi',
            harga = '$harga'
            WHERE id_menu= $id";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function delete_menu($id){
    global $conn;

    // hapus data dari database
    mysqli_query($conn,"DELETE FROM transaksi WHERE id_transaksi = '$id' ");

    return mysqli_affected_rows($conn);
}


?>