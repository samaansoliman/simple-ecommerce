<?php 

include('../config/constants.php');

// We Need Remove The Category And Image OF Category  From Our Application And Database So we Must be Check If The Id And Image Are Set In Our Add And Database Or Not

  if(isset($_GET['id']) && isset($_GET['image_name'])){
    // Make The Delete Process
    //echo 'We Are Right The Data You Need Is Set You Can Remove It Now';

    //1. Get The Date of Image name And ID
    $id          =  $_GET['id'];
    $image_name  =  $_GET['image_name'];

    // Check if The image Available  Remove The Image If Is It Available
    if($image_name !=""){
      // Image Is Available So Remove it From The Folder
      $path   = "../images/clothes/".$image_name;
      $remove = unlink($path);
      // If Failed To Remove the Image Make Error Msg And Stop The Process
      if($remove==false){
        // Set The Session Stop && Redirect Page Manage Category
        $_SESSION['upload'] = '<div class="error-msg">Failed To Remove this clothes Image File.</div>';
        header("location:" .SITEURL.'admin/manage-clothes.php');
        die();
      }
    } 

    // Make SQl Query To Delete The Data from Our DataBase 
    $sql = "DELETE FROM tbl_clothes WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res==true){
      // Success Msg In Our Page Of Category After The Query Successfully
      $_SESSION['delete'] = '<div class="success-msg">clothes Deleted successfully</div>';
      header("location:" .SITEURL.'admin/manage-clothes.php'); 
   }else{
      // Error Msg In Our Page Of Category After The Query Failed To Delete
      $_SESSION['delete'] = '<div class="error-msg">Failed To Delete Clothes</div>';
      header("location:" .SITEURL.'admin/manage-clothes.php');
   }
} else{
    // Make Thing It Mean We Not Have The Value And Redirect To clothes Page
    $_SESSION['un-found'] = "<div class='error-msg'>Failed To Found this clothes</div>";
    header("location:" .SITEURL.'admin/manage-clothes.php'); 
}
