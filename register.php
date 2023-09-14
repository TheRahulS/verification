<?php
session_start();
  if(isset($_POST['submit'])){
    include 'connection.php';
  $name=$_POST['name'];
  $email=$_POST['email'];
  $psw=$_POST['psw'];
  $psw_repeat=$_POST['psw_repeat'];
  $password=password_hash($psw,PASSWORD_BCRYPT);
  $cpassword=password_hash($psw_repeat,PASSWORD_BCRYPT);
  $token=bin2hex(random_bytes(16));
  $emailquery="select * from signup where email='$email'";

  $result=mysqli_query($conn,$emailquery);
  $emailcount=mysqli_num_rows($result);
  if($emailcount>0){
    echo 'email already exists';
  }
  else{
    if($psw==$psw_repeat){
      $sql="insert into signup(name,email,psw,token,status) values('$name','$email','$password','$token','inactive')";
      $result1=mysqli_query($conn,$sql);
      if($result1){
         $subject='Email Activation';
         $body="Hi.$name.click here to activate your account http://localhost/completecrud/test.php?code=$token ";
         $headers="From:rahulsoni7982@gmail.com";
         if(mail($email,$subject,$body,$headers)){
          echo "this send on mail".$mail;
          header("Location:test.php");
         }
         else{
          echo 'mail sending failed';
         }
      }
      else{
        echo 'does not sending mail';
      }
    }
  
  }
}



?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: white;
}
h1{
  text-align: center;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
<fieldset>
  <legend>  <p>Please fill in this form to create an account.</p></legend>

  <div class="container">
    <h1>Register</h1>
  
    <hr>
    <label for="fullname"><b>FullName</b></label>
    <input type="text" placeholder="Enter FullName" name="name" id="email" required>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="psw_repeat" id="psw-repeat" required>
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn" name="submit">Register</button>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="Login.php">Sign in</a>.</p>
  </div>
  </fieldset>
</form>

</body>
</html>
