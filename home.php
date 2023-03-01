<?php
include 'sidebar.php';
?>

<div class="feed border-right ">
    <div class="feed__header">
        <h2>Home</h2>
    </div>

    <!-- tweetbox starts -->
    <div class="tweetBox">
        <form>
            <div class="tweetbox__input">
                <img src="./images/<?= $_SESSION['user_dp'] ?>" alt="" />
                <input type="text" row="2" placeholder="What's happening?" id="input_tweet" required />
            </div>

            <!-- tweet image  -->
            <div class="post__body">
                <img src="" id="tweet_input_image" style="display:none;" alt="" />
            </div>
            <div class="row">
                <div class="col-md-2" style="margin-left: 5%; margin-top:5px">
                    <!-- categroy logic  -->
                    <select id="category" style="border: none; font-size: 15px; color:rgb(29, 155, 240)">
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
                    <input type="file" id="img" style="display:none;" />
                    <label for="img" style="cursor: pointer;"><i class="fa fa-image" style="font-size: 20px; color:rgb(29, 155, 240)"></i></label>
                </div>
                <input type="button" class="tweetBox__tweetButton col-md-8" id="tweet_insert" value="Tweet" style="float:right; margin-right:5%" />
            </div>
        </form>
    </div>
    <!-- tweetbox ends -->

    <!-- loading  -->
    <div class="col-md-4 col-md-offset-4" id="loading" style="display:none ;">
        <center>
            <h4>Loading.....</h4>
        </center>
    </div>
    <!-- loading  -->

    <!-- posts start  -->

    <div id="posts_result">

    </div>
    <!-- posts end -->

</div>

<?php
include 'widgets.php';
?>

<!-- script start  -->

<script src="../js/jquery.min.js"></script>
<script>
    //reload feed data 
    function tweet_posts() {
        $.ajax({
            url: "./frontend/home__feed/home__post.php",
            beforeSend: function() {
                $("#loading").css("display", "block");
            },
            success: function(response) {
                $("#posts_result").html(response);
            },
            complete: function() {
                $("#loading").css("display", "none");
            }
        });
    }

    // image insertion in folder
    function fileupload($id, $file) {
        let formData = new FormData();
        formData.append("action", "upload");
        formData.append("id", $id);
        formData.append("img", $file);
        $.ajax({
            url: "./backend/upload_img.php",
            method: "post",
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                if (response == 1) {
                    tweet_posts();
                    $("#input_tweet").val("");
                    $("#img").val("");
                    $("#tweet_input_image").css('display', 'none');
                }
            },
        });

    }
    //ajax
    $(document).ready(function() {
        tweet_posts();
        $("#tweet_insert").click(function() {
            var data = $("#input_tweet").val();
            var cat = $("#category").val();
            if (!data == "") {
                $.ajax({
                    method: "POST",
                    url: "./backend/home___logic/tweet__insert.php",
                    data: {
                        action: 'new_tweet',
                        "tweet": data,
                        "category": cat
                    },
                    success: function(response) {
                        if (response > 0) {
                            if (!$('#img').val() == '') {
                                fileupload(response, $('#img')[0].files[0])
                            } else {
                                tweet_posts();
                                $("#input_tweet").val("");
                            }
                        }
                    }
                });
            }
        });
        // tweet box image insertion
        $('#img').change(function(event) {
            $("#tweet_input_image").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });
    });
</script>
</body>

</html>
<!-- script end  -->