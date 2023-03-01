<?php
include 'sidebar.php';
?>
<div class="feed border-right">
    <div class="feed__header">
        <h2>Explore</h2>
    </div>
    <!-- category field  -->
    <div class="category-field">
        <div class="category_section row">
            <?php
            $category_select_query = "SELECT * FROM `bakbak_category`";
            $result = bakbak_dbConnect($category_select_query);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <center class="col-md-3 category-div">
                        <h4 class="category <?= $row['category_id'] ?>" style="cursor: pointer;" data-key=<?= $row['category_id'] ?>><?= $row['category_name'] ?></h4>
                    </center>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- category field  -->

    
    <!-- loading  -->
    <div class="col-md-4 col-md-offset-4" id="loading" style="display:none ;">
        <center>
            <h4>Loading.....</h4>
        </center>
    </div>
    <!-- loading  -->

    <!-- category result  -->
    <div id="category_result">

    </div>
    <!-- category result  -->
</div>
<?php
include 'widgets.php';
?>

<!-- script  -->

<script src="./js/jquery.min.js"></script>
<script>
    function category_result_show(category_value) {
        $.ajax({
            type: "POST",
            url: "./frontend/posts.php",
            data: {
                category: category_value
            },
            beforeSend: function() {
                $("#loading").css("display", "block");
            },
            success: function(response) {
                $("#category_result").html(response);
            },
            complete: function() {
                $("#loading").css("display", "none");
            }
        });
    }
    $(document).ready(function() {
        if ($(".category").attr("data-key") == '1001') {
            $(".1001").parent().addClass("border-bottom");
            category_result_show($(".1001").attr("data-key"))
        };
        $('.category').click(function() {
            for (let index = 1001; index < 1005; index++) {
                $("." + index).parent().removeClass("border-bottom");
                console.log
            }
            $(this).parent().addClass("border-bottom");
            category_result_show($(this).attr("data-key"))

        });
    });
</script>
<!-- script  -->