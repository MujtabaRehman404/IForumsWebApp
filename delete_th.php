<?php
require 'components/config.php';
$thid = $_GET['id'];
$idc = $_GET['idc'];
$delete_th = "DELETE FROM comments WHERE comment_id = '$idc'";
$query = mysqli_query($conn,$delete_th);
if($query){
       header("location:th.php?id=$thid&delete=true");
}
    else
    {
        echo 'technical diffculty occured, try again later';
    }

?>