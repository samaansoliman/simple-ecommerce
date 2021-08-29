<?php

    // . Include Constants 
    include('../config/constants.php');

    // . Get the id of The Admin to Delete It 
    $id = $_GET['id'];

    // . write Query To Delete the Admin
    $sql = "DELETE FROM tbl_admin WHERE id = $id";

    // . Execute the Query 
    $res = mysqli_query($conn, $sql);

    // check the Query ExEcuted or Not
    if ($res == TRUE) {

        $_SESSION['delete'] = '<div class="success-msg">Admin Deleted successfully</div>';
        header("location:" .SITEURL.'admin/manage-admin.php');
    } else {

        $_SESSION['delete'] = '<div class="error-msg">Failed To Deleted this Admin</div>';
        header("location:" .SITEURL.'admin/manage-admin.php');
    }

?>    