<?php include('partials-front/header.php'); ?>

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">The Results Search <a href="#">"<?php echo $_POST['search']; ?>"</a></h2>


    <?php
    // Write A Code To Get The KeyWord Of Search
    $search = $_POST['search'];
    // Write A Code To Based On The Clothes From The Search
    $sql   =  " SELECT * FROM tbl_clothes WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";
    $res   =  mysqli_query($conn, $sql);
    $count =  mysqli_num_rows($res);

    if ($count > 0) {
      // We Are Have Keyword Refer To Your Search And We Will Get It
      while ($row  =  mysqli_fetch_assoc($res)) {
        $id          =  $row['id'];
        $title       =  $row['title'];
        $price       =  $row['price'];
        $description =  $row['description'];
        $image_name  =  $row['image_name'];
    ?>
        <!--  Start Display The Data Of The Clothes Here Refer The Search -->
        <div class="food-menu-box">
          <div class="food-menu-img">

            <?php
            if ($image_name == "") {
              // The Image Not Found Or Not Available
              echo "<div class='error-msg'>The Image Not Found Or Not Available</div>";
            } else {
              // Display The Image Is available
            ?>
              <img src="<?php echo SITEURL; ?>images/clothes/<?php echo $image_name; ?>" class="img-responsive img-curve" />
            <?php
            }
            ?>

          </div>

          <div class="food-menu-desc">
            <h4><?php echo $title ?></h4>
            <p class="food-price">EGP<?php echo $price; ?></p>
            <p class="food-detail"><?php echo $description ?></p>
            <br />

            <a href="order.php?clothes_id=<?php echo $id; ?>" class="btn btn-primary" class="btn btn-primary">Order Now</a>
          </div>
        </div>
        <!--  End Display The Data Of The Clothes Here Refer The Search -->
    <?php
      }
    } else {
      // We Ara Haven`t Any Keyword Refer To Search
      echo "<div class='error-msg'> We Ara Haven`t Any Keyword Refer To Search</div>";
    }
    ?>
    <div class="clearfix"></div>
  </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>