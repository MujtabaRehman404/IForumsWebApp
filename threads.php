
<?php
    require 'components/navbar.php';
    require 'components/config.php';

  $loginalert=false;
  if(isset($_GET['loginstatus'])){
    $loginalert=true;
  }
  
  if(isset($_GET['loginstat'])){
    $user = $_SESSION['username'];
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong style="text-transform:capitalize;">'.$user.'</strong> Logged in Successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

  if($loginalert){
    $user = $_SESSION['username'];
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong style="text-transform:capitalize;">'.$user.'</strong> Loggedin Successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  $log=false;
  if(isset($_GET['qadd'])){
    $log=true;
  }
  if($log){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Question Added Successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
 }

 $edited=false;
 if(isset($_GET['edit'])){
  $edited=true;
 }

 if($edited){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Question Edited Successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  
 }

 $delete=false;
 if(isset($_GET['delete'])){
  $delete=true;
 }

 if($delete){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Question Deleted Successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
 
 }

if($_SERVER['REQUEST_METHOD']=='POST'){
  $title = $_POST['title'];
  $title = str_replace("<","&lt;",$title);
  $title = str_replace(">","&gt;",$title);
  $details = $_POST['details'];
  $details = str_replace("<","&lt;",$details);
  $details = str_replace(">","&gt;",$details);

  $id = $_GET['id'];
  $userid = $_SESSION['sno'];
  $q3 = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `dt`) VALUES ('$title', '$details', '$id', '$userid', current_timestamp())";
  $query3 = mysqli_query($conn,$q3);

  $success=false;

  if($query3){
    $success=true;
  }

  if($success){
    header("location:threads.php?id=$id&qadd=true");
    die("location:threads.php?id=$id");
    exit();
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Threads - iForums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    $id = $_GET['id'];
    $q = "SELECT * FROM `categories` WHERE `cat_id` = '$id'";
    $find = mysqli_query($conn,$q);
while($row = mysqli_fetch_assoc($find)){
?>
    <div class="container my-4">
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Welcome to <?php echo $row['title']; ?> forums <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>!</h4>
  <p><?php echo $row['description']; ?></p>

<?php
}
  ?> 
  
  <hr>
  <p class="mb-0">
    <ol>
        <li>Be Respectful: Treat others with respect and courtesy. Do not use offensive language, engage in personal attacks, or harass other users.</li>
        <li>No Hate Speech or Discrimination: Do not post content that promotes hate speech, discrimination, racism, sexism, or any form of intolerance.</li>
        <li>Stay on Topic: Keep discussions relevant to the forum's theme or category. Avoid derailing threads with unrelated topics.</li>
        <li>No Spam or Advertising: Do not spam the forum with irrelevant or promotional content. Advertising or self-promotion should be limited</li>
        <li>No Trolling: Do not intentionally provoke or disrupt discussions for the purpose of causing trouble or annoyance.</li>  
    </ol>
  </p>
</div>
</div>
<?php

 if(isset($_SESSION['loggedin'])){
  ?>
 <div class="container">
  <h3 class="mt-3">Submit a question as <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?> : </h3>
  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" aria-describedby="emailHelp" id="title" name="title" required>    
  <div class="form-group">
    <label for="details">Details</label>
    <textarea class="form-control" id="details" name="details" rows="3" required></textarea>
  <!--<input type="hidden" name="sno" value="<?php echo $_SESSION['sno']; ?>">-->
  </div>
  <button type="submit" class="btn btn-outline-success my-2">Submit</button>
</form>
</div>
<?php
}
else
{ 
  $_SESSION['threads'] = $id;
  echo '
  <div class="container">
  <div class="alert alert-warning" role="alert">
  <h4 class="alert-heading"><a href="login.php?redthread=true">Login</a> first to post a question!</h4>
</div>
</div>';
}
?>

<div class="container mt-4">
<h3>Browse Questions</h3>
<?php
$exists = false;
//$q2 = mysqli_query($conn,"INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `dt`) VALUES ('can\'t insert any query through php in mysql', 'can\'t insert any query through php in mysql \r\ncan\'t insert any query through php in mysql\r\ncan\'t insert any query through php in mysql\r\ncan\'t insert any query through php in mysql', '3', '1', current_timestamp())");
$q1 = mysqli_query($conn,"SELECT * FROM `threads` WHERE `thread_cat_id` = '$id'");
while($res = mysqli_fetch_assoc($q1)){
  $exists = true;
  $id2 = $res['thread_id'];
  $threaduserid = $res['thread_user_id'];
  $testquery = mysqli_query($conn,"SELECT * FROM `userdata` WHERE `id` = '$threaduserid'");
  $test = mysqli_fetch_assoc($testquery);
   
?>
<div class="media my-4">
<b><p>Posted by: <?php echo $test['username']; ?></p></b>
<b><p>date: <?php echo $res['dt']; ?></p></b>
  <img class="mr-3" width="30" height="30" src="https://p.kindpng.com/picc/s/451-4517876_default-profile-hd-png-download.png" alt="Generic placeholder image">
  <div class="media-body">
    <h5 class="mt-0"><a href="th.php?id=<?php echo $id2; ?>"><?php echo $res['thread_title']; ?></h5></a>
    <?php 
    echo $res['thread_desc'];
    ?></div>
</div>
<?php
if(isset($_SESSION['loggedin'])){
  if($test['username'] == $_SESSION['username']){
    echo '<a href="edit_thread.php?id='.$id2.'&cat='.$id.'" class="btn btn-outline-success pr-2">Edit</a> <a href="delete_thread.php?id='.$id2.'&cat='.$id.'" class="btn btn-outline-success pr-2">Delete</a>';
}
}
}

if(!$exists){
  echo '<div class="alert alert-secondary my-3" role="alert">
  <h4 class="alert-heading">No Questions found</h4>
  <p>Be the first one to post a question here!</p>';
}


?>

</div>
</div>
</div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <?php include 'components/footer.php'; ?>  
</body>
</html>