<?php
    if (isset($_POST['btnsave'])) {
        $nama= $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $imgFile = $_FILES['gambar']['name'];
        $tmp_dir = $_FILES['gambar']['tmp_name'];
        $imgSize = $_FILES['gambar']['size'];

        $upload_dir = 'gambar/';
        $deskripsi = $_POST['deskripsi'];
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
        $userpic = rand(1000,1000000).".".$imgExt;
        $valid_extensions = array('jpeg','jpg','png','gif');
        if(in_array($imgExt, $valid_extensions)){
            if ($imgSize<5000000) {
                move_uploaded_file($tmp_dir, $upload_dir.$userpic);
            } else {
                echo "<script>alert('file terlalu besar')</script>";
                header('location:form.php');
            }
            
        }
        else{
            echo "<script>alert('Type file tidak sesuai')</script>";
            header('location:form.php');
        }
        require_once 'login/class.php';
        $susu = new USER();
        $susu->simpanbarang($nama,$harga,$stok,$userpic,$deskripsi);
    }   
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Susu - Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
    <div class="container">
    <h3>Form Milk - ADMIN</h3>
    <form method="post" enctype="multipart/form-data">
        <label>Merk Detail Susu</label>
        <input class="form-control" type="text" name="nama"></input>
        <label>Harga</label>
        <input class="form-control" type="text" name="harga"></input>
        <label>Stok</label>
        <input class="form-control" type="text" name="stok"></input>
        <label>Unggah Gambar</label>
        <input class="form-control" type="file" name="gambar"></input>
        <!--<input class="form-control" type="file" name="user_image"></input>-->
        <label>Keterangan</label>
        <textarea class="form-control" rows="5" id="deskripsi" name="deskripsi"></textarea>
        <button type="submit" class="btn btn-success" name="btnsave">Simpan</button>
    </form>
    </div>
</body>
</html>