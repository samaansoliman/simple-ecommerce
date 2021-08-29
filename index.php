<?php include('partials-front/header.php'); ?>

<section class="food-search text-center">
  <div class="container">
    <form action="<?php echo SITEURL; ?>clothes-search.php" method="POST">
      <input type="search" name="search" placeholder="Search for .." required />
      <input type="submit" name="submit" value="Search" class="btn btn-warning" />
    </form>
  </div>
</section>

<?php 
  // echo The Session Of Success Order Here
  if(isset($_SESSION['order'])){
    echo $_SESSION['order'];
    unset($_SESSION['order']);
  }
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Explore Clothes</h2>

    <?php
    // Write A Code To Display The Categories From Database Here 
    $sql   = "SELECT * FROM tbl_category WHERE active = 'yes' AND featured = 'yes' LIMIT 12";
    // Execute The Query
    $res   = mysqli_query($conn, $sql);
    // Count The Rows 
    $count = mysqli_num_rows($res);
    // Check The Category Is Available Or Not
    if ($count > 0) {
      // The Category Is Available And Make While Loop To Get The Value
      while ($row = mysqli_fetch_assoc($res)) {
        $id         =  $row['id'];
        $title      =  $row['title'];
        $image_name =  $row['image_name'];
        // A Now Close The Php Tag And Open New Tag To write Between Them HTML Code To Show Category
    ?>
        <a href="<?php echo SITEURL; ?>category-clothes.php?category_id=<?php echo $id; ?>">
          <div class="box-3 float-container">
            <?php if ($image_name == "") {
              // Display Error Msg To say The Image Not Available
              echo "<div class='error-msg'>The Image OF This Category Not Available</div>";
            } else {
              // Display The Image And Also All Information
            ?>
              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve" />
              <h3 class="float-text text-white"><?php echo $title; ?></h3>
            <?php
            }
            ?>


          </div>
        </a>
    <?php
      }
    } else {
      // The Category Not Available
      echo "<div class='error-msg'>The Category Not Added</div>";
    }
    ?>

    <div class="clearfix"></div>
  </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Clothes Menu</h2>


    <?php
    // Write A Code To Display The Clothes From tbl_Clothes Here
    $sql2   =  "SELECT * FROM tbl_clothes WHERE active = 'yes' AND featured = 'yes' ";
    $res2    =  mysqli_query($conn, $sql2);
    $count2 =  mysqli_num_rows($res2);
    if ($count2 > 0) {
      // We Are Have A Clothes To Show
      while ($row2 = mysqli_fetch_assoc($res2)) {
        $id          = $row2['id'];
        $title       = $row2['title'];
        $price       = $row2['price'];
        $description = $row2['description'];
        $image_name  = $row2['image_name'];
    ?>
        <!-- Start Display The Data Of The Clothes Here -->
        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            if ($image_name == "") {
              // The Image Is Not Available Can Not Show It 
              echo "<div class='error-msg'>The Image Is Not Available Can Not Show It</div>";
            } else {
              // The Image Is Available We Will Show It
            ?>
              <img src="<?php echo SITEURL; ?>images/clothes/<?php echo $image_name; ?>" class="img-responsive img-curve" />
            <?php
            }
            ?>
          </div>

          <div class="food-menu-desc">
            <h4><?php echo $title; ?></h4>
            <p class="food-price">EGP<?php echo $price ?></p>
            <p class="food-detail"><?php echo $description; ?></p>
            <br />
            <a href="order.php?clothes_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
          </div>
        </div>
        <!-- End Display The Data Of The Clothes Here -->
    <?php
      }
    } else {
      // We Are Haven`t A Clothes To Show
      echo "<div class='error-msg'>The Clothes Not Available</div>";
    }
    ?>

    <div class="clearfix"></div>
  </div>

  <p class="text-center">
    <a href="#">See All Foods</a>
  </p>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>