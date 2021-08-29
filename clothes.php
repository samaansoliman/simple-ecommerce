<?php 
  include('partials-front/header.php'); 
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
  <div class="container">
    <form action="<?php echo SITEURL; ?>clothes-search.php" method="POST">
      <input type="search" name="search" placeholder="Search for Food.." required />
      <input type="submit" name="submit" value="Search" class="btn btn-primary" />
    </form>
  </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
  <div class="container">
    <h2 class="text-center">Clothes Menu</h2>
    <?php
    // Writ A Quey Code To Select All The Clothes From Tbl_Clothes
    $sql   =  "SELECT * FROM tbl_clothes WHERE active = 'yes' AND featured = 'yes' ";
    $res   =  mysqli_query($conn, $sql);
    $count =  mysqli_num_rows($res);
    if ($count > 0) {
      // We Are Have Data Clothes In Our Database And Will Show It Now
      while ($row = mysqli_fetch_assoc($res)) {
        $id          = $row['id'];
        $title       = $row['title'];
        $price       = $row['price'];
        $description = $row['description'];
        $image_name  = $row['image_name'];
    ?>
        <!-- Start Display The Data Of The Clothes Here -->
        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php
            if ($image_name == "") {
              // We Are Don`t Have A Clothes Image
              echo "We Are Don`t Have A Clothes Image";
            } else {
              // We Are Have Image Clothes And We Will Show It 
            ?>
              <img src="<?php echo SITEURL ;?>images/clothes/<?php echo $image_name; ?>" class="img-responsive img-curve" />
            <?php
            }

            ?>
          </div>
          <div class="food-menu-desc">
            <h4><?php echo $title; ?></h4>
            <p class="food-price">EGP<?php echo $price; ?></p>
            <p class="food-detail"><?php echo $description; ?></p>
            <br />

            <a href="order.php?clothes_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
          </div>
        </div>
        <!-- End Display The Data Of The Clothes Here -->
    <?php
      }
    } else {
      // We Are Haven`t Date We Can`t Show any Thing
      echo "We Are Haven`t Date We Can`t Show any Thing";
    }

    ?>


    <div class="clearfix"></div>
  </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php 
  include('partials-front/footer.php'); 
?>