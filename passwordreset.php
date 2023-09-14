<html>  
<head>  
    <title>Password Reset</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>

</style>
<?php
include 'connection.php';
if(isset($_REQUEST['pwdrst'])){
    $psw=$_REQUEST['psw'];
    $psw_repeat=$_REQUEST['psw_repeat'];
    $email=$_POST['email'];
    $password=password_hash($psw,PASSWORD_BCRYPT);
    $cpassword=password_hash($psw_repeat,PASSWORD_BCRYPT);
    if($psw==$psw_repeat){
        $sql="update signup set psw='$password' where email='$email'";
        $result=mysqli_query($conn,$sql);
        
        if($result>0){
            $msg='your password updated successfullyto Login';
            header( "refresh:3;URL=login.php" );
            

        }else{
            $msg='error while updating password';
        }
    }
    else{
        $msg="password and confirm password does not match";
    }
    }
    if($_GET['secret']){
        $email=base64_decode($_GET['secret']);
        $sql1="select email from signup where email='$email'";
        $result1=mysqli_query($conn,$sql1);
        $count=mysqli_num_rows($result1);
        if($count>0)
        { ?>



<body>
<div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Reset Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" >  
      <input type="hidden" name="email" value="<?php echo $email; ?>"/>
      <div class="form-group">
       <label for="pwd">Password</label>
       <input type="password" name="psw" id="psw" placeholder="Enter Password" required 
       data-parsley-type="pwd" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <label for="cpwd">Confirm Password</label>
       <input type="password" name="psw_repeat" id="psw_repeat" placeholder="Enter Confirm Password" required data-parsley-type="cpwd" data-parsley-trigg
       er="keyup" class="form-control"/>
      </div>
      <div class="form-group">
       <input type="submit" id="login" name="pwdrst" value="Reset Password" class="btn btn-success" />
       </div>
       
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
<?php }} ?>
</body>
</html>