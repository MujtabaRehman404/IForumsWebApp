<?php
    require 'components/config.php';
    $thid = $_GET['id'];
    $catid = $_GET['cat'];
    $delete_thread = "DELETE FROM `threads` WHERE `thread_id` = '$thid'";
    $query = mysqli_query($conn,"$delete_thread");
    if($query){
        header("location:threads.php?id=$catid&delete=true");
    }
    else
    {
        echo 'technical diffculty occured, try again later';
    }

?>