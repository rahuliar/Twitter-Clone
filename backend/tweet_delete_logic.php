<?php
include 'util.php';
$tweet_id=$_POST['tweet_id'];
//image select
$img_select_query="SELECT tweet_img from bakbak_tweet where tweet_id='$tweet_id'";
$img=bakbak_dbConnect($img_select_query);
if($img->num_rows>0){
    $img_path=mysqli_fetch_assoc($img);
    $actual_path=$img_path['tweet_img'];
    if($actual_path!=''){
        if(file_exists('../images/'.$actual_path)){
            unlink('../images/'.$actual_path);
        }
    }
}
//delete query
$tweet_delete_query="DELETE FROM bakbak_tweet WHERE tweet_id='$tweet_id'";
$result=bakbak_dbConnect($tweet_delete_query);
echo $result;
?>