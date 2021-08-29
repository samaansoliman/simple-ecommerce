<?php include('partials-front/header.php'); ?>

<?php
// Check If Isset The Id Found Or Not
if (isset($_GET['category_id'])) {
  // Get The Id
  $category_id = $_GET['category_id'];
  // Get The Category Title
  $sql  =  "SELECT title FROM tbl_category WHERE id = $category_id ";
  // Execute The Query
  $res  =  mysqli_query($conn, $sql);
  // Get The Value From Database
  $row  =  mysqli_fetch_assoc($res);
  // Get The Title
  $category_title = $row['title'];
} else {
  // No Id Found In Passed So Redirect 
  header("location: " . SITEURL);
}
?>

<!-- fOOD MEnu Section Starts Here -->

<section class="food-menu">
  <div class="container">
    <h2 class="text-center"> <a href="#"><?php echo $category_title; ?></a> </h2>


    <section class="food-menu">
      <?php
      // Create Query To Select From tbl_ Clothes
      $sql2  =  "SELECT * FROM tbl_clothes WHERE category_id = $category_id";
      // Execute The Query 
      $res2  =  mysqli_query($conn, $sql2);
      // Count The Rows
      $count =  mysqli_num_rows($res2);
      // Check If The Count > 0 echo The Results
      if ($count > 0) {
        // We Ara have A data Of Clothes And We will Show It In While Loop
        while ($row2   =  mysqli_fetch_assoc($res2)) {
          $id          =  $row2['id'];
          $title       =  $row2['title'];
          $price       =  $row2['price'];
          $description =  $row2['description'];
          $image_name  =  $row2['image_name'];
      ?>
          <!-- Start Here Show The Results Of The Clothes Content -->
          <div class="food-menu-box">
            <div class="food-menu-img">
              <?php
              if ($image_name == "") {
                // No Image Added And We Cant Show It
              } else {
                // The Image OF The Clothes Added And We Will Display It
              ?>
                <!-- Start The Display The Image Of The Clothes Here Between This HTML Tag -->
                <img src="<?php echo SITEURL; ?>images/clothes/<?php echo $image_name; ?>" class="img-responsive img-curve" />
            </div>
            <!--  End The Display The Image Of The Clothes Here Between This HTML Tag -->
          <?php
              }
          ?>

          <div class="food-menu-desc">
            <h4><?php echo $title; ?></h4>
            <p class="food-price"><?php echo $price; ?></p>
            <p class="food-detail"><?php echo $description; ?></p>
            <br />

            <a href="order.php?clothes_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
          </div>
          </div>
          <!-- End Here The Show Of Results Of The Clothes Content -->
      <?php
        }
      } else {
        // We Are Don`t Have Data
        echo "<div class='error-msg'>We Are Don`t Have Data Clothes Not Available In This Category</div>";
      }
      ?>
      <div class="clearfix"></div>
  </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>