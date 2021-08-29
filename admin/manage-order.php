<?php include('partials/menu.php'); ?>

<!-- Main content start here -->
<div class="main-content">
        <div class="wrapper">
            <h1>Manage Order Page</h1>
            <?php
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
                <table class="table-full">
                    <tr>
                        <th>ID</th>
                        <th>Clothes</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                        $serial_number = 1 ;
                        // 1. write code Sql to det all the data from database
                        $sql  = "SELECT * FROM tbl_order ORDER BY id DESC"; // Display Latest Order At First
                        // 2. Execute The  Query
                        $res  = mysqli_query($conn, $sql);
                        // 3. count the Row
                        $count= mysqli_num_rows($res);
                        // 4. Check if The Count > 0 Get the Data order
                        if($count > 0){
                            // A. We are Have Data Order So we will Show It Now In while loop
                            while($row  =  mysqli_fetch_assoc($res)){
                                $id               = $row['id'];
                                $clothes          = $row['clothes'];
                                $price            = $row['price'];
                                $qty              = $row['qty'];
                                $total            = $row['total'];
                                $status           = $row['status'];
                                $order_date       = $row['order_date'];
                                $customer_name    = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email   = $row['customer_email'];
                                $customer_address = $row['customer_address'];

                                ?>
                                <!-- Start the Order table to add order inside while loop -->
                                <tr>
                                    <td><?php echo $serial_number++; ?></td>
                                    <td><?php echo $clothes; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td>
                                        <?php
                                            if($status=="ordered"){
                                                echo "<label style='color:black;'>ORDERED</label>";
                                        } elseif ($status=="on delivery"){
                                                echo "<label style='color:orange;'>ON DELIVERY</label>";
                                        } elseif($status=="delivered"){
                                                echo "<label style='color:green;'>DELIVERED</label>";
                                        } elseif($status=="cancelled"){
                                                echo "<label style='color:red;'>CANCELLED</label>";
                                        } 
                                         ?>
                                    </td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id?>" class="btn-secondary">Update Order</a> 
                                    </td>
                                </tr>
                                <!-- Start the Order table to add order inside while loop -->
                                <?php
                            }
                        } else {
                            // B. We don`t Have Data So We Will Echo Error msg 
                            echo "<div class='error-msg'>We don`t Have Data So We Can`t Show It</div>"; 
                        }
                    ?>
                </table>
        </div>
    </div>
<!-- Main content  End here  -->

<?php include('partials/footer.php'); ?>








                                