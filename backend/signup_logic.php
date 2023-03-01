<?php

$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
$user_confirm_password = $_POST['user_confirm_password'];
$user_gender = $_POST['user_gender'];
//if any input field is empty
if (($user_name != '') && ($user_email != '') && ($user_password != '') && ($user_confirm_password != '') && ($user_gender != '')) {
    //chechking whether username is already aloted
    $check_username_email_query = "SELECT * FROM bakbak_user_data WHERE user_name='$user_name'";
    include 'util.php';
    $username_exist = bakbak_dbConnect($check_username_email_query);
    if ($username_exist->num_rows > 0) {
?>
        <div class="alert alert-danger" role="alert">
            username exist!
        </div>
        <?php
        exit();
    } else {
        // checking password and confirm password
        if ($user_password == $user_confirm_password) {
            //checking gender
            if ($user_gender == 'male' || $user_gender == 'Male') {
                $user_dp = 'male-avatar.jpg';
            } else if ($user_gender == 'female' || $user_gender == 'Female') {
                $user_dp = 'female-avatar.jpg';
            } else if (($user_gender != 'male') || ($user_gender != 'Male') || ($user_gender != 'Female') || ($user_gender != 'female')) {
        ?>
                <div class="alert alert-danger" role="alert">
                    Enter valid gender, either male or female!
                </div>
            <?php
                exit();
            }
            //checking email
            if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                // inserting user
                $new_user_query = "INSERT INTO bakbak_user_data(user_name,user_profile_name,user_email,user_pwd,gender,user_dp) VALUES('$user_name','$user_name','$user_email','$user_password','$user_gender','$user_dp')";
                $result = bakbak_dbConnect($new_user_query);
                echo $result;
            } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    invalid email!
                </div>
            <?php
                exit();
            }
        } else {
            ?>
            <div class="alert alert-danger" role="alert">
                password must be same as confirm password!
            </div>
    <?php
            exit();
        }
    }
} else {
    ?>
    <div class="alert alert-danger" role="alert">
        Fill every input field!
    </div>
<?php
    exit();
}
?>