<?php
require 'components/navbar.php';
require 'components/config.php';

if(isset($_GET['loginstat'])){
  $user = $_SESSION['username'];
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong style="text-transform:capitalize;">'.$user.'</strong> Logged in Successfully!
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}


$log=false;
if(isset($_GET['loginstatus'])){
  $log=true;
}
if($log){
  $user = $_SESSION['username'];
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Login Successfull, Welcome <i>'.$user.'</i>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

$addcommentalert=false;
if(isset($_GET['addcom'])){
$addcommentalert=true;
}

if($addcommentalert){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Comment Added Successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}


$edited=false;
if(isset($_GET['edit'])){
 $edited=true;
}

if($edited){
 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
 <strong>Success!</strong> Comment Edited Successfully.
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
 
}

$delete=false;
if(isset($_GET['delete'])){
 $delete=true;
}

if($delete){
 echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
 <strong>Success!</strong> Comment Deleted Successfully.
 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';

}

if($_SERVER['REQUEST_METHOD']=='POST'){
  $content = $_POST['comment'];
  $content = str_replace("<","&lt;",$content);
  $content = str_replace(">","&gt;",$content);
  $thid = $_GET['id'];
  $comment_person = $_SESSION['sno'];
  $comment = "INSERT INTO `comments` (`comment_content`, `comment_person`, `comment_thread_id`, `dt`) VALUES ('$content', '$comment_person', '$thid', current_timestamp())";
  $comment_query = mysqli_query($conn,$comment);
  if($comment_query){
    header("location:th.php?id=$thid&addcom=true");
    die("location:th.php?id=$thid");
    exit(); 
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
  <link rel="icon" href="components/icon.png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">  
    <style>
      #comm{
        
      }
    </style>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Discussions - iForums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>  
  </head>
  <body><?php
    
    $id = $_GET['id'];
    $q = "SELECT * FROM `threads` WHERE `thread_id` = '$id'";
    $find = mysqli_query($conn,$q);
while($row = mysqli_fetch_assoc($find)){
  $threaduserid = $row['thread_user_id'];
  $testquery2 = mysqli_query($conn,"SELECT username FROM `userdata` WHERE `id` = '$threaduserid'");
  $test2 = mysqli_fetch_assoc($testquery2);
?>
    <div class="container my-4">
<div class="alert alert-secondary" role="alert">
  <h4 class="alert-heading"><?php echo $row['thread_title']; ?></h4>
  <p><?php echo $row['thread_desc']; ?></p>

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
  <?php
  $thid = $_GET['id']; 
  $test = mysqli_query($conn,"SELECT * FROM `threads` WHERE `thread_id` = '$thid'");
  while($res = mysqli_fetch_assoc($test)){
    $threaduserid2 = $res['thread_user_id'];
    $squery = mysqli_query($conn,"SELECT * FROM `userdata` WHERE `id` = '$threaduserid'");
    $qusername = mysqli_fetch_assoc($squery);
    $username = $qusername['username'];
    ?>
  <p><b>POSTED BY: <?php echo $username; ?></p></b>
  <p><b>DATE: <?php echo $res['dt'] ?></p></b>
  
  <?php
}
  
  ?>
  
</div>
</div>
<?php

if(isset($_SESSION['loggedin'])){
  ?>
   <div class="container my-3">
  <h3 class="my-1">
    Post a Comment as <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : '' ?> :
  </h3>
  <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <div class="form-group">
      <label for="comment"></label>
      <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-outline-success my-3">Submit</button>
  </form>
  </div>
<?php
}
else
{
 $_SESSION['thid'] = $thid; 
?>
  <div class="container">
  <div class="alert alert-warning" role="alert">
  <h4 class="alert-heading"><a href="login.php?redth=true">Login</a> first to post a Comment!</h4>
</div>

<?php
  }
  ?>

<div class="container">
<h2 class="my-3"  id="comm">Discussions</h2>
<?php
$thid = $_GET['id'];
$fc = "SELECT * FROM `comments` WHERE `comment_thread_id` = '$thid'";
$find_comments = mysqli_query($conn,$fc);
$checkcomments = mysqli_num_rows($find_comments);
if($checkcomments>0){
while($row = mysqli_fetch_assoc($find_comments)){
  $threaduserid = $row['comment_person'];
  $comment_id = $row['comment_id'];
  $testquery = mysqli_query($conn,"SELECT * FROM `userdata` WHERE `id` = '$threaduserid'");
  $fetchusername = mysqli_fetch_assoc($testquery);
  ?>
  <div class="media mt-4">
    <div class="dflex flex-column">
      <div class="dflex flex-row">
  <b class="p-2 justify-content-start"><p>Posted by: <?php echo $fetchusername['username']; ?> <?php echo $row['dt'] ?></p></b> <?php
  
if(isset($_SESSION['loggedin'])){
  if($_SESSION['username'] == $fetchusername['username']){
     echo '<div class="d-flex justify-content-end dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Actions
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="edit_th.php?id='.$thid.'&cmd='.$comment_id.'">Edit</a>
      <a class="dropdown-item" href="delete_th.php?id='.$thid.'&idc='.$comment_id.'">Delete</a>
      </div>
  </div>
  </div>';
  }
}
?>
  <img class="mr-3 p-2" style="width:70px;height:70px;" src="https://lippianfamilydentistry.net/wp-content/uploads/2015/11/user-default.png" alt="User img">
  <div class="media-body p-2">
   <?php echo $row['comment_content']; ?>
   <?php
   if(isset($_SESSION['loggedin'])){
    echo '<div style="margin-left:-8px;margin-top:10px" class="d-flex flex-row">';
    $q = "SELECT * FROM `comments` WHERE `comment_id` = '$comment_id' and `comment_thread_id` = '$thid'";
    $query = mysqli_query($conn,$q);
    $res = mysqli_fetch_assoc($query);
    $likes = $res['nooflikes'];
    $counter=0;
    $ransum=false;
    $userid = $_SESSION['sno'];
    if(isset($_GET['counter'])){
      $counter=1;
    }
    else if(isset($_GET['countertwo'])){
      $counter=0;
    }

    $qu = "SELECT * FROM `likes` WHERE `comm_id` = '$comment_id' AND `comm_th_id` = '$thid' AND `liked_by` = '$userid'";
    $randomquery = mysqli_query($conn,$qu);
    $ranres = mysqli_fetch_assoc($randomquery);
    $gg = mysqli_num_rows($randomquery);
    if($gg){ 
    $like_id = $ranres['like_id'];
    if($_SESSION['sno'] == $ranres['liked_by']){
      $ransum=true;
    }
  }
    if($counter==0){
      if($ransum){
        echo '<div class="p-2"><a style="text-decoration:none;color:blue" href="unlike.php?topicid='.$thid.'&commentid='.$comment_id.'&likeid='.$like_id.'#comm"><i class="fa fa-thumbs-up"></i> Liked </a>'.$likes.'</div>';         
      $ransum=false;
      }
      else
      {  
    echo '<div class="p-2"><a style="text-decoration:none;color:black" href="like.php?topicid='.$thid.'&commentid='.$comment_id.'&userid='.$userid.'#comm"><i class="fa fa-thumbs-up"></i> Like </a>'.$likes.'</div>';}
    $counter+=1;
  }
  else if($counter>0 && $ransum){
    echo '<div class="p-2"><a style="text-decoration:none;color:blue" href="unlike.php?topicid='.$thid.'&commentid='.$comment_id.'&likeid='.$like_id.'#comm"><i class="fa fa-thumbs-up"></i> Liked </a>'.$likes.'</div>';  
    $counter=0;
  }
    echo '<div class="p-2">Reply</div>';  
  }
  else
  {
    echo '<div style="margin-left:-8px;margin-top:10px" class="d-flex flex-row">';
    $q = "SELECT * FROM `comments` WHERE `comment_id` = '$comment_id' and `comment_thread_id` = '$thid'";
    $query = mysqli_query($conn,$q);
    $res = mysqli_fetch_assoc($query);
    $likes = $res['nooflikes']; 
    echo '<div class="p-2"><a style="text-decoration:none;color:black" href="login.php?topicid='.$thid.'"><i class="fa fa-thumbs-up"></i> Like </a>'.$likes.'</div> <div class="p-2">Reply</div>';    
  }
   ?>
  <!-- report feature <div class="p-2">Flex item 3</div>-->
</div>
    </div>
    </div>
</div>
<?php
}
}
else
{
  echo '<div class="alert alert-secondary my-3" role="alert">
  <h4 class="alert-heading">No Comments found!</h4>
  <p>Be the first one to post a Comment here!</p>';
}
?>
</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


  <?php include 'components/footer.php'; ?>  
</body>
</html>
