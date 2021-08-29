<?php include('partials/menu.php'); ?>

<!-- Main content start here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard page</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['login'])) {
            echo  $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br> <br>
        <div class="col-4 text-center">
            <?php
                $sql_categories = "SELECT * FROM tbl_category";
                $res_category   = mysqli_query($conn, $sql_categories);
                $count_category = mysqli_num_rows($res_category);
            ?>
            <b>Total Categories</b>
            <h1><?php echo $count_category;?></h1>
        </div>

        <div class="col-4 text-center">
            <?php
                $sql_clothes   = "SELECT * FROM tbl_clothes";
                $res_clothes   = mysqli_query($conn, $sql_clothes);
                $count_clothes = mysqli_num_rows($res_clothes);
            ?>
            <b>Total Clothes</b>
            <h1><?php echo $count_clothes;?></h1>
        </div>

        <div class="col-4 text-center">
            <?php
                $sql_order   = "SELECT * FROM tbl_order";
                $res_order   = mysqli_query($conn, $sql_order);
                $count_order = mysqli_num_rows($res_order);
            ?>
            <b>Total Orders</b>
            <h1><?php echo $count_order;?></h1>
        </div>

        <div class="col-4 text-center">
            <?php
                $sql_revenue   = "SELECT SUM(total) AS Total FROM tbl_order WHERE status= 'delivered'";
                $res_revenue   = mysqli_query($conn, $sql_revenue);
                $row_revenue   = mysqli_fetch_assoc($res_revenue);
                $total_revenue = $row_revenue['Total'];
            ?>
            <b>Revenue Generated</b>
            <h1><?php echo $total_revenue;?></h1>
        </div>

        <div class="clear-fix"></div>
    </div>
</div>
<!-- Main content  End here  -->

<?php include('partials/footer.php'); ?>