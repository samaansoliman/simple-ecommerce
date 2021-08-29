<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Order Page</h1>
    <br> <br>
    <?php
    // 1. Write Code To Check If Isset We Have Get_ID Of Item OR Not
    if (isset($_GET['id'])) {
      // A. we Have $_Get Of This Item You Selected It And Get The Details
      $id = $_GET['id'];
      // 2. Write Query To Get The Value
      $sql = "SELECT * FROM tbl_order WHERE id = $id";
      // 3. Execute The Query
      $res = mysqli_query($conn, $sql);
      // 4. Count The Rows
      $count = mysqli_num_rows($res);
      // 5. Check If The Count == 1 Get The Data Item
      if ($count == 1) {
        // We Have data For This Item And We Will Fetch It 
        $row = mysqli_fetch_assoc($res);
        $clothes          = $row['clothes'];
        $price            = $row['price'];
        $qty              = $row['qty'];
        $total            = $row['total'];
        $status           = $row['status'];
        $customer_name    = $row['customer_name'];
        $customer_contact = $row['customer_contact'];
        $customer_email   = $row['customer_email'];
        $customer_address = $row['customer_address'];
      } else {
        // We Haven`t Data For The Item And Redirect
        //header('location:'.SITEURL.'admin/manage-order.php');
      }
    } else {
      // B. we Don`t Have $_Get of This Item You Selected and Redirect
      header('location:' . SITEURL . 'admin/manage-order.php');
    }
    ?>

    <form action="" method="POST">
      <table class="table-full">
        <tr>
          <td>Clothes Name</td>
          <td><b><?php echo $clothes; ?></b></td>
        </tr>

        <tr>
          <td>Price</td>
          <td><b><?php echo $price; ?></b></td>
        </tr>

        <tr>
          <td>Qty</td>
          <td><input type="number" name="qty" value="<?php echo $qty; ?>" /></td>
        </tr>

        <tr>
          <td>Total</td>
          <td><input type="number" name="total" value="<?php echo $total; ?>" /></td>
        </tr>

        <tr>
          <td>Status</td>
          <td>
            <select name="status">
              <option <?php if ($status == "ordered") {
                        echo 'selected';
                      } ?> value="ordered">Ordered
              </option>

              <option <?php if ($status == "on delivery") {
                        echo 'selected';
                      } ?>value="on delivery">ON Delivery
              </option>

              <option <?php if ($status == "delivered") {
                        echo 'selected';
                      } ?> value="delivered">Delivered
              </option>

              <option <?php if ($status == "cancelled") {
                        echo 'selected';
                      } ?> value="cancelled">Cancelled
              </option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Customer Name</td>
          <td><input type="customer_name" name="customer_name" value="<?php echo $customer_name ?>" /></td>
        </tr>

        <tr>
          <td>Phone</td>
          <td>
            <input type="customer_contact" name="customer_contact" value="<?php echo $customer_contact ?>" />
          </td>
        </tr>

        <tr>
          <td>Customer Email</td>
          <td>
            <input type="customer_email" name="customer_email" value="<?php echo $customer_email ?>" />
          </td>
        </tr>

        <tr>
          <td>Customer Address</td>
          <td>
            <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address ?></textarea>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <input type="hidden" name="price" value="<?php echo $price; ?>"/>
            <input class="btn-secondary" type="submit" name="submit" value="Update Order" />
          </td>
        </tr>
      </table>
    </form>
    <?php
      // Check If The Button Submit Working Update The Order
      if(isset($_POST['submit'])){
        echo "The Button Working Successfully";

        // 1. Get The Data From The Form
        $id               = $_POST['id'];
        $price            = $_POST['price'];
        $qty              = $_POST['qty'];
        $total            = $_POST['total'];
        $status           = $_POST['status'];
        $customer_name    = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email   = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];

        // 2. write Sql To Update The Item
        $sql2 = "UPDATE tbl_order SET
        qty   = '$qty',
        total = '$total',
        status= '$status',
        customer_name    = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email   = '$customer_email',
        customer_address = '$customer_address'
        WHERE id = $id";

        // 3. Execute The Query
        $res2 = mysqli_query($conn, $sql2);

        // 4. Update The Database order If $sql2 Updated and Redirect Msg To Mange Category Page
        if ($res2 == true) {
          // Updated The Date
          $_SESSION['update'] = '<div class="success-msg">Order Updated successfully</div>';
          header("location:" . SITEURL . 'admin/manage-order.php');
        } else {
          // Failed To Update The Data
          $_SESSION['update'] = '<div class="error-msg">Failed Updated Order</div>';
          header("location:" . SITEURL . 'admin/manage-order.php');
        } 

      }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>