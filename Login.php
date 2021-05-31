<?php
include "auth/connection.php";
session_start();
$_SESSION['user']='';
$_SESSION['userid']='';
$conn=connection();
$m='';
if (isset($_POST['submit'])){
    $uname=$_POST['uname'];
    $pass=$_POST['pass'];
    $sq="SELECT * FROM user_info WHERE U_name='$uname' and password='$pass'";
    $res=$conn->query($sq);


    if (mysqli_num_rows($res)===1){
       $user=mysqli_fetch_assoc($res);
//       here lone no 16,21,22 is for logged in as name .
//         $id=$user['id'];
//         $sq="UPDATE user_info SET last_login_time=current_timestamp () WHERE id='$id'";
//         $conn->query($sq);
        $_SESSION['user']=$user['name'];
        $_SESSION['userid']=$user['id'];
        header('location:dashboard.php');
    }
    else{
        $m='credentials mismatch!';
    }
}
?>
<html>
<head>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="logo">
    
</div>
<form method="post">
    <div class="box bg-img">
        <div class="content">
            <h2> Log<span>In</span></h2>
            <div class="forms">
                <p style="color: #ff0000;padding: 20px"><?Php if($m!='') echo $m; ?></p>
                <div class="user-input">
                    <input type="text"name="uname"placeholder="user name"class="login-input"id="name">
                    <i class="fas fa-user"></i>
                </div>
                <div class="pass-input">
                    <input type="password"name="pass"placeholder="password"class="login-input"id="my-password">
                    <span class="eye"onclick="myfunction()">
                        <i id="hide-1"class="fas fa-eye-slash"></i>
                        <i id="hide-2"class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <button class="login-btn"type="submit" name="submit">Sign In</button>
            <p class="new contact">Not a user? <a href="register.php">Sign Up Now!</a> </p> <br>
            <p class="f-pass">

            </p>
        </div>
    </div>
</form>
</body>
</html>
