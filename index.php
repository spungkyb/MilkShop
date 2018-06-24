<?php
session_start();
$product_ids = array();
//session_destroy();
//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        
        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['shopping_cart']);
        
        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        if (!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_GET, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
            );   
        }
        else { //product already exists, increase quantity
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_GET, 'id')){
                    //add item quantity to the existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_GET, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
        );
    }
}

if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//pre_r($_SESSION);

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
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
        <title>MilkShop</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="cart.css" />
    </head>
    <body>

<!--navbar-->
<ul>
  <li><a href="#home">Milk Shop</a></li>
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
        <?php
        $connect = mysqli_connect('localhost', 'root', '', 'milkshop');
        $query = 'SELECT * FROM products ORDER by id ASC';
        $result = mysqli_query($connect, $query);

        if ($result):
            if(mysqli_num_rows($result)>0):
                while($product = mysqli_fetch_assoc($result)):
                //print_r($product);
                ?>
                <div class="col-sm-4 col-md-3" >
  
                    <form method="post" action="index.php?action=add&id=<?php echo $product['id']; ?>">
                        <div class="products">
                        <?php $stok = $product['stock'];?>
                            <img style ="width:200px!important; height:200px!important;" src="gambar/<?php echo $product['image']; ?>" class="img-responsive" />
                            <h4 class="text-info"><?php echo $product['name']; ?></h4>
                            <h4>Rp <?php echo $product['price']; ?></h4>
                            <!--<h5><?php echo "Tersedia ".$stok; ?></h5>-->
                            <input type="text" name="quantity" class="form-control" value="1" />
                            <input type="hidden" name="name" value="<?php echo $product['name']; ?>" />
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
                            <input id="tambah" type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-info"
                                   value="Tambah" />
                        </div>
                    </form>
                </div>
                <?php
                endwhile;
            endif;
        endif;   
        ?>
        <div style="clear:both"></div>  
        <br />  
        <div class="table-responsive">  
        <table class="table">  
            <tr><th colspan="5"><h3>Detail Pembelian</h3></th></tr>   
        <tr>  
             <th width="40%">Nama Produk</th>  
             <th width="10%">Jumlah</th>  
             <th width="20%">Harga</th>  
             <th width="15%">Total</th>  
             <th width="5%">Aksi</th>  
        </tr>  
        <?php   
        if(!empty($_SESSION['shopping_cart'])):  
            $ketbelanja = "";
            
             $total = 0;  
        
             foreach($_SESSION['shopping_cart'] as $key => $product): 
                $belanja = $product['quantity'].' x '.$product['name'].'('.$product['price'].') => '.$product['quantity'] * $product['price'].", ";
                $ketbelanja = $belanja.$ketbelanja; 

                //$ketbelanja = $product['quantity'].' x &nbsp'.$product['name'].'('.$product['price'].') &nbsp => '.$product['quantity'] * $product['price']."<br>".$ketbelanja;        
        ?>  
        <tr>  
           <td><?php echo $product['name']; ?></td>
           <td><?php echo $product['quantity']; ?></td>  
           <td>Rp <?php echo $product['price']; ?></td>  
           <td>Rp <?php echo number_format($product['quantity'] * $product['price'], 2); ?></td>  
           <td>
               <a href="index.php?action=delete&id=<?php echo $product['id']; ?>">
                    <div class="btn-danger">Hapus</div>
               </a>
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']);  
             endforeach;  
        ?>  
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td align="right">Rp <?php echo number_format($total, 2); ?></td>  
             <td></td>  
        </tr>  
        <tr>
            <!-- Show checkout button only if the shopping cart is not empty -->
            <td colspan="5">
             <?php 
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
             ?>
         <?php
   if(empty($_SESSION['user_name'])){
              echo "<script>if(confirm('Anda Belum Login, Silahkan login terlebih dahulu')){document.location.href='login/login.php'};</script>";
    
        }
        else{
            echo '<a href="formpembayaran.php" class="button">Pembayaran</a>';
            $_SESSION['total'] = $total;
            $_SESSION['detail'] = $ketbelanja;
            //echo "$total<br>";
            //echo "$ketbelanja";
        }
  ?>
             <?php endif; endif; ?>
            </td>
        </tr>
        <?php  
        endif;
        ?>  
        </table>  
         </div>
        </div>
    </body>
</html>
