<?php
session_start();
include "../../backend/util.php";
// query
$user_id = $_SESSION['user_id'];
$tweet_query = "SELECT `tweet_id`,`tweet`,`tweet_img`,`user_name`,`user_profile_name`,`user_dp` from bakbak_tweet bt INNER JOIN bakbak_user_data bud ON bt.user_id = bud.user_id AND bud.user_id=$user_id ORDER BY bt.tweet_id DESC ";
// database connectes
$tweet_result = bakbak_dbConnect($tweet_query);


if ($tweet_result->num_rows > 0) {
    while ($single_tweet = mysqli_fetch_assoc($tweet_result)) {
?>

        <!-- post starts -->
        <div class="post">
            <div class="post__avatar">
                <img src="./images/<?= $single_tweet['user_dp'] ?>" alt="" />
            </div>

            <div class="post__body" id="<?= $single_tweet['tweet_id'] ?>">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            <?= $single_tweet['user_profile_name'] ?>
                            <span class="post__headerSpecial"><i class="fa post__badge fa-check" style="width: 2%;margin-left:0px;"></i>@<?= $single_tweet['user_name'] ?></span>
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p><?= $single_tweet['tweet'] ?></p>
                    </div>
                </div>
                <?php

                // image logic
                if (!$single_tweet['tweet_img'] == "") {
                ?>

                    <img src="./images/<?= $single_tweet['tweet_img'] ?>" alt="" />

                <?php
                }
                ?>
                <div class="post__footer">
                    <a class="fa fa-edit" onclick="toggle2()" data-key="<?= $single_tweet['tweet_id'] ?>" style="color:black;font-size: 24px; cursor:pointer"></a>
                    <i class="fa fa-trash tweet-<?= $single_tweet['tweet_id'] ?>" onclick="delete_tweet(<?= $single_tweet['tweet_id'] ?>)" style="font-size: 24px; cursor:pointer"></i>
                </div>
            </div>
            <center id="delete_<?= $single_tweet['tweet_id'] ?>" style="display:none;">
                <h3 style="margin-bottom: 15px;">Do you want to delete this tweet ?</h3>
                <div class="row">
                    <center class="col-md-6">
                        <button class=" btn btn-success tweet-delete-yes" data-key="<?= $single_tweet['tweet_id'] ?>">YES</button>
                    </center>
                    <center class="col-md-6">
                        <button class=" btn btn-danger" onclick="undo_delete_tweet(<?= $single_tweet['tweet_id'] ?>)">NO</button>
                    </center>
                </div>
            </center>
        </div>
        <script src="../../js/jquery.min.js"></script>
        <script>
            // delete logic
        $('.tweet-delete-yes').click(function() {
            $tweet_data_key = $(this).attr("data-key");
            $.ajax({
                type: "POST",
                url: "./backend/tweet_delete_logic.php",
                data: {
                    tweet_id: $tweet_data_key
                },
                success: function(response) {
                    if (response == 1) {
                        $(".tweet-" + $tweet_data_key).parent().parent().parent().remove();
                    }
                }
            });

        });

         // set temp path of edit image
         $('#edit_img').change(function(event) {
            $("#tweet_edit_image").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });

        //edit tweet value fetch logic
        $('.fa-edit').click(function() {
            $.ajax({
                type: "method",
                method: "POST",
                url: "./backend/edit__section/tweet__edit.php",
                data: {
                    "action": "fetch_tweet",
                    "id": $(this).attr('data-key')
                },
                success: function(response) {
                    $data = $.parseJSON(response);
                    $("#edit_tweet").val($data.tweet);
                    $("#tweet_id").val($data.tweet_id);
                    if ($data.tweet_img != '') {
                        $("#tweet_edit_image").attr('src', `./images/` + $data.tweet_img);
                        $("#tweet_edit_image").css('display', 'block');
                    }
                    for (let index = 1001; index < 1005; index++) {
                        $(`#edit_category option[value=` + index + `]`).attr('selected', false);
                    }
                    $(`#edit_category option[value=` + $data.tweet_cat + `]`).attr('selected', true);
                }
            });
        });

        //tweet edit logic
        $("#tweet_edit_button").click(function() {
            if ($("#edit_tweet").val() != '') {
                $.ajax({
                    type: "method",
                    method: "POST",
                    url: "./backend/edit__section/tweet__edit.php",
                    data: {
                        action: "tweet_edit",
                        id: $("#tweet_id").val(),
                        tweet: $("#edit_tweet").val(),
                        tweet_category: $("#edit_category").val(),
                    },
                    success: function(response) {
                        if (response > 0) {
                            if ($("#edit_img").val() !== '') {
                                fileupload(response, $('#edit_img')[0].files[0], 3)
                            }
                            $(document).ajaxStop(function() {
                                window.location.reload();
                            });
                        }
                    }
                });
            } else {
                alert("you cant tweet empty input!")
            }
        });
        </script>
        <!-- post ends -->
     
<?php
    }
}
?>