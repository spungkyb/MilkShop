<?php
require_once "dbconfig.php";
class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function register($username,$email,$password){
		$stmt = $this->conn->prepare("INSERT INTO account(username,email,password) VALUES('$username','$email','$password')");
		$stmt->execute();
	}
	public function login($username,$password){
		$stmt = $this->conn->prepare("SELECT * FROM account WHERE username='$username' AND password='$password'");
		$stmt->execute();
		$user=$stmt->fetch(PDO::FETCH_ASSOC);
		if($stmt->rowCount()==1){
			session_start();
			$_SESSION['user_name']=$user['username'];
			header("location:../index.php");
		}
		else{
			
			echo "<script>if(confirm('Email atau Password salah')){document.location.href='login.php'};</script>";
		
		}
	}

	public function simpanbarang($nama,$harga,$stok,$img,$desc){
		$stmt = $this->conn->prepare("INSERT INTO products(name,price,stock,image,description) VALUES ('$nama','$harga','$stok','$img','$desc')");
		$stmt ->execute();
		header('location:index.php');
	}

	public function transaksi($nama,$nohp,$alamat,$totalharga,$detail){
		$stmt = $this->conn->prepare("INSERT INTO transaksi(username,nohp,alamat,totalharga,detail) VALUES ('$nama','$nohp','$alamat','$totalharga','$detail')");
		$stmt ->execute();
		header('location:pembayaransukses.php');
	}

}
?>

