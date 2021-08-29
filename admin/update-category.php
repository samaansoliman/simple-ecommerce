<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Category Page</h1>

    <?php
    // Get Here IN THis Page The Old Date Of This ID We Selected It
    // 1. Check The ID We Selected It Set or Not
    if (isset($_GET['id'])) {
      //echo 'Yes You Are Right We Have This ID In Our Database';
      $id    = $_GET['id'];
      // Query To Get The Data
      $sql   = "SELECT * FROM tbl_category WHERE id = $id";
      // Execute The Query
      $res   = mysqli_query($conn, $sql);
      // Count The Rows To Check The ID Valid Or Not
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        //Make Thing It Mean Get The Data Of This ID You Need It
        $row       = mysqli_fetch_assoc($res);
        $title     = $row['title'];
        $old_image = $row['image_name'];
        $featured  = $row['featured'];
        $active    = $row['active'];
      } else {
        // Redirect to Manage Category Page And Session the Msg Say Failed To Count the Rows
        $_SESSION['no-category-found'] = "<div class='error-msg'>Failed To Found This Category</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');
      }
    } else {
      // Redirect To Mange Category Msg To Say Your Process Failed To Get ID
      header('location:' . SITEURL . 'admin/manage-category.php');
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
      <table class="table-add">
        <tr>
          <td>Title:-</td>
          <td><input type="text" name="title" value="<?php echo $title; ?>" /> </td>
        </tr>

        <tr>
          <td>Old Image:-</td>
          <td>
            <?php
            if ($old_image != "") {
              // Display The Image
            ?>
              <img width="100px" height="100px" src="<?php echo SITEURL; ?>images/category/<?php echo $old_image; ?>" />
            <?php
            } else {
              // Display Message
              echo "<div class='error-msg'>Image Not Added.</div>";
            }
            ?>
          </td>
        </tr>

        <tr>
          <td>New Image:-</td>
          <td><input type="file" name="image" /> </td>
        </tr>

        <tr>
          <td>Featured:-</td>
          <td>
            <input <?php if ($featured == "yes") {
                      echo "checked";
                    } ?> type="radio" name="featured" value="yes" /> Yes
            <input <?php if ($featured == "no") {
                      echo "checked";
                    } ?> type="radio" name="featured" value="no" /> No
          </td>
        </tr>

        <tr>
          <td>Active:-</td>
          <td>
            <input <?php if ($active == "yes") {
                      echo "checked";
                    } ?> type="radio" name="active" value="yes" /> Yes
            <input <?php if ($active == "no") {
                      echo "checked";
                    } ?> type="radio" name="active" value="no" /> No
          </td>
        </tr>

        <tr>
          <td>
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="old_image" value="<?php echo $old_image ?>" />
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
    <?php

    // 1. Checked If Button Submit Clicked Or Not
    if (isset($_POST['submit'])) {
      //echo 'The Button Displayed';

      //2. Get The value from form and update it
      $id        =  $_POST['id'];
      $title     =  $_POST['title'];
      $old_image =  $_POST['old_image'];
      $featured  =  $_POST['featured'];
      $active    =  $_POST['active'];


      //3. Update The Image If Selected
      if (isset($_FILES['image']['name'])) {
        // Get The Details of The Image
        $image_name = $_FILES['image']['name'];

        // Check If The Image Available Or Not
        if ($image_name != "") {
          // Image Is Available and  
          // A. "-UPLOAD-" The New Image 
          $ext              = end(explode('.', $image_name));  // This code To Change The Extension Image
          $image_name       = "clothes_category_" . rand(000, 999) . '.' . $ext;  // This Code To Change The Name
          $source_path      = $_FILES['image']['tmp_name'];
          $destination_path = "../images/category/" . $image_name;
          $upload           = move_uploaded_file($source_path, $destination_path);
          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error-msg'>Failed To Upload The Image.</div>";
            header("location:" . SITEURL . 'admin/manage-category.php');
            die();
          }
          // B. Remove The Old Image from App And Database if The Image Available
          if ($old_image != "") {
            $remove_path = "../images/category/" . $old_image;
            $remove = unlink($remove_path);
            // Check If ImageIs removed Or not And if Failed To Removed echo Messages and Stop The Process
            if ($remove == false) {
              // Display The Msg Here
              $_SESSION['failed-remove'] = "<div class='error-msg'>Failed To Remove The Image.</div>";
              header("location:" . SITEURL . 'admin/manage-category.php');
              die();
            }
          }
        } else {
          $image_name = $old_image;
        }
      } else {
        // The New Image === The Old Image
        $image_name = $old_image;
      }

      // Also Update The Data of Category
      $sql2 = "UPDATE tbl_category SET
          title      = '$title',
          image_name = '$image_name',
          featured   = '$featured',
          active     = '$active'
          WHERE id   =  $id ";

      // Execute The Query 
      $res2  = mysqli_query($conn, $sql2);

      // 4. Update The Database Category If $sql2 Updated and Redirect Msg To Mange Category Page
      if ($res2 == true) {
        // Updated The Date
        $_SESSION['update'] = '<div class="success-msg">Category Updated successfully</div>';
        header("location:" . SITEURL . 'admin/manage-category.php');
      } else {
        // Failed To Update The Data
        $_SESSION['update'] = '<div class="error-msg">Failed Updated Category</div>';
        header("location:" . SITEURL . 'admin/manage-category.php');
      }
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>