<?php
session_start();
 include 'connection.php';
//  if(isset($_COOKIE['emailid']) && isset($_COOKIE['password']))
// {
//   $emailid = $_COOKIE['emailid'];
//   $password = $_COOKIE['password'];
// }
// else
// {
//   $emailid = $password ="";
// }
// if(isset($_POST['submit'])){
//   $email=$_POST['email'];
//   $psw=$_POST['psw'];
//     $sql = "SELECT signup.name, signup.email FROM signup WHERE signup.email = '$email' AND signup.status= 'active'";
//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) == 1) {
//         $row = mysqli_fetch_assoc($result);
//         $_SESSION['email'] = $email;
//         $_SESSION['name'] = $row['name']; 
//         header('Location: Profile.php');
//         if(isset($_REQUEST['rememberMe'])){
//           setcookie('emailid',$_REQUEST['email'],time()+60*60);
//           setcookie('password',$_REQUEST['psw'],time()+60*60);
//         }
//         else{
//           setcookie('emailid',$_REQUEST['email'],time()-10);//10 seconds
//           setcookie('password',$_REQUEST['pwd'],time()-10); //10 seconds
//         }
//         // header('Location:Profile.php');
//     } else {
//         echo 'Your account is not activated. Please check your email for activation instructions.';
//     }
// } 


if (isset($_COOKIE['emailid']) && isset($_COOKIE['password'])) {
    $emailid = $_COOKIE['emailid'];
    $password = $_COOKIE['password'];
} else {
    $emailid = $password = "";
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $psw = $_POST['psw'];

    $sql = "SELECT signup.name, signup.email, signup.psw FROM signup WHERE signup.email = '$email' AND signup.status = 'active'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['psw'];

        if (password_verify($psw, $hashedPassword)) {
            // Password is correct
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $row['name'];
            echo 'Login successful';
            header('Location: Profile.php');

            if (isset($_REQUEST['rememberMe'])) {
                setcookie('emailid', $_REQUEST['email'], time() + 60 * 60);
                setcookie('password', $_REQUEST['psw'], time() + 60 * 60);
            } else {
                setcookie('emailid', $_REQUEST['email'], time() - 10); // 10 seconds
                setcookie('password', $_REQUEST['psw'], time() - 10); // 10 seconds
            }
        } else {
            echo 'Incorrect password. Please try again.';
        }
    } else {
        echo 'Your account is not activated. Please check your email for activation instructions.';
    }
}



?>







<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 10%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<h2>Login Form</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="form">
  <div class="imgcontainer">
    <img src="training.jpg" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="email" required value="<?php echo $emailid; ?>">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" value="<?php echo $password;?>">
        
    <button type="submit" name="submit">Login</button>
    <label>
      <input type="checkbox" name="rememberMe" id="remember_me" <?php if(isset($_COOKIE["emailid"])) { ?> checked <?php } ?>> Remember me
    </label>
  </div>

  <div class="container" style="background-color:#f1f1f1">

    <span class="psw">Forgot <a href="forgot.php">password?</a></span>
    <p>Don't  have an account? <a href="register.php">Sign Up</a>.</p>
  </div>
</form>

</body>



</html>
