<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category Page</h1>
    <br> <br>
    <?php 
        if (isset($_SESSION['add'])) {
          echo $_SESSION['add'];
          unset($_SESSION['add']);
      }

      if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    ?>
    <br> <br>
    <form action="" method="POST" enctype="multipart/form-data">
      <table class="table-add">
        <tr>
          <td>Title:-</td>
          <td><input type="text"  name="title" placeholder="Write The Title" /></td>
        </tr>
        <tr>
          <td>Image:-</td>
          <td><input type="file"  name="image" /></td>
        </tr>
        <tr>
          <td>Featured:-</td>
          <td>
            <input type="radio"  name="featured" value="yes" /> yes
            <input type="radio"  name="featured" value="no" /> no
          </td>
        </tr>
        <tr>
          <td>Active:-</td>
          <td>
            <input type="radio" name="active" value="yes"/> yes
            <input type="radio" name="active" value="no"/> no
          </td>
        </tr>
        <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<?php

  // 1.  Check the Button Clicked or Not
  if(isset($_POST['submit'])) {
    //echo 'Yes The Button Clicked You Can Complete Your Query';

  // 2. Get the Value From The Form
  $title = $_POST['title'];

  if(isset($_POST['featured'])){
    $featured = $_POST['featured'];
  } else{
    // Set the Default Value
    $featured = "No";
  }

  if(isset($_POST['active'])){
    $active = $_POST['active'];
  } else{
    // Set the Default Value
    $active = "No";
  }
 
  // Upload File fo photo
  //print_r($_FILES['image']); die();
  if(isset($_FILES['image']['name'])){
    // Upload The Image but we need  1-$image_name, 2-$Source_path, 3-$destination_path, 4-Finally Uploaded Image
      $image_name       = $_FILES['image']['name'];
      if($image_name !=""){  // Look to the Under Line
      // This Last Condition To Check Upload Image Only Selected Or Not !important Understand //
      $ext              = end(explode('.', $image_name));             // This code To Change The Extension Image
      $image_name       = "clothes_category_".rand(000,999).'.'.$ext;  // This Code To Change The Name Image
      $source_path      = $_FILES['image']['tmp_name']; 
      $destination_path = "../images/category/".$image_name;
      $upload           = move_uploaded_file($source_path, $destination_path);
      if($upload == false){
        $_SESSION['upload'] = "<div class='error-msg'>Failed To Upload The Image.</div>";
        header("location:".SITEURL.'admin/add-category.php');
        die();
      }
    }
  }else {
    // Failed To Upload Image and set the Image_Name Is blank
    $image_name = "";
  }
  

  // 3. Create The SQL Query To Insert The Category
  $sql     = "INSERT INTO tbl_category SET
    title       ='$title',
    featured    ='$featured',
    active      ='$active',
    image_name = '$image_name'
  ";
  
  // 4. Execute The Query and save In Database
  $res = mysqli_query($conn, $sql);


  // 5. Check The Query Executed or Not and Data Added Or Not
  if($res == true) {
    // Make Thing It Is Query Executed and Category Added
    $_SESSION['add'] = "<div class='success-msg'>Category Added successfully</div>";
    header("location:" .SITEURL.'admin/manage-category.php'); 
  }else{
    // Make Anther thing It Ts Failed To Add The Category
    $_SESSION['add'] = "<div class='error-msg'>Failed To Add Category</div>";
    header("location:" .SITEURL.'admin/add-category.php');
  }
}
?>


<?php include('partials/footer.php'); ?>