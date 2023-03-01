<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Twitter Clone - Final</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.css" type="text/css">
  <link rel="stylesheet" href="./css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="./css/style.css" type="text/css" />
</head>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location:../twitter");
}
?>

<body>
  <!-- sidebar starts -->
  <div class="sidebar">
    <i class="fa fa-twitter" style="font-size: 36px;"></i>

    <!-- side bar button logic  -->
    <?php
    include './backend/util.php';
    $sidebar_query = "SELECT * FROM bakbak_sidebar";
    $sidebar_result = bakbak_dbConnect($sidebar_query);
    if ($sidebar_result->num_rows > 0) {
      while ($sidebar_row = mysqli_fetch_assoc($sidebar_result)) {
    ?>
        <div class="sidebarOption row" data-id="<?= $sidebar_row['sidebaroption_id'] ?>">
          <i class="fa fa-<?= $sidebar_row['sidebaroption_icons'] ?> col-2"></i>
          <span class="col-10"><?= $sidebar_row['sidebar_option'] ?></span>
        </div>
    <?php
      }
    }
    ?>
    <!-- side bar button logic end   -->

    <div id="logout_button" class=" tweetbox__input sidebarOption row" style="margin-top:10px; padding-top: 10px; padding-bottom: 10px;" id="<?= $sidebar_row['sidebaroption_id'] ?>">
      <img class="col-2" src="./images/<?= $_SESSION['user_dp'] ?>" style="margin-right: 10px;"></img>
      <span class="col-10">Logout</span>
    </div>
  </div>
  <!-- sidebar ends -->

  <!-- script start  -->
  <script src="./js/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#logout_button").click(function() {
        $.ajax({
          url: "logout_logic",
          success: function(response) {
            if (response == 1) {
              window.location = "../twitter";
            }
          }
        });
      });

      $(".sidebarOption").click(function() {
        $id = $(this).attr("data-id");
        var path;
        switch ($id) {
          case '11111':
            path = "home";
            break;
          case '11112':
            path = "explore";
            break;
          case '11113':
            path = "messages";
            break;
          case '11114':
            path = "profile";
            break;

          default:
            path = "home";
            break;
        }
        window.location = path;
      });
    });
  </script>
  <!-- script end  -->
  <!-- </body>

</html> -->