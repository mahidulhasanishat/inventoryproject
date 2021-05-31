        <?php
        include 'auth/connection.php';
        $conn=connection();
//       CloseConnect($conn);
        $m='';
        if (isset($_POST['submit'])){
            $name =$_POST['name'];
            $uname=$_POST['uname'];
            $email=$_POST['email']?$_POST['email']:'';
            $pass=$_POST['pass'];
            $rpass=$_POST['r_pass'];
            if($pass===$rpass){
                $sq="INSERT INTO user_info(name,u_name,email,password) VALUES('$name','$uname','$email','$pass')";
                if($conn ->query($sq)===true){
                   header('location:Login.php');
                }
                else{
                    $m="connection is not established";
                }

            }
            else{
            $m= "password dont match";

            }


        }
        ?>
        <html>
        <head>
            <title>  registration form</title>
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <link type="text/css"rel="stylesheet"href="css/style.css">
            <link type="text/css"rel="stylesheet"href="css/register.css">
        </head>
        <body>
          <form method="POST" action="register.php" enctype="multipart/form-data">
              <div class="container">
                  <span><?Php if($m!='') echo $m; ?></span>
                  <h1 style="text-align: center">registration form</h1>
                  <hr style="color: aliceblue">
                  <div style="margin-top: 8px">
                      <label>Your Name<span>*</span></label><br>
                      <input  name="name"id="name"type="text" placeholder="enter your name"required>
                  </div>
                  <div style="margin-top: 8px">
                      <label>User Name<span>*</span></label><br>
                      <input name="uname" id="uname"type="text"placeholder="enter your user name"required>
                  </div>
                  <div style="margin-top: 8px">
                      <label>Your Email</label><br>
                      <input name="email"id="email"type="text"placeholder="enter your email">
                  </div>
                  <div style="margin-top: 8px">
                      <label>Your password<span>*</span></label><br>
                      <input name="pass"id="pass"type="password" placeholder="enter your password" required>
                  </div>
                  <div style="margin-top: 8px">
                      <label>Repeat Password<span>*</span> </label><br>
                      <input name="r_pass"id="rpass"type="password"placeholder="confirm your password"required>
                  </div>
                  <div style="text-align: center;margin-top: 8px">
                      <p ><span>***</span> By Creating an account you agree to our trams & privacy </p>
                  </div>
                  <div style="text-align: center;padding: 20px">
                      <input type="submit"class="btn btn-success" value="submit" name="submit">
                  </div>
                  <div style="text-align: center">
                      <p >Already you have an account ? <a href="Login.php">Sign in</a> </p>
                  </div>
              </div>
        </form>
        </body>