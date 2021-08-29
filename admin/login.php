<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin Page</title>
  <link rel="stylesheet" href="css/backend.css">
</head>
<body>

  <div class="login">
      <h1 class="text-center">Login Admin Page</h1>
      <br>
            <?php 

              if(isset($_SESSION['login'])){
                  echo  $_SESSION['login'];
                  unset ($_SESSION['login']);
              }

              if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
              }
              
            ?>
      <br>
      <form action="" method="POST">
        <h6>User Name:-</h6> <br>
        <input type="text" name="username"><br><br>

        <h6>Password:-</h6><br>
        <input type="password" name="password"><br><br>

        <h6>Login:-</h6><br>
        <input class="btn-primary" type="submit" name="submit" value="login"><br>
      </form>
      <p class="text-center">Created By.<a href="#">Samaan soliman</a></p>
  </div>

</body>
</html>

<?php 

  // 1. Check The button submit Clicked Or Not If true Process The login And Do every thing
  if(isset($_POST['submit'])){
    
   // 2. Get The Date From Login Form
   $username = $_POST['username'];
   $password = md5($_POST['password']);
   
   // 3. SQL Query to Check The UserName And Password IN DataBase Or Not 
   $sql = " SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";
   $res = mysqli_query($conn, $sql);

   // 4.Count Rows To Check The User In DataBase Or Not
   $count = mysqli_num_rows($res);
   if($count == 1){
     // login user 
     $_SESSION['login'] = '<div class="success-msg">your process to login success</div>';
     header("location:".SITEURL.'admin/index.php');

     $_SESSION['user'] = $username; // focus This is Session login to check user logged in or not..
   } else {
     // fall login user
     $_SESSION['login'] = '<div class="error-msg">your process to login Not success</div>';
     header("location:".SITEURL.'admin/login.php');
  }

}

?>

<?php include('partials/footer.php'); ?>



