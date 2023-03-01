<?php
session_start();
include '../util.php';
if($_POST['action']=="fetch_tweet"){
    $id = $_POST['id'];
    $edit_tweet_query = "SELECT * FROM bakbak_tweet WHERE tweet_id=$id and `user_id`=".$_SESSION['user_id'];
    $result=bakbak_dbConnect($edit_tweet_query);
    $row=mysqli_fetch_assoc($result);
    $arr=array(
        "tweet_id"=>$_POST['id'],
        "tweet"=>$row['tweet'],
        "tweet_img"=>$row['tweet_img'],
        "tweet_cat"=>$row['tweet_category']
    
    );
    print_r(json_encode($arr));
}
if($_POST['action']=="tweet_edit"){
    $id=$_POST['id'];
    $tweet=$_POST['tweet'];
    $tweet_category=$_POST['tweet_category'];
    $edit_tweet_query="UPDATE `bakbak_tweet` set `tweet`='$tweet', `tweet_category` = '$tweet_category' WHERE `tweet_id` ='$id' ";
    $result=bakbak_dbConnect($edit_tweet_query);
    echo $id;
}
?>