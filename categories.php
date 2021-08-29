<?php include('partials-front/header.php'); ?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="text-center">Explore Foods</h2>

    <?php
    $sql   = " SELECT * FROM tbl_category WHERE active = 'yes' AND featured = 'yes' ";
    $res   = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
      // Fetch The Data In While Loop
      while ($row  = mysqli_fetch_assoc($res)) {
        $id         =  $row['id'];
        $title      =  $row['title'];
        $image_name =  $row['image_name'];

    ?>
        <a href="<?php echo SITEURL; ?>category-clothes.php?category_id=<?php echo $id; ?>">
          <div class=" box-3 float-container">
          <?php
          if ($image_name == "") {
            // Image Not Available 
            echo "<div class='error-msg'>Image Not Available</div>";
          } else {
            // Image Is Available
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
      // Category Not Available
      echo "<div class='error-msg'>The Category Is Not Available</div>";
    }
?>

<div class="clearfix"></div>
</div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php'); ?>





































































<!-- <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Burger"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Burger</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Momo"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Momo</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Pizza"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Pizza</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Burger"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Burger</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Momo"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Momo</h3>
          </div>
        </a>
        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Pizza"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Pizza</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Burger"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Burger</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Momo"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Momo</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Pizza"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Pizza</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Burger"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Burger</h3>
          </div>
        </a>

        <a href="#">
          <div class="box-3 float-container">
            <img
              src="images/18.jpeg"
              alt="Momo"
              class="img-responsive img-curve"
            />

            <h3 class="float-text text-white">Momo</h3>
          </div>
        </a> -->