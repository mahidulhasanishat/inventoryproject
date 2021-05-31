<?php
session_start();
include ('navigation.php');

$m='';
$conn=connection();

$id= $_SESSION['userid'];
$sq= "SELECT * FROM user_info WHERE id='$id'";
$thisUser= mysqli_fetch_assoc($conn->query($sq));
if($thisUser['is_aamin']!=1){
    header("location:dashboard.php");
}
?>