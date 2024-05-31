
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Thread - iForums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'components/config.php';
    require 'components/navbar.php';
    $idcat = $_GET['cat'];
    $id = $_GET['id'];
    $query = mysqli_query($conn,"SELECT * FROM `threads` WHERE `thread_id` = '$id'");
    $row = mysqli_fetch_assoc($query);
    ?>

    <h1 class="text-center mt-4">
        Edit Thread
    </h1>

    <div class="container mt-3">
    <form action="edit_thread.php?id=<?php echo $id ;?>&cat=<?php echo $idcat ?>" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Edit Title</label>
    <input type="title" name="title" class="form-control" id="title" value="<?php echo $row['thread_title'] ?>" required>
    </div>
  <div class="mb-3">
    <label for="desc" class="form-label">Edit Description</label>
    <input style="height:100px;" name="desc" type="desc" class="form-control" id="desc" value="<?php echo $row['thread_desc'] ?>" required>
</div>
  <button type="submit" class="btn btn-primary">Edit</button>
  <a href="threads.php?id=<?php echo $idcat; ?>" class="btn btn-danger">Go Back</a>
</form>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
    $edited_title = $_POST['title'];
    $edited_desc = $_POST['desc'];

$update_query = "UPDATE `threads` SET thread_title = '$edited_title' , thread_desc = '$edited_desc' WHERE thread_id = $id";
$run = mysqli_query($conn,$update_query);

if($run){
    header("location:threads.php?id=$idcat&edit=true");
}
else
{
    echo 'problem occured, cant update try again later';
}
}

?>
