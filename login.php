<?php
session_start();
//connect to database
require "db.php";
if(isset($_POST['login_btn']))
{
    $username=mysql_real_escape_string($_POST['username']);
    $password=mysql_real_escape_string($_POST['password']);
    $password=md5($password); //Remember we hashed password before storing last time
    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysqli_query($connection,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $_SESSION['message']="You are now Loggged In";
        $_SESSION['username']=$username;
        header("location:dashboard.php");
    }
   else
   {
                $_SESSION['message']="Username and Password combiation incorrect";
    }
}
else if(isset($_POST['register_btn']))
{
    $username=mysql_real_escape_string($_POST['username']);
    $email=mysql_real_escape_string($_POST['email']);
    $password=mysql_real_escape_string($_POST['password']);
    $password2=mysql_real_escape_string($_POST['password2']);
     if($password==$password2)
     {           //Create User
            $password=md5($password); //hash password before storing for security purposes
            $sql="INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
            mysqli_query($connection,$sql);
            $_SESSION['message']="You are now logged in";
            $_SESSION['username']=$username;
            header("location:dashboard.php");  //redirect home page
    }
    else
    {
      $_SESSION['message']="The two password do not match";
     }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>
</head>
<body>
<div class="header">
</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
?>

<div class="form">

      <ul class="tab-group">
        <li class="tab"><a href="#signup">Sign Up</a></li>
        <li class="tab active"><a href="#login">Log In</a></li>
      </ul>

      <div class="tab-content">

         <div id="login">
          <h1>Welcome !</h1>

          <form action="login.php" method="post">

            <div class="field-wrap">

            <input type="text" required autocomplete="off" name="username" placeholder="Username"/>
          </div>

          <div class="field-wrap">

            <input type="password" required autocomplete="off" name="password" placeholder="Password"/>
          </div>

          <button class="button button-block" name="login_btn" type="submit" >Login</button>

          </form>

        </div>


        <div id="signup">
          <h1>Sign Up for Free</h1>

          <form action="register.php" method="post" autocomplete="off">

          <div class="top-row">
            <div class="field-wrap">

              <input type="text" required autocomplete="off" name="username" placeholder="username"/>
            </div>

            <div class="field-wrap">

              <input type="email" required autocomplete="off" name="email" placeholder="email" />
            </div>
          </div>
		  <div class="top-row">
              <div class="field-wrap">

                <input type="password"required autocomplete="off" name='password' placeholder="Password" />
              </div>
              <div class="field-wrap">

                <input type="password"required autocomplete="off" name="password2" placeholder="Confirm Password"/>
              </div>

          </div>

          <button type="submit" class="button button-block" name="register_btn" />Register</button>

          </form>

        </div>
      </div>
  </div>


<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
</body>
</html>
