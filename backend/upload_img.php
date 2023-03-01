<?php
include 'util.php';
session_start();
// tweet photo post logic
if ($_POST['action'] == "upload") {
    $id = $_POST['id'];
    $filename = $_FILES['img']['name'];
    $ftype = $_FILES['img']['type'];
    $tmp_file = $_FILES['img']['tmp_name'];
    $randomstring = generateRandomString(15);
    $newfilename = $randomstring . $filename;
    if (($ftype == 'image/jpeg') || ($ftype == 'image/png')) {
        move_uploaded_file($tmp_file, "../images/".$newfilename);
        $insert_image_query = "update `bakbak_tweet` set `tweet_img` = '$newfilename' WHERE `tweet_id` ='$id' ";
        $result = bakbak_dbConnect($insert_image_query);
        echo $result;
    }
}
//profile photo change
if ($_POST['action'] == "profile-upload") {
    $id = $_POST['id'];
    $remove_file = "select `user_dp` from `bakbak_user_data` where `user_id` ='$id'";
    $remove_img = bakbak_dbConnect($remove_file);
    if ($remove_img->num_rows > 0) {
        $img_row = mysqli_fetch_assoc($remove_img);
        $actual_path = $img_row['user_dp'];
        if (($actual_path != 'male-avatar.jpg') && ($actual_path != 'female-avatar.jpg')) {
            unlink('../images/'.$actual_path);
        }
    }
    $filename = $_FILES['img']['name'];
    $ftype = $_FILES['img']['type'];
    $tmp_file = $_FILES['img']['tmp_name'];
    $randomstring = generateRandomString(15);
    $newfilename = $randomstring . $filename;
    if (($ftype == 'image/jpeg') || ($ftype == 'image/png')) {
        move_uploaded_file($tmp_file, "../images/".$newfilename);
        $insert_image_query = "UPDATE `bakbak_user_data` set `user_dp` = '$newfilename' WHERE `user_id` ='$id' ";
        $result = bakbak_dbConnect($insert_image_query);
        $_SESSION['user_dp'] = $newfilename;
        echo $result;
    }
}
// tweet image update
if ($_POST['action'] == "tweet-img-edit") {
    $id = $_POST['id'];
    echo $id;
    $remove_file = "select `tweet_img` from `bakbak_tweet` where `tweet_id` ='$id'";
    $remove_img = bakbak_dbConnect($remove_file);
    if ($remove_img->num_rows > 0) {
        $img_row = mysqli_fetch_assoc($remove_img);
        $actual_path = $img_row['tweet_img'];
        if($actual_path!=''){
            unlink('../images/'.$actual_path);
        }
    }
    $filename = $_FILES['img']['name'];
    $ftype = $_FILES['img']['type'];
    $tmp_file = $_FILES['img']['tmp_name'];
    $randomstring = generateRandomString(15);
    $newfilename = $randomstring . $filename;
    if (($ftype == 'image/jpeg') || ($ftype == 'image/png')) {
        move_uploaded_file($tmp_file, "../images/".$newfilename);
        $insert_image_query = "UPDATE `bakbak_tweet` set `tweet_img` = '$newfilename' WHERE `tweet_id` ='$id' ";
        $result = bakbak_dbConnect($insert_image_query);
        echo $result;
    }
}
// background photo logic 
if ($_POST['action'] == "background-upload") {
    $id = $_POST['id'];
    $backgound_actual_path=$_SESSION['user_background'];
    if ($backgound_actual_path !== 'car.jpg') {
        unlink('../images/'.$backgound_actual_path);
    }
    $filename = $_FILES['img']['name'];
    $ftype = $_FILES['img']['type'];
    $tmp_file = $_FILES['img']['tmp_name'];
    $randomstring = generateRandomString(15);
    $newfilename = $randomstring . $filename;
    if (($ftype == 'image/jpeg') || ($ftype == 'image/png')) {
        move_uploaded_file($tmp_file, "../images/".$newfilename);
        $insert_image_query = "UPDATE `bakbak_user_data` set `user_background` = '$newfilename' WHERE `user_id` ='$id' ";
        $result = bakbak_dbConnect($insert_image_query);
        $_SESSION['user_background'] = $newfilename;
        echo $result;
    }
}
