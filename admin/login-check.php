<!-- Thi Page To Login Access Control Panel If You Admin Only Else Redirect Login page 
  Attention  I Define This Session In login.php -->
  
<?php 
    // Access Control 
    // check the user is logged in or not 
    if(! isset($_SESSION['user']) ){
      $_SESSION['no-login-message'] = '<div class="error-msg">Pleas Login To Access Admin Panel.</div>';
      header("location:" .SITEURL. 'admin/login.php');
    }
?>