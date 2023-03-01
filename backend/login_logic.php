<?php
$user_name=$_POST['user_name'];
$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];

// user checking query
$user_check_query="SELECT * FROM `bakbak_user_data` WHERE `user_name`='$user_name' AND `user_email`='$user_email' AND `user_pwd`='$user_password'";
include 'util.php';

$result=bakbak_dbConnect($user_check_query);
if($result->num_rows>0){
    $user_data=mysqli_fetch_assoc($result);
    // starting session
        session_start();
        $_SESSION['user_id']=$user_data['user_id'];
        $_SESSION['user_name']=$user_name;
        $_SESSION['user_profile_name']=$user_data['user_profile_name'];
        $_SESSION['user_dp']=$user_data['user_dp'];
        $_SESSION['user_background']=$user_data['user_background'];
        echo "1";
    }
else{?>
<div class="alert alert-danger" role="alert">
  invalid user id or email or password!
</div>
   <?php
}


?>