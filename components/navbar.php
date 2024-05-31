<?php
 require 'components/config.php';
?>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">iForums</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <?php 
            $query = "SELECT * FROM `categories` LIMIT 5";
            $fetch_cat = mysqli_query($conn,$query);
            while($res = mysqli_fetch_assoc($fetch_cat)){
              $title = $res['title'];
              $id = $res['cat_id'];
              echo '<li><a class="dropdown-item" href="threads.php?id='.$id.'">'.$title.'</a></li>';
            }
            ?>
          </ul>
        </li>
        </ul>
        <?php
        session_start();
        if(isset($_SESSION['loggedin'])){
          ?>
       <form method="post" action="search.php" class="d-flex" role="search">
        <input class="form-control me-2" id="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" ">Search</button>
        <a href="logout.php?loggedin=true" class="btn btn-outline-success mx-2">Logout</a>
      </form>
      <?php
      
        }
        else{
          echo '<form method="post" action="search.php" class="d-flex" role="search">
          <input class="form-control me-2" id="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit" ">Search</button>
         <a href="login.php" class="btn btn-outline-success mx-1">Login</a>
          <a href="signup.php" class="btn btn-outline-success mx-1">Signup</a>
        </form>';
          ?>
      <?php  
      }  
      ?>

    </div>
  </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
