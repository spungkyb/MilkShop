<?php
    session_start();
    if (isset($_POST['btnsave'])) {
        $nama= $_POST['nama'];
        $nohp= $_POST['nohp'];
        $alamat= $_POST['alamat'];
        $totalharga= $_POST['totalharga'];
        $detail = $_POST['detail'];
        require_once 'login/class.php';
        $pembayaran = new USER();
        $pembayaran->transaksi($nama,$nohp,$alamat,$totalharga,$detail);
    }   
?>

<!--style navbar-->
<style type="text/css">
    ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
    color: #f1f1f1;
}

.active {
    background-color: #4CAF50;
}
</style>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pembayaran</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
<!--navbar-->
<ul>
  <li><a href="index.php">Milk Shop</a></li>
     <?php
   if(empty($_SESSION['user_name'])){
     echo '<li style="float:right"><a href="login/login.php">Login</a></li>';
    echo '<li style="float:right"><a href="login/signup.php">Sign Up</a></li>';
        }
        else{
             $nama = $_SESSION['user_name'];
            echo '<li style="float:right"><a href="login/proses.php?aksi=keluar">Logout</a></li>';
            echo '<li style="float:right"><a href="">' . $nama . '</a></li>';
        }
  ?>  
</ul>
<!---->
    <div class="container">
    <h3>Form Pengiriman</h3>
    <form method="post" enctype="multipart/form-data">
        <?php
         $nama = $_SESSION['user_name'];
         $total =  $_SESSION['total'];
         $ketbelanja = $_SESSION['detail'];
         $ketbelanja = str_replace(',', ', ', $ketbelanja);
        ?>
        <label>Nama Pembeli</label>
        <input class="form-control" type="text" name="nama" value="<?php echo $nama ?>" readonly></input>
        <label>No HP</label>
        <input class="form-control" type="text" name="nohp"></input>
        <label>Alamat</label>
        <textarea class="form-control" rows="3" id="alamat" name="alamat"></textarea>
        <label>Total Harga</label>
        <input class="form-control" type="text" name="totalharga" value="<?php echo $total ?>" readonly></input>
        <label>Detail Pembelian</label>
        <textarea class="form-control" rows="5" id="detail" name="detail" readonly><?php echo $ketbelanja ?></textarea>
        <button type="submit" class="btn btn-success" name="btnsave">Kirim</button>
    </form>
    </div>
</body>
</html>