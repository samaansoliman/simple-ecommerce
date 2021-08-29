<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php
        if (isset($_SESSION['add'])) {

            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <form action="" method="POST">
            <table class="table-add">
                <tr>
                    <td> Full Name :- </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Full name" required>
                    </td>
                </tr>
                <tr>
                    <td> Username :- </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter username" required>
                    </td>
                </tr>
                <tr>
                    <td> Password :- </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

if (isset($_POST['submit'])) {

    //1-Get the Data From The Form
    $full_name = $_POST['full_name'];
    $username  = $_POST['username'];
    $password  = md5($_POST['password']);


    //2-SQl Query to Save the data in Database
    $sql = "INSERT INTO tbl_admin SET 
              full_name = '$full_name',
              username  = '$username',
              password  = '$password' ";

    //3-Execute The Query Saving Data into Database
    $res = mysqli_query($conn, $sql);

    //or die(mysqli_error());


    //4-Check The Query Inserted In Database or not 
    if ($res == TRUE) {
        $_SESSION['add'] = "<div class='success-msg'>Admin Added successfully</div>";
        header("location:" .SITEURL.'admin/manage-admin.php');
    } else {
        $_SESSION['add'] = 'Failed To Add Admin';
        header("location:" .SITEURL.'admin/add-admin.php');
    }
}

?>

<?php include('partials/footer.php'); ?>