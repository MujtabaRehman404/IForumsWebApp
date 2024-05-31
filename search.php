<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Search - iForums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <?php
    require 'components/navbar.php';
    require 'components/config.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $keyword = $_POST['search'];
        $keyword = str_replace("<","&lt;",$keyword);
        $keyword = str_replace(">","&gt;",$keyword);
        $search_title = mysqli_query($conn,"SELECT * FROM threads WHERE MATCH (thread_title) AGAINST ('$keyword' IN BOOLEAN MODE)");
        $search_desc = mysqli_query($conn,"SELECT * FROM threads WHERE MATCH (thread_desc) AGAINST ('$keyword' IN BOOLEAN MODE)");
        $wildcards = '%' . $keyword . '%';
        $search_comment = mysqli_query($conn,"SELECT * FROM comments WHERE `comment_content` LIKE '$wildcards'");
        $check_title = mysqli_num_rows($search_title);
        $check_desc = mysqli_num_rows($search_desc);
        $check_comment = mysqli_num_rows($search_comment);
       ?>

<div class="container mt-4">
<?php
$serial=0;
$count=0;

echo '<h1 style="text-align:center;" class="my-3">Search Results found for <i>"'.$keyword.'"</i> </h1>';

if($check_title>0){
    while($res = mysqli_fetch_assoc($search_title)){
        $thid = $res['thread_id'];
        $count=$count+1;
        $serial=$serial+1;
        echo '<a href="th.php?id='.$thid.'" target="_blank"><h4>'.$serial.". Thread:   ",$res['thread_title'], "<br>".'</h4></a>';        
}
}

if($check_desc!=0)
{while($res = mysqli_fetch_assoc($search_desc)){
        $thid = $res['thread_id'];
        $serial=$serial+1;
        $count=$count+1;
        echo '<a href="th.php?id='.$thid.'" target="_blank"><h4>'.$serial,". Thread: ",$res['thread_desc'], "<br>".'</h4></a>';      
}

    }
    
  if($check_comment!=0){
    while($result = mysqli_fetch_assoc($search_comment)){
      $thid = $result['comment_thread_id'];
      $serial=$serial+1;
      $count=$count+1;
      echo '<a href="th.php?id='.$thid.'" target="_blank"><h4>'.$serial,". Comment: ",$result['comment_content'], "<br>".'</h4></a>';      
    }
  }
    if($check_desc==0 && $check_title==0 && $check_comment==0)
    {
        echo '<p style="text-align:center;" class="my-3">'.$count.' Search Results found  which includes <i>"'.$keyword.'"</i> keyword </p>';
    }
    else
    {
        echo '<p style="text-align:center;" class="my-3">'.$count.' Search Results found  which includes <i>"'.$keyword.'"</i> keyword </p>';
    }
}
?>
</div>

            
   
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

  <?php require 'components/footer.php'; ?>  
</body>
</html>
