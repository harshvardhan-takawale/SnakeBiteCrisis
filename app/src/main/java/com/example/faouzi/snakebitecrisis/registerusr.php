<?php
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 $fb_id = $_POST['fb_id'];
 
 
 //This file contain server's username password and code to connect  to srver.
 
 //Here is a code in dbconnect.php
 /* 
 <?php
 define('HOST','localhost');
 define('USER','');
 define('PASS','');
 define('DB','');
 
 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
?>
*/
 require_once('dbconnect.php');

 //usrdata  is table where all users data is stored.

 $sql1 = "INSERT INTO usrdata (fb_id) VALUES ('$fb_id')";
 
 
 if(mysqli_query($con,$sql1)){
 echo "Successfully Registered";
 }else{
 echo "Could not register";
 
 }

 //createsepare table for user to store his data.
 $sql ="CREATE TABLE C".$fb_id."(
 id int(200) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  photos varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  caption varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  following int(200) NOT NULL,
  followers int(20) NOT NULL,
  profile_pic varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  status varchar(800) COLLATE utf8_unicode_ci NOT NULL
)" ;
 
 if(mysqli_query($con,$sql)){
 echo "Successfully created";
}
else{
 echo "Could not create";
 }



$sql12 ="CREATE TABLE C".$fb_id."home(
  `id` int(200) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  `frnd_id` int(200) NOT NULL,
  `pic_url` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `at` varchar(800) COLLATE utf8_unicode_ci NOT NULL
)" ;
 
 if(mysqli_query($con,$sql12)){
 echo "Successfully created";
}
else{
 echo "Could not create";
 }

 
 
  $sql2 ="CREATE TABLE C".$fb_id."photos(
  id int(200) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  resta varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  url varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  caption varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  date varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  day varchar(800) COLLATE utf8_unicode_ci NOT NULL
)" ;
 
 if(mysqli_query($con,$sql2)){
 echo "Successfully created";
}
else{
 echo "Could not create";
 }
 
 
  $sql3 ="CREATE TABLE C".$fb_id."profile(
  id int(200) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  profile_pic varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  usrname varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  status varchar(800) COLLATE utf8_unicode_ci NOT NULL
)" ;
 
 if(mysqli_query($con,$sql3)){
 echo "Successfully created";
}
else{
 echo "Could not create";
 }
 
 
 
   $sql4 ="CREATE TABLE C".$fb_id."visits(
  id int(200) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  resta varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  time varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  date varchar(800) COLLATE utf8_unicode_ci NOT NULL
) " ;
 
 if(mysqli_query($con,$sql4)){
 echo "Successfully created";
}
else{
 echo "Could not create";
 }
 
 
  $sql5 ="CREATE TABLE C".$fb_id."followed_resta(
  id int(200) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  resta_name varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  resta_id int(200) NOT NULL
) " ;
 
 if(mysqli_query($con,$sql5)){
 echo "Successfully created";
}
else{
 echo "Could not create";
 }
 
  $sql6 ="CREATE TABLE C".$fb_id."followers(
  id int(200) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  followers varchar(800) COLLATE utf8_unicode_ci NOT NULL
) " ;
 
 if(mysqli_query($con,$sql6)){
 echo "Successfully created";
}
else{
 echo "Could not create";
 }
 
  $sql7 ="CREATE TABLE C".$fb_id."followings(
  id int(200) NOT NULL UNIQUE KEY AUTO_INCREMENT,
  followings varchar(800) COLLATE utf8_unicode_ci NOT NULL
) " ;
 
 if(mysqli_query($con,$sql7)){
 echo "Successfully created";
}
else{
 echo "Could not create";
 }
 
 
 
 

 }else{
echo 'error';
}
?>