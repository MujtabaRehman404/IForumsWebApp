<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - iForums</title>
    <style>
      .container_footer{
            width:100%;
            height:10%;
            background-color:black;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'components/navbar.php';
    require 'components/config.php';
    $loginalert = false;
    if(isset($_GET['login'])){
      $loginalert = true;  
    }

    if($loginalert){
      $user = $_SESSION['username'];
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Login Successfull, Welcome <i>'.$user.'</i>.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    
    <h1 style="text-align:center;" class="my-3">Welcome to iForums <i style="text-transform:capitalize;"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?></i></h1>
    
    <div class="container my-4">
    <div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="components/images/slider1.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="components/images/slider2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="components/images/slider3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    </div>

    <div class="container">
    <div class="row">
      <?php
      $query = mysqli_query($conn,"SELECT * FROM `categories`");
      while($row = mysqli_fetch_assoc($query)){
        $title = $row['title'];
        $desc = $row['description'];
        $id = $row['cat_id'];
        echo '<div class="col-sm-4 my-2">
        <div class="card" style="width: 18rem;">
        <img src="https://source.unsplash.com/random/800×400/?coding,programming" class="card-img-top" alt="img1">
        <div class="card-body">
          <h5 class="card-title"><a style="text-decoration:none;text-transform:uppercase;" href="threads.php?id='.$id.'">'.$title.'</a></h5>
          <p class="card-text">'.substr($desc,0,35).'</p>
          <a href="threads.php?id='.$row['cat_id'].'" class="btn btn-outline-dark">Visit Thread</a>
        </div>
      </div>
        </div>';
      }
      ?>
</div>   
</div>  

    
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <!--<footer class="container-fluid navbar-dark bg-dark navbar" style="color:white;">
  <h5>heyloo</h5>
</footer>
    -->

    <?php include 'components/footer.php'; ?>

</body>
</html>
