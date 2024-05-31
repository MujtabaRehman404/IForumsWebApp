<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup - iForums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'components/navbar.php';
    require 'components/config.php';
    
    $newsub=false;

    if(isset($_GET['newuser']))
    {
      $newsub=true;
    }

    if($newsub)
    {
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <a style="color:black;" href="login.php"> You can login here.</a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
 
    }
    $exists = false;
    $loginexists=false;
    if(isset($_SESSION['loggedin'])){
      $loginexists=true;
    }
    if(!$loginexists)
    {
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $cp = $_POST['cpassword'];
      //$hash = password_hash($password,PASSWORD_DEFAULT);
      $dupuser = mysqli_query($conn,"SELECT * FROM userdata WHERE username = '$username'");
      $result = mysqli_num_rows($dupuser);
      if($result>0){
        $exists = true;
      }
      if($exists){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> Username Already Exists, try again?
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      else
      {
      if($password==$cp){
        $hashpass = password_hash($password,PASSWORD_DEFAULT);
        $adduser = mysqli_query($conn,"INSERT INTO `userdata` (`password`, `dt`, `username`) VALUES ('$hashpass', current_timestamp(), '$username')");
    if($adduser){
      header("location:signup.php?newuser=true");
      die("die");
      exit();
    }
    else
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> an error occured, try again later?
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    }
    else
    {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops!</strong> passwords do not match, try again?
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
}
    }
  }
  else
  {
    header('location: home.php');
    die("you are already, loggedin first logout then you can create a account");
    exit();
  }
    ?>

    <h1 style="text-align:center;" class="my-3">Signup to iForums</h1>
    <div class="container lul">
    <form action='signup.php' method='post'>
    <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" required aria-describedby="emailHelp">
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword" required>
  </div>
  
  <button type="submit" class="btn btn-outline-dark">Submit</button>
</form>   
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <?php include 'components/footer.php'; ?>  
</body>
</html>
