<?php
require 'components/config.php';
$commentid = $_GET['commentid'];
$topicid = $_GET['topicid'];
$userid = $_GET['userid'];
$likeid = $_GET['likeid'];
$q = "SELECT * FROM `comments` WHERE `comment_id` = '$commentid' and `comment_thread_id` = '$topicid'";
$q1 = mysqli_query($conn,$q);
$res = mysqli_fetch_assoc($q1);
$uplikes = $res['nooflikes'];
$uplikes = $uplikes - 1;
$q = "UPDATE `comments` SET `nooflikes` = '$uplikes' WHERE `comments`.`comment_id` = $commentid";
$query = mysqli_query($conn,$q);
$q3 = "DELETE FROM `likes` WHERE `like_id` = '$likeid'";
$addlikes = mysqli_query($conn,$q3);
if($query && $addlikes){
    header("location:th.php?id=$topicid&countertwo=1");
    die("location:th.php?id=$topicid");
    exit();
}
?>
