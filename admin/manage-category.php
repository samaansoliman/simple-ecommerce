<?php include('partials/menu.php'); ?>

<!-- Main content start here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage category Page</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        
        if (isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br> <br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category Page</a>
        <table class="table-full">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php
            // Create S.N To Replace The Removed ID Deleted Of Database 
            $sn = 1;
            // 1. Create Query To Get The Data Category From The Database Table
            $sql = "SELECT * FROM tbl_category";
            // 2. Execute The Query
            $res = mysqli_query($conn, $sql);
            // 3. Count The Rows
            $count = mysqli_num_rows($res);
            // 4. Check we are Have Date On Database or Not
            if ($count > 0) {
                // We Are Have Data In Database and Fetch It by While Loop
                while ($row = mysqli_fetch_assoc($res)) {
                    $id         =  $row['id'];
                    $title      =  $row['title'];
                    $image_name =  $row['image_name'];
                    $featured   =  $row['featured'];
                    $active     =  $row['active'];
            ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php
                            // Check The Image Name Display or Not
                            if ($image_name != "") {
                                // Display the Image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" height="100px"/>
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
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete Category</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                // WE Do Not Have Date IN DataBase
                echo "<tr><td colspan='7' class='error-msg'>No Category Added Yet.</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<!-- Main content  End here  -->

<?php include('partials/footer.php'); ?>
























































<!-- <tr>
     <td colspan="6"><div class="error-msg">No Category Added.</div></td>
     اخر 1.10.20 دقايق في الفيديو ال6 بس
</tr> -->




