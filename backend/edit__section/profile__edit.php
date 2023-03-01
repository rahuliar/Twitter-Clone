<?php
session_start();
if ($_POST['action'] == "check-user") {
    $user_name = $_POST['user_name'];
    $user_exist_query = "SELECT * FROM bakbak_user_data WHERE user_name='$user_name'";
    include '../util.php';
    $username_exist = bakbak_dbConnect($user_exist_query);
    if (($username_exist->num_rows > 0) && ($user_name != $_SESSION['user_name'])) {
        echo "1";
    }else if($user_name===''){
        echo "2";
    }
};
if ($_POST['action'] == "edit") {
    $id = $_SESSION['user_id'];
    $user_name = $_POST['user_name'];
    $user_profile_name = $_POST['user_profile_name'];
    $user_exist_query = "SELECT * FROM bakbak_user_data WHERE user_name='$user_name'";
    include '../util.php';
    $username_exist = bakbak_dbConnect($user_exist_query);
    // echo $username_exist->num_rows;
    // exit();
    if ((($username_exist->num_rows === 0) && ($user_name!=''))||($user_name === $_SESSION['user_name'])) {
        $user_update_query = "UPDATE `bakbak_user_data` set `user_name`='$user_name', `user_profile_name` = '$user_profile_name' WHERE `user_id` ='$id' ";
        $result = bakbak_dbConnect($user_update_query);
        $_SESSION['user_profile_name']=$user_profile_name;
        $_SESSION['user_name']=$user_name;
        echo $id;
    }else{
        echo "false";
    }
    
};
