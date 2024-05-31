<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - iForums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'components/navbar.php';
    require 'components/config.php';
    $login=false;
    $loginexists=false;
    $logoutalert=false;
    $loginthreads = false;
    $loginth = false;
    $loginfirstalert = false;
    $likealert = false;

    if(isset($_GET['topicid'])){
      $likealert=true;
    }

    if(isset($_GET['loggedout'])){
      $logoutalert=true;
    }
    
    if(isset($_GET['notloggedin'])){
      $loginfirstalert = true;
    }

    if($likealert){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> Login first to like or reply</i>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }

    if($logoutalert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Logged out successfully</i>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
    
    if($loginfirstalert){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> you are already logged out</i>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';  
    }

    if(isset($_SESSION['loggedin'])){
      $loginexists=true;
    }

    if(isset($_GET['redthread'])){
      $loginthreads = true;
    }
    else if(isset($_GET['redth'])){
      $loginth = true;
    }

    if(!$loginexists)
    {
      if($_SERVER['REQUEST_METHOD']=='POST'){
      $username = $_POST['username'];
      $password = $_POST['password'];
      $query = mysqli_query($conn,"SELECT * FROM `userdata` WHERE `username` = '$username'");
      while($res = mysqli_fetch_assoc($query)){
        $verify = password_verify($password,$res['password']);
        if($res['username']==$username && $verify){
        $login=true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['sno']= $res['id'];
      }
      }
      if($login){
        if($loginthreads){
          $sampleid = $_SESSION['threads'];
          header("location:threads.php?id=$sampleid&loginstat=true");
          die("location:threads.php?id=$sampleid");
          exit();    
        }
        else if($loginth){
          $sampleid2 = $_SESSION['thid'];
          header("location:th.php?id=$sampleid2&loginstat=true");
          die("location:th.php?id=$sampleid2");
          exit(); 
        }
        else if($likealert){
          $try = $_SESSION['thid'];
          header("location:th.php?id=$try&loginstat=true&#comm");
          die("location:th.php?id=$try");
          exit();   
        }
        else
        {
          header("location:home.php?login=true");
          die("location:home.php?login=true");
          exit();
        }
        }
      else
      {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> Wrong credentials, try again?
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    
      }
    }
  }
  else
  {
    header('location: home.php');
    die("you are already loggedin head over to home.php");
    exit();
  }
    ?>

    <h1 style="text-align:center;" class="my-3">Login to iForums</h1>

    <div class="container">
      <?php
      if($loginthreads){
        echo '<form action="login.php?redthread=true" method="POST">';
      }
      else if($loginth){
        echo '<form action="login.php?redth=true" method="POST">';  
      }
      else if($likealert){
        echo '<form action="login.php?topicid=true" method="POST">';   
      }
      else
      {
        echo '<form action="login.php" method="POST">';  
      }
  ?>
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" required aria-describedby="emailHelp">
    <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-outline-dark">Submit</button>
</form>   
</div>
<a href="signup.php">New here? Signin here first.</a>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <?php include 'components/footer.php'; ?>  
</body>
</html>
