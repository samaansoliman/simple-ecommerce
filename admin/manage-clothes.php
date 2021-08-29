<?php include('partials/menu.php'); ?>

<!-- Main content start here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Clothes Page</h1>
        <br> <br>
        <a href="<?php echo SITEURL; ?>admin/add-clothes.php" class="btn-primary">Add New Clothes</a>
        <br> <br>
        <?php
            if (isset($_SESSION['add-clothes'])) {
                echo $_SESSION['add-clothes'];
                unset($_SESSION['add-clothes']);
            }

            if (isset($_SESSION['un-found'])) {
                echo $_SESSION['un-found'];
                unset($_SESSION['un-found']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <table class="table-full">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
                // Create S.N To Replace The Removed ID Deleted Of Database 
                $sn = 1;
                // 1. Create Query To Get The Data Category From The Database Table
                $sql = "SELECT * FROM tbl_clothes";
                //  Execute The Query
                $res = mysqli_query($conn, $sql);
                // Count The Rows
                $count = mysqli_num_rows($res);
                // Check we are Have Date On Database or Not
                if ($count > 0) {
                    // we Have Clothes IN Database
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id         =  $row['id'];
                        $title      =  $row['title'];
                        $price      =  $row['price'];
                        $image_name =  $row['image_name'];
                        $featured   =  $row['featured'];
                        $active     =  $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>EGP <?php echo $price; ?></td>

                        <td>
                            <?php
                            // Check The Image Name Display or Not
                            if ($image_name != "") {
                                // Display the Image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/clothes/<?php echo $image_name; ?>" width="100px" height="100px"/>
                            <?php
                            } else {
                                // Display The Message
                                echo '<div class="error-msg">Empty</div>';
                            }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-clothes.php?id=<?php echo $id; ?>" class="btn-secondary">Update Clothes</a>

                            <a href="<?php echo SITEURL; ?>admin/delete-clothes.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Clothes</a>
                        </td>
                    </tr>
            <?php
                    }
                } else {
                    // WE Do Not Have Date IN DataBase And Echo Error msg To say That 
                    echo "<tr><td colspan='7' class='error-msg'>No Clothes Added Yet.</td></tr>";
                }
            ?>
        </table>
    </div>
</div>
<!-- Main content  End here  -->

<?php include('partials/footer.php'); ?>