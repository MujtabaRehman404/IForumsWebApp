
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Comment - iForums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'components/config.php';
    require 'components/navbar.php';
    $id = $_GET['id'];
    $commentid = $_GET['cmd'];
    $query = mysqli_query($conn,"SELECT * FROM `comments` WHERE comment_thread_id = $id");
    $row = mysqli_fetch_assoc($query);
    ?>
    <h1 class="text-center mt-4">
        Edit Comment
    </h1>
    <div class="container mt-3">
    <form action="edit_th.php?id=<?php echo $id; ?>&cmd=<?php echo $commentid; ?>" method="post">
  <div class="mb-3">
    <label for="desc" class="form-label">Edit Comment</label>
    <input style="height:100px;" name="desc" type="desc" class="form-control" id="desc" value="<?php echo $row['comment_content'] ?>" required>
</div>
  <button type="submit" class="btn btn-primary">Edit</button>
  <a href="th.php?id=<?php echo $id; ?>" class="btn btn-danger">Go Back</a>
</form>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
  $upcomment = $_POST['desc'];
  $run = mysqli_query($conn,"UPDATE `comments` SET comment_content = '$upcomment' WHERE comment_id = $commentid");
if($run){
    header("location:th.php?id=$id&edit=true");
}
else
{
    echo 'problem occured, cant update try again later';
}
}

?>
