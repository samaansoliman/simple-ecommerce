<?php 
    // 1. First We Include Constants To Connecting With Database and Session Start
    include('../config/constants.php');


    // 2. We Need Remove The Category And Image OF Category  From Our Application And Database So we Must be Check If The Id And Image Are Set In Our Add And Database Or Not
    if(isset($_GET['id']) AND isset($_GET['image_name'])){
      // Make Thing It Mean Get The Value And Delete It
      //echo 'We Are Right The Data You Need Is Set You Can Remove It Now';
      $id          =  $_GET['id'];
      $image_name  =  $_GET['image_name'];
      
      // Check if The image Available  Remove The Image If Is It Available
      if($image_name !=""){
        // Image Is Available So Remove it
        $path   = "../images/category/".$image_name;
        $remove = unlink($path);
        // If Failed To Remove the Image Make Error Msg And Stop The Process
        if($remove==false){
          // Set The Session Stop && Redirect Page Manage Category
          $_SESSION['remove'] = '<div class="error-msg">Failed To Remove this Category Image</div>';
          header("location:" .SITEURL.'admin/manage-category.php');
          die();
        }
      } 

      // Make SQl Query To Delete The Data from Our DataBase 
      $sql = "DELETE FROM tbl_category WHERE id = $id";
      $res = mysqli_query($conn, $sql);

      if($res==true){
         // Success Msg In Our Page Of Category After The Query Successfully
         $_SESSION['delete'] = '<div class="success-msg">Category Deleted successfully</div>';
         header("location:" .SITEURL.'admin/manage-category.php'); 
      }else{
         // Error Msg In Our Page Of Category After The Query Failed To Delete
         $_SESSION['delete'] = '<div class="error-msg">Failed To Deleted this Category</div>';
         header("location:" .SITEURL.'admin/manage-category.php');
      }

  } else {
  // Make Thing It Mean We Not Have The Value And Redirect To Category Page
  header("location:" .SITEURL.'admin/manage-category.php'); 
} 

?>



