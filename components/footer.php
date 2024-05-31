<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
    footer{
      position: absolute;
      height:auto;
      width:100%;
      margin:0;
      padding:0;
    }
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

  <footer class="text-center text-white bg-dark navbar-dark mt-4">
    <div class="container">
      <section class="mt-5">
        <div class="row text-center d-flex justify-content-center pt-3">
          <div class="col-md-3">
            <h6 class="text-uppercase font-weight-bold">
              <a href="home.php" class="text-white" style="text-transform:capitalize;text-decoration:none;font-size:17px;">Home</a>
            </h6>
          </div>
          <div class="col-md-3">
            <h6 class="text-uppercase font-weight-bold">
              <a href="about.php" class="text-white" style="text-transform:capitalize;text-decoration:none;font-size:17px;">About</a>
            </h6>
          </div>
          <?php
          if(!isset($_SESSION['loggedin'])){
              echo '<div class="col-md-3">
            <h6 class="text-uppercase font-weight-bold">
              <a href="login.php" class="text-white" style="text-transform:capitalize;text-decoration:none;font-size:17px;">Login</a>
            </h6>
          </div>
          <div class="col-md-3">
            <h6 class="text-uppercase font-weight-bold">
              <a href="signup.php" class="text-white" style="text-transform:capitalize;text-decoration:none;font-size:17px;">Signup</a>
            </h6>
          </div>';
          }
          ?>
          
        </div>
        
      </section>
      
      <hr>
      <section class="mt-0 mb-0">
        <div class="col-md-12">
          <p class="text-white">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur commodi, ipsum reprehenderit possimus dicta facere vero nulla ex, porro, saepe eligendi placeat veritatis! Excepturi maxime ipsum distinctio deserunt! Deleniti, dignissimos.
            Ipsa rerum veniam quas obcaecati error cupiditate aliquam sequi, facilis quisquam nesciunt molestiae expedita, recusandae consequuntur placeat commodi sint. Natus aut ex veritatis mollitia impedit doloribus reprehenderit cumque deserunt repellendus!
          </p>
        </div>
      </section>
    </div>
    <div class="text-center bg-dark">© <?php echo date('Y'); ?> Copyright:
      <a class="text-white" href="https://www.linkedin.com/in/mujtaba-rehman-852b34246/">Mujtaba Rehman Qureshi</a>
    </div>
  </footer>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
