<?php
include 'sidebar.php';
?>
<div class="feed border-right" id="blur">
    <div class="feed__header">
        <h2>
            <?= $_SESSION['user_name'] ?>
        </h2>
    </div>

    <!-- background image  -->
    <img src="./images/<?= $_SESSION['user_background'] ?>" alt="" class="user-profile-background-image">
    <!-- background image  -->

    <!-- profile section  -->
    <div class="row">
        <div class="col-md-9">
            <div class="user-profile-m-25">
                <!-- display picture  -->
                <img src="./images/<?= $_SESSION['user_dp'] ?>" id="user-profile-dp" alt="" class="user-profile-dp">
                <!-- display picture  -->
            </div>
        </div>
        <div class="col-md-3" style="float: right;">
            <input type="button" value="Edit" onclick="toggle1()" class="tweetBox__tweetButton">
        </div>
    </div>
    <div>
        <h3 class="user-profile-m-25 user-profile-name" id="profile_user_profile_name"><?= $_SESSION['user_profile_name'] ?></h3>
        <span class="user-profile-m-25" id="profile_username">@<?= $_SESSION['user_name'] ?></span>
    </div>
    <!-- profile section  -->

    <!-- activity navigation section  -->
    <div class="top-border-user-profile">
        <div class="category-field">
            <div class="category_section row">
                <center class="col-md-4 category-div">
                    <h4 class="user_activity 10101" data-key="user_tweets" style="cursor: pointer;">Tweets</h4>
                </center>
                <center class="col-md-4 category-div">
                    <h4 class="user_activity 10102" data-key="user_retweets" style="cursor: pointer;">Retweets</h4>
                </center>
                <center class="col-md-4 category-div">
                    <h4 class="user_activity 10103" data-key="user_quoted_tweets" style="cursor: pointer;">Quoted Tweets</h4>
                </center>
            </div>
        </div>
        <!-- activity navigation section  -->


        <!-- loading  -->
        <div class="col-md-4 col-md-offset-4" id="loading" style="display:none ;">
            <center>
                <h4>Loading.....</h4>
            </center>
        </div>
        <!-- loading  -->
        <!-- activity -->
        <div id="user-profile-activity-feeds">
        </div>
        <!-- activity -->
    </div>
</div>
<!-- activity section  -->

<!---------------------------------- Edit profile popup window ---------------------------------->
<div id="popup1" class="col-11 col-md-8 col-lg-5 p-2">
    <!---------------------- form  ---------------------->
    <div class="close-btn" onclick="toggle1()">&times;</div>
    <!-- profile edit section  -->
    <!-- background image  -->
    <input type="file" id="edit-user-background-img" style="display:none;" />
    <label for="edit-user-background-img" style="cursor: pointer; width:100%">
        <img id="ubg" src="./images/<?= $_SESSION['user_background'] ?>" alt="" class="user-profile-background-image" style="height:260px !important">
    </label>
    <!-- background image  -->
    <div class="row">
        <div class="col-md-9">
            <div class="user-profile-m-25">
                <!-- display picture  -->
                <input type="file" id="edit-user-profile-img" style="display:none;" />
                <label for="edit-user-profile-img" style="cursor: pointer; width:100%">
                    <img id="upg" src="./images/<?= $_SESSION['user_dp'] ?>" alt="" class="user-profile-dp">
                </label>
                <!-- display picture  -->
            </div>
        </div>
        <div class="col-md-3" style="float: right;">
            <input type="button" value="Save" id="edit" class="tweetBox__tweetButton">
        </div>
    </div>
    <div style="padding:10px ;">
        <input type="text" id="edit-user-profile-name" value="<?= $_SESSION['user_profile_name'] ?>" class="form-control" style="margin-bottom:10px;">
        <input type="text" id="edit-user-name" value="<?= $_SESSION['user_name'] ?>" class="form-control" style="margin-bottom:10px; margin-top:10px;">
    </div>
    <div style="padding: 5px;">
        <div class="alert alert-success" role="alert" style="display: none;">
            Username Available!
        </div>
        <div class="alert alert-danger" role="alert" style="display: none;">
            Username Already Exist!
        </div>
    </div>
    <!-- profile edit section  -->
</div>

<!---------------------------------- Edit tweet popup window ---------------------------------->
<div id="popup2" class="col-11 col-md-8 col-lg-5 p-2">
    <!---------------------- form  ---------------------->
    <div class="close-btn" onclick="toggle2()">&times;</div>
    <div class="tweetBox" style="border-bottom: none;">
        <form>
            <div class="tweetbox__input">
                <img src="./images/<?= $_SESSION['user_dp'] ?>" alt="" />
                <input type="hidden" id="tweet_id">
                <input type="text" row="2" placeholder="What's happening?" id="edit_tweet" required autofocus />
            </div>

            <!-- tweet image  -->
            <div class="post__body">
                <img src="" id="tweet_edit_image" style="display:none; max-height:465px;" alt="" />
            </div>
            <div class="row">
                <div class="col-md-2" style="margin-left: 5%; margin-top:5px">
                    <!-- categroy logic  -->
                    <select id="edit_category" style="border: none; font-size: 15px; color:rgb(29, 155, 240)">
                        <?php
                        $category_select_query = "SELECT * FROM bakbak_category";
                        $result = bakbak_dbConnect($category_select_query);
                        if ($result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <!-- categroy logic  -->
                </div>
                <div class="col-md-2" style="margin-top: 5px;">
                    <input type="file" id="edit_img" style="display:none;" />
                    <label for="edit_img" style="cursor: pointer;"><i class="fa fa-image" style="font-size: 20px; color:rgb(29, 155, 240)"></i></label>
                </div>
                <input type="button" class="tweetBox__tweetButton col-md-8" id="tweet_edit_button" value="Tweet" style="float:right; margin-right:5%" />
            </div>
        </form>
    </div>
</div>

<?php
include 'widgets.php';
?>
<!-- script  -->
<script src="./js/jquery.min.js"></script>
<script>
    // open profile edit page
    function toggle1() {
        let blur = document.getElementById('blur');
        blur.classList.toggle('active');
        let popup = document.getElementById('popup1');
        popup.classList.toggle('active');
    }
    //open tweet edit page
    function toggle2() {
        let blur = document.getElementById('blur');
        blur.classList.toggle('active');
        let popup = document.getElementById('popup2');
        popup.classList.toggle('active');
    }

    function delete_tweet(e) {
        const item = document.getElementById(e);
        const item2 = document.getElementById('delete_' + e);
        item.style.display = 'none';
        item2.style.display = 'block';
    }

    function undo_delete_tweet(e) {
        const item2 = document.getElementById(e);
        const item = document.getElementById('delete_' + e);
        item.style.display = 'none';
        item2.style.display = 'block';
    }

    //image update 
    function fileupload($id, $file, x) {
        let formData = new FormData();
        if (x == 1) {
            formData.append("action", "profile-upload");
        } else if (x == 2) {
            formData.append("action", "background-upload");
        } else if (x == 3) {
            formData.append("action", "tweet-img-edit");
        }
        formData.append("id", $id);
        formData.append("img", $file);
        $.ajax({
            url: "./backend/upload_img.php",
            method: "post",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                return response;
            },
        });

    }

    function toggling() {
        $("#profile_user_profile_name").html($('#edit-user-profile-name').val());
        $("#profile_username").html($('#edit-user-name').val());
        $('#edit-user-profile-img').val("");
        toggle1();
        $(document).ajaxStop(function() {
            window.location.reload();
        });
    }


    $(document).ready(function() {
        //username exist logic
        $('#edit-user-name').keyup(function() {
            $.ajax({
                type: "method",
                method: "POST",
                url: "./backend/edit__section/profile__edit.php",
                data: {
                    "user_name": $('#edit-user-name').val(),
                    "action": "check-user"
                },
                success: function(response) {
                    if (response == 1) {
                        $(".alert-danger").html("Username Already Exist!");
                        $(".alert-danger").css("display", "block");
                        $(".alert-success").css("display", "none");
                    } else if (response == 2) {
                        $(".alert-danger").html("Username is Necessary");
                        $(".alert-danger").css("display", "block");
                        $(".alert-success").css("display", "none");
                    } else {
                        $(".alert-success").css("display", "block");
                        $(".alert-danger").css("display", "none");
                    }
                }
            });
        });
        // edit profile logic 
        $('#edit').click(function() {
            $.ajax({
                type: "method",
                method: "POST",
                url: "./backend/edit__section/profile__edit.php",
                data: {
                    "user_name": $('#edit-user-name').val(),
                    "user_profile_name": $('#edit-user-profile-name').val(),
                    "action": "edit"
                },
                success: function(response) {
                    if (response != "false") {
                        // alert(response)
                        if (($('#edit-user-profile-img').val() == '') && ($('#edit-user-background-img').val() == '')) {
                            toggling()
                        } else if ((!$('#edit-user-profile-img').val() == '') && (!$('#edit-user-background-img').val() == '')) {
                            fileupload(response, $('#edit-user-profile-img')[0].files[0], 1)
                            fileupload(response, $('#edit-user-background-img')[0].files[0], 2)
                            toggling();
                        } else if ((!$('#edit-user-profile-img').val() == '') && ($('#edit-user-background-img').val() == '')) {
                            fileupload(response, $('#edit-user-profile-img')[0].files[0], 1)
                            toggling();
                        } else if (($('#edit-user-profile-img').val() == '') && (!$('#edit-user-background-img').val() == '')) {
                            fileupload(response, $('#edit-user-background-img')[0].files[0], 2)
                            toggling();
                        }
                    } else if (response == "false") {
                        alert("please put a valid username")
                    }
                }
            });
        });
        // set profile image from temp path
        $('#edit-user-profile-img').change(function(event) {
            $("#upg").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });
        // set background image from temp path
        $('#edit-user-background-img').change(function(event) {
            $("#ubg").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });
    //    profile feed logic 
        function category_result_show(category_value) {
            $.ajax({
                type: "POST",
                url: "./frontend/profile__feed/self_and_retweets.php",
                data: {
                    category: category_value
                },
                beforeSend: function() {
                    $("#loading").css("display", "block");
                },
                success: function(response) {
                    $("#user-profile-activity-feeds").html(response);
                },
                complete: function() {
                    $("#loading").css("display", "none");
                }
            });
        }
        // profile navugation logic 
        if ($(".user_activity").attr("data-key") == 'user_tweets') {
            $(".10101").parent().addClass("border-bottom");
            category_result_show($(".10101").attr("data-key"))
        };
        $('.user_activity').click(function() {
            for (let index = 10101; index < 10104; index++) {
                $("." + index).parent().removeClass("border-bottom");
            }
            $(this).parent().addClass("border-bottom");
            category_result_show($(this).attr("data-key"))

        });

    });
</script>
<!-- script  -->