<?php
  ob_start();
  include('partials-front/header.php'); 
?>

<?php
// Check If Isset Get Of Clothes Id Or Not Selected
if (isset($_GET['clothes_id'])) {
  // We Are Have The Clothes_ID
  $clothes_id   =   $_GET['clothes_id'];

  // Write A Query To Get The Clothes Selected
  $sql    =   "SELECT * FROM tbl_clothes WHERE id = $clothes_id";
  // Execute The Query
  $res    =    mysqli_query($conn, $sql);
  // Count The Rows 
  $count  =    mysqli_num_rows($res);
  // Check If The Clothes Data Available OR Not
  if ($count == 1) {
    // Get The Data of The Selected Clothes
    $row   = mysqli_fetch_assoc($res);
    $title = $row['title'];
    $price = $row['price'];
    $image_name = $row['image_name'];
  } else {
    // We Are Don`t Have This Data Clothes Not Available
    echo "<div class='error-msg'>We Are Don`t Have Data Clothes Not Available</div>";
  }
} else {
  // We Are Don`t Have Clothes_ID And Redirect
  header("location:" . SITEURL);
}
?>

<section class="food-search">
  <div class="container">
    <h2 class="text-center text-white">
      Fill this form to confirm your order.
    </h2>

    <form action="" method="POST" class="order" >
      <fieldset>
        <legend>Selected Type</legend>
        <div class="food-menu-img">
          <?php
          if ($image_name == "") {
            // Image Not Found
            echo "<div class='error-msg'>Image Not Found or Not Available</div>";
          } else {
            // Image Is Available We will Show It 
          ?>
            <!-- Start the Display The Image Of Selected Clothes Between This HTML Tag -->
            <img src="<?php SITEURL;?>images/clothes/<?php echo $image_name; ?>" class="img-responsive img-curve" />
            <!-- End the Display The Image Of Selected Clothes Between This HTML Tag -->
        </div>
      <?php
          }
      ?>

      <div class="food-menu-desc">
        <h3><?php echo $title; ?></h3>
        <input type="hidden" name="clothes" value="<?php echo $title; ?>"/> 
        <p class="food-price"><?php echo $price; ?></p>
        <input type="hidden" name="price" value="<?php echo $price; ?>" />
        <div class="order-label">Quantity</div>
        <input type="number" name="qty" class="input-responsive" value="1" required />
      </div>
      </fieldset>

      <fieldset>
        <legend>Delivery Details</legend>
        <div class="order-label">Full Name</div>
          <input type="text" name="full-name" placeholder="Your Name" class="input-responsive" required />
        <div class="order-label">Phone Number</div>
          <input type="tel" name="contact" placeholder="Your Number" class="input-responsive" required />
        <div class="order-label">Email</div>
         <input type="email" name="email" placeholder="E.x. example@example.com" class="input-responsive" required />
        <!-- <div class="order-label">Address</div>
        <textarea name="address" rows="10" placeholder="type your address" class="input-responsive" required>
        </textarea> -->
        <fieldset name="address">
                  <h4>Address</h4>
                  <input type="number" placeholder="رقم العقار" required>
                  <input type="text"   placeholder="اسم الشارع" required>
                  <input type="text"   placeholder="حي او منطقه" required>
                  <select required>
                    <option value="1">القاهره</option>
                    <option value="2">الجيزه</option>
                    <option value="3">الشرقيه</option>
                    <option value="4">المنصوره</option>
                    <option value="5">كوم البصل</option>
                  </select>
                  <select required>
                    <option value="1">مصر</option>
                    <option value="2">الكويت</option>
                    <option value="3">الاردن</option>
                    <option value="4">البحرين</option>
                    <option value="5">الامارات</option>
                  </select>
        </fieldset>
        <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary" />
      </fieldset>
    </form>
  </div>

  <?php 
    // Check If The Button Submit Working or Not
    if(isset($_POST['submit'])){
      //echo "The Button Is Activity";
      // The Button Working Now We Will Get The Data
      $clothes         = $_POST['clothes'];
      $price           = $_POST['price'];
      $qty             = $_POST['qty'];
      $total           = $price * $qty ; // This Mean The Price X The Qty
      $order_date      = date("Y-m-d H:i:s"); // Order_Date
      $status          ="Ordered"; // ON-Delivery || Delivered || Cancelled
      $customer_contact= $_POST['contact'];
      $customer_name   = $_POST['full-name'];
      $customer_email  = $_POST['email'];
      $customer_address= $_POST['address'];

      // After The Complete The Form Save The Order In Database By Sql Query
      $sql2  =  "INSERT INTO tbl_order SET
      clothes          = '$clothes',
      price            = $price, 
      qty              = $qty,
      total            = $total,
      order_date       = '$order_date',
      status           = '$status',
      customer_contact = '$customer_contact',
      customer_name    = '$customer_name', 
      customer_email   = '$customer_email', 
      customer_address = '$customer_address'
      ";
      // Execute The Query
      $res2  =  mysqli_query($conn, $sql2);
      // Check If The Query Executed Successfully or Not 
      if($res2 == true){
        $_SESSION ['order'] = "<div class='success-msg text-center'>Your Order Is Confirmed.</div>";
        header("location: ". SITEURL);
      } else {
        // Failed To Confirmed The Order
        $_SESSION ['order'] = "<div class='error-msg text-center'>Failed To Confirmed Your Order</div>";
        header("location:" . SITEURL);
      }

    } else {
      // The Button Not Working 
      //echo "The Button Not Working";
    }
 ?>
</section>

<?php
  ob_end_flush();
  include('partials-front/footer.php'); 
?>


