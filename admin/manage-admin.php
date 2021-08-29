<?php include('partials/menu.php'); ?>

<!-- Main content start here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin Page</h1>

        <?php

        // if Do == Add admin
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        // if Do == Delete admin 
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        // if Do == Update admin 
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        // if Do == Update password 
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }

        // if Do == not match password 
        if (isset($_SESSION['pass-not-match'])) {
            echo $_SESSION['pass-not-match'];
            unset($_SESSION['pass-not-match']);
        }

        // if Do == password Change successfully. 
        if (isset($_SESSION['change-password'])) {
            echo $_SESSION['change-password'];
            unset($_SESSION['change-password']);
        }
       
        ?>

        <br> <br> <br> <br> <br>
        <a href="add-admin.php" class="btn-primary">Add New Admin</a>
        <br> <br> <br> <br>
        <table class="table-full">
            <tr>
                <th>ID</th>
                <th>FullName</th>
                <th>UserName</th>
                <th>Action</th>
            </tr>

            <?php

            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);
            if ($res == TRUE) {
                $count = mysqli_num_rows($res);

                $sn = 1; // Variable To Resolve The Problem Of Delete Member

                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                    ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $rows['full_name']; ?></td>
                            <td><?php echo $rows['username']; ?></td>
                            <td>
                                <a href="update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>
                    <?php
                }
            } 
        }

            ?>
        </table>
    </div>
</div>
<!-- Main content  End here  -->

<?php include('partials/footer.php'); ?>