<?php
// query
$tweetCategory=$_POST['category'];
$tweet_query = "SELECT `tweet_id`,`tweet`,`tweet_img`,`user_name`,`user_profile_name`,`user_dp` from bakbak_tweet bt INNER JOIN bakbak_user_data bud ON bt.user_id = bud.user_id AND bt.tweet_category='$tweetCategory' ORDER BY bt.tweet_id DESC ";
// database connectes
include '../backend/util.php';
$tweet_result = bakbak_dbConnect($tweet_query);


if ($tweet_result->num_rows > 0) {
    while ($single_tweet=mysqli_fetch_assoc($tweet_result)) {
?>

        <!-- post starts -->
        <div class="post">
            <div class="post__avatar">
                <img src="./images/<?=$single_tweet['user_dp']?>" alt="" />
            </div>

            <div class="post__body">
                <div class="post__header">
                    <div class="post__headerText">
                        <h3>
                            <?= $single_tweet['user_profile_name'] ?>
                            <span class="post__headerSpecial"><i class="fa post__badge fa-check" style="width: 2%;margin-left:0px;"></i>@<?=$single_tweet['user_name']?></span>
                        </h3>
                    </div>
                    <div class="post__headerDescription">
                        <p><?=$single_tweet['tweet']?></p>
                    </div>
                </div>
                <?php

                // image logic
                if(!$single_tweet['tweet_img']==""){
                    ?>
                    
                    <img src="./images/<?=$single_tweet['tweet_img']?>" alt="" />
                    
                    <?php
                }
                ?>
                <div class="post__footer">
                    <span class="material-icons"> repeat </span>
                    <span class="material-icons"> favorite_border </span>
                    <span class="material-icons"> publish </span>
                </div>
            </div>
        </div>
        <!-- post ends -->

<?php
    }
}
?>