<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update admin</h1>

        <?php
        // . Get the id of The Admin to Delete It 
        $id = $_GET['id'];
        // . write Query To Delete the Admin
        $sql = "SELECT * FROM tbl_admin WHERE id = $id";
        // . Execute the Query 
        $res = mysqli_query($conn, $sql);
        // check the query Executed or not
        if($res==true) {
            // check we are Have Data of admin or not
            $count = mysqli_num_rows($res);
            if($count == 1) {
                //Get The Details
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['username'];
              } else {
                //Get error Query to Display and redirect manage page location
                header("location:" .SITEURL.'admin/manage-admin.php');
            }
        }
        ?>

        <form action="" method="POST">
            <table class="table-add">
                <tr>
                    <td> Full Name :- </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td> Username :- </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        //check the button clicked or not
        if(isset($_POST['submit'])) {
          //echo 'The button clicked';

          //Get The value from form and update it
          $id        = $_POST['id'];
          $full_name = $_POST['full_name'];
          $username  = $_POST['username'];

          //Create a SQL Query to Update the admin
          $sql = "UPDATE tbl_admin SET 
                full_name = '$full_name',
                username  = '$username'
                WHERE id =  '$id'
                
              ";
          // Execute the Query 
          $res = mysqli_query($conn, $sql);
          // check the query Executed or not
          if($res == true){ 
            $_SESSION['update'] = '<div class="success-msg">Admin Updated successfully</div>';
            header("location:".SITEURL.'admin/manage-admin.php');

            }else {
            $_SESSION['update'] = '<div class="error-msg">Failed To Updated this Admin</div>';
            header("location:".SITEURL.'admin/manage-admin.php');
          }
      }
      ?>
    </div>
</div>

<?php include('partials/footer.php') ?>
















