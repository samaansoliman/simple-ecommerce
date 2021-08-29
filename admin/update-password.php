<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Change password</h1>

    <?php
    if (isset($_GET['id'])) {
      $id  = $_GET['id'];
    }
    ?>

    <form action="" method="POST">
      <table class="table-add">
        <tr>
          <td>Old password:-</td>
          <td> <input type="password" name="current_password" placeholder="old password"></td>
        </tr>
        <tr>
          <td> New password:-</td>
          <td> <input type="password" name="new_password" placeholder="write the new password"> </td>
        </tr>
        <tr>
          <td>Confirm password:-</td>
          <td> <input type="password" name="confirm_password" placeholder="write the password again"></td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input class="btn-primary" type="submit" name="submit" value="Change password">
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php
// 1. check the button submit clicked or not
if (isset($_POST['submit'])) {
  //echo 'Button is clicked';

  // 2. Get the data from form 
  $id               = $_POST['id'];
  $current_password = md5($_POST['current_password']);
  $new_password     = md5($_POST['new_password']);
  $confirm_password = md5($_POST['confirm_password']);


  // 3. Check the user have a OLd password or not
  $sql = " SELECT * from tbl_admin WHERE id=$id AND password ='$current_password' ";
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $count = mysqli_num_rows($res);
    if ($count == 1) {
      // 4. Check the new password Match with the Confirm Password or not
      if ($new_password == $confirm_password) {
        //update the password
        $sql2 = "UPDATE tbl_admin SET password=$new_password WHERE id=$id ";
        $res2 = mysqli_query($conn, $sql);
        // 5. if the new password Match with the Confirm Update the Change
        if ($res2 == true) {
          $_SESSION['change-password'] = '<div class="success-msg">The Password Changed.</div>';
          header("location:". SITEURL.'admin/manage-admin.php');
        } else {
          $_SESSION['change-password'] = '<div class="error-msg">Failed To Change Password .</div>';
          header("location:".SITEURL.'admin/manage-admin.php');
        }
      } else {
        $_SESSION['pass-not-match'] = '<div class="error-msg"> The New Password Not Match. </div>';
        header("location:".SITEURL.'admin/manage-admin.php');
      }
    } else {
      $_SESSION['user-not-found'] = '<div class="error-msg"> user is not found. </div>';
      header("location:".SITEURL.'admin/manage-admin.php');
    }
  } else {
    // make other some thing
  }
}

?>

<?php include('partials/footer.php'); ?>