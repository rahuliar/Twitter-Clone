<?php
function bakbak_dbConnect($query)
{
    $connect = mysqli_connect("localhost", "root", "", "bakbak_db", "3306");
    $result = mysqli_query($connect, $query);
    return $result;
}
function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}