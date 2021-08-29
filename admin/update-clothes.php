<?php include('partials/menu.php'); ?>
<div class="main-content">
  <div class="wrapper">
    <br><br>
    <h1>Update Clothes Page</h1>
    <br><br>
    <?php
    // Get Here IN THis Page The Old Date Of This ID We Selected It
    // 1. Check The ID We Selected It Set or Not
    if (isset($_GET['id'])) {
      //echo 'Yes You Are Right We Have This ID In Our Database';
      $id    = $_GET['id'];
      // Query To Get The Data
      $sql2  = "SELECT * FROM tbl_clothes WHERE id = $id";
      // Execute The Query
      $res2  = mysqli_query($conn, $sql2);
      // Get The Value Based On This Query
      $row2   = mysqli_fetch_assoc($res2);
      // Get The Selected The Values Of Clothes
      $title       = $row2['title'];
      $description = $row2['description'];
      $price       = $row2['price'];
      $old_image   = $row2['image_name'];
      $old_category = $row2['category_id'];
      $featured    = $row2['featured'];
      $active      = $row2['active'];
    } else {
      // Redirect To Mange Category Msg To Say Your Process Failed To Get ID
      header('location:' . SITEURL . 'admin/manage-category.php');
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <table class="table-add">
        <tr>
          <td>Title:-</td>
          <td><input type="text" name="title" value="<?php echo $title; ?>" /></td>
        </tr>

        <tr>
          <td>Description:-</td>
          <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
        </tr>

        <tr>
          <td>Price:-</td>
          <td><input type="number" name="price" value="<?php echo $price; ?>" /></td>
        </tr>

        <tr>
          <td>Old Image:-</td>
          <td>
            <?php
            if ($old_image != "") {
              // Display The Image
            ?>
              <img width="200px" height="200px" src="<?php echo SITEURL; ?>images/clothes/<?php echo $old_image; ?>" />
            <?php
            } else {
              // Display Message
              echo "<div class='error-msg'>Image Not Added.</div>";
            }
            ?>
          </td>
        </tr>

        <tr>
          <td>Select New Image:-</td>
          <td><input type="file" name="image" /></td>
        </tr>

        <tr>
          <td>Category:-</td>
          <td>
            <select name="category">
              <?php
              // Create php Code To Display All Category From Database
              // 1. Create SQl To Get All only Active Categories From Database
              $sql   = "SELECT * FROM tbl_category WHERE active = 'yes'";
              // Execute The Query
              $res   = mysqli_query($conn, $sql);
              // Count Rows To Check We Are Have Categories or Not
              $count = mysqli_num_rows($res);
              // Check If Count = 1 We are Have Categories Else We Are Have not Categories
              if ($count > 0) {
                // We Are Have Categories And Show It In While Loop
                while ($row = mysqli_fetch_assoc($res)) {
                  // In this the While loop we will Get the Data
                  $category_title = $row['title'];
                  $category_id    = $row['id'];
              ?>
                  <option <?php if ($old_category == $category_id) {
                            echo "selected";
                          } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                <?php
                }
              } else {
                // we Are Have Not Categories
                ?>
                <option value='0'>No Categories Found</option>
              <?php
              }
              ?>
            </select>
          </td>
        </tr>

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
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="old_image" value="<?php echo $old_image ?>" />
            <input type="submit" name="submit" value="Update Clothes" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
    <?php

    // 1. Checked If Button Submit Clicked Or Not
    if (isset($_POST['submit'])) {
      //echo 'The Button Displayed';

      //2. Get The value from form and update it
      $id          =  $_POST['id'];
      $title       =  $_POST['title'];
      $description =  $_POST['description'];
      $price       =  $_POST['price'];
      $old_image   =  $_POST['old_image'];
      $category    =  $_POST['category'];
      $featured    =  $_POST['featured'];
      $active      =  $_POST['active'];


      //3. Update The Image If Selected
      if (isset($_FILES['image']['name'])) {
        // Get The Details of The Image
        $image_name = $_FILES['image']['name'];

        // Check If The Image Available Or Not
        if ($image_name != "") {
          // Image Is Available and  
          // A. "-UPLOAD-" The New Image 
          $ext         = end(explode('.', $image_name));  // This code To Change The Extension Image
          $image_name  = "clothes_name_" . rand(0000, 9999) . '.' . $ext;  // This Code To Change The Name
          $source_path      = $_FILES['image']['tmp_name'];
          $destination_path = "../images/clothes/" . $image_name;
          $upload           = move_uploaded_file($source_path, $destination_path);

          if ($upload == false) {
            $_SESSION['upload'] = "<div class='error-msg'>Failed To Upload The New Image.</div>";
            header("location:" . SITEURL . 'admin/manage-clothes.php');
            die();
          }
          // B. Remove The Old Image from App And Database if The Image Available
          if ($old_image != "") {
            $remove_path = "../images/clothes/".$old_image;
            $remove = unlink($remove_path);
            // Check If ImageIs removed Or not And if Failed To Removed echo Messages and Stop The Process
            if ($remove == false) {
              // Display The Msg Here
              $_SESSION['failed-remove'] = "<div class='error-msg'>Failed To Remove The Old Image.</div>";
              header("location:" . SITEURL . 'admin/manage-clothes.php');
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
      $sql3 = "UPDATE tbl_clothes SET
          title      = '$title',
          description= '$description',
          price      =  $price,
          image_name = '$image_name',
          category_id= '$category',
          featured   = '$featured',
          active     = '$active'
          WHERE id   =  $id ";

      // Execute The Query 
      $res3  = mysqli_query($conn, $sql3);

      // 4. Update The Database Category If $sql2 Updated and Redirect Msg To Mange Category Page
      if ($res3 == true) {
        // Updated The Date
        $_SESSION['update'] = '<div class="success-msg">Clothes Updated successfully</div>';
        header("location:" . SITEURL . 'admin/manage-clothes.php');
      } else {
        // Failed To Update The Data
        $_SESSION['update'] = '<div class="error-msg">Failed Updated Clothes</div>';
        header("location:" . SITEURL . 'admin/manage-clothes.php');
      }
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>