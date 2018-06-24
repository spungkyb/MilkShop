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
<?php
session_start();
unset($_SESSION['shopping_cart']);;
?>
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
    <div class="container text-center">
    <h2>Pembayaran melalui rekening Mandiri 1234567890 An MilkShop min 1 hari</h2>
    <h3>Pengiriman Susu melalui JNE GRATIS ONGKIR</h3>
    <img src="sukses.png" class="img-responsive center-block" width="20%">
    </div>
</body>
</html>