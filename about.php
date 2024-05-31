<!doctype html>
<html lang="en">
  <head>
    <style>
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aboutus - iForums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'components/navbar.php';
    require 'components/config.php';
    ?>

    <h1 class="my-3 text-center">Aboutus</h1>
    <div class="mt-2 d-flex flex-wrap justify-content-evenly">
      <div class="p-2">
      <img style="border-radius:200px;width:320px;height:320px" src="components/icon.png" alt="iForums" title="icon.png">
      </div>
      <div class="p-2">
      <img style="border-radius:200px;width:320px;height:320px" src="components/images/profile.jpg" alt="Mujtaba Rehman Qureshi" title="MRQ.png"></div>
</div>
    <div class="p-2 mt-5"><p class="text-center">
    IForums was developed by <a href="https://www.linkedin.com/in/mujtabarehman/" target="_blank">Mujtaba Rehman Qureshi</a> with a sole purpose of practicing backend programming fundamentals, the idea behind the project was to build a fully functional, scalable, cross platform compatible project which could be used by fellow programmers in order to discuss everyday/modern complex programming problems since we all get stuck into problems and these problems can sometimes become a potential loophole for the attackers or cause other relevant bugs if not given proper attention. One way to solve these problems without wasting any of your precious time is to discuss these problems within your friendly programming community and that is where a project like IForums could be utilized to ease your everyday life.
  </p>
  </div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <?php include 'components/footer.php'; ?>  
</body>
</html>
