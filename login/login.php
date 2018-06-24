<!DOCTYPE html>
<html>
<head>
  <title>Login - MilkShop</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
  <div class="container" style="width:45%">
      <div class="jumbotron" style="margin-top:200px">
        <form action="proses.php?aksi=login" method="post" class="form-horizontal" style="">
          <div class="form-group">
            <label class="control-label col-sm-2" for="username" >Email</label>
            <div class="col-sm-10"> 
              <input type="text" class="form-control" id="username" placeholder="Username" name="username">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="username" >Password</label>
            <div class="col-sm-10"> 
              <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
          </div>
          <button type="submit" class="btn btn-default" style="float:right">Login</button>
          <h6>Tidak punya akun? <a href="signup.php">klik disini</a></h6>   
        </form>
      </div>
    </div>
    </div>
</body>
</html>
