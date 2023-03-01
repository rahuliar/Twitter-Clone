<?php
session_start();
if($_POST['action']=='new_tweet'){
    $uid = $_SESSION['user_id'];
    $data=$_POST['tweet'];
    $category=$_POST['category'];
    $tweet_insert_query="INSERT INTO bakbak_tweet(`user_id`,`tweet`,`tweet_category`) VALUES('$uid','$data','$category')";
    include '../util.php';
    $connect = mysqli_connect("localhost", "root", "", "bakbak_db", "3306");
    $result = mysqli_query($connect, $tweet_insert_query);
    echo mysqli_insert_id($connect);
}
?>