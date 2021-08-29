<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Clothes Page</h1>
    <br> <br>
    <?php 
    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <table class="table-add">
        <tr>
          <td>Title:-</td>
          <td><input type="text" name="title" placeholder="write Your Clothes"/></td>
        </tr>
          
        <tr>
          <td>Description:-</td>
          <td><textarea name="description" cols="30" rows="5" placeholder="Write Description"></textarea></td>
        </tr>
          
        <tr>
          <td>Price:-</td>
          <td><input type="number" name="price" placeholder="Write The Price"</td>
        </tr>
          
        <tr>
          <td>Select Image:-</td>
          <td><input type="file" name="image" /></td>
        </tr>
          
        <tr>
          <td>Category:-</td>
          <td>
            <select name="category">
              <?php 
                // Create php Code To Display All Category From Database

                // 1. Create SQl To Get All only Active Categories From Database
                $sql   = "SELECT * FROM tbl_category WHERE active = 'yes'";
                // Execute The Query
                $res   = mysqli_query($conn, $sql);
                // Count Rows To Check We Are Have Categories or Not
                $count = mysqli_num_rows($res);
                // Check If Count = 1 We are Have Categories Else We Are Have not Categories
                if($count>0){
                  // We Are Have Categories And Show It In While Loop
                  while($row = mysqli_fetch_assoc($res)){
                    // In this the While loop we will Get the Data
                    $id    =  $row['id'];
                    $title =  $row['title'];
                ?>
                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                <?php
                  }
                }else{
                  // we Are Have Not Categories
              ?>
                <option value="0">No Categories Found</option>
              <?php
            }
                // 2. Display The Dropdown To Show The Category 
              ?>
            </select>
          </td>
        </tr>
          
        <td>Featured:-</td>
          <td>
            <input type="radio"  name="featured" value="yes" /> yes
            <input type="radio"  name="featured" value="no" /> no
          </td>
        </tr>

        <tr>
          <td>Active:-</td>
          <td>
            <input type="radio" name="active" value="yes"/> yes
            <input type="radio" name="active" value="no"/> no
          </td>
        </tr>

        <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Add Clothes" class="btn-secondary">
            </td>
        </tr>
      </table>
    </form> 
<?php
    // 1. check If submit Button Work or Not
    if(isset($_POST['submit'])){
      //echo 'You Are Right The Button of Submit Is Working Now You Can Add The Clothes In Database';

      // 2. Get The Value From The Form
      $title       =  $_POST['title'];  
      $description =  $_POST['description'];  
      $price       =  $_POST['price'];  
      $category    =  $_POST['category'];
      if(isset($_POST['featured'])){
        $featured = $_POST['featured'];
      } else{
        // Set the Default Value
        $featured = "No";
      }
    
      if(isset($_POST['active'])){
        $active = $_POST['active'];
      } else{
        // Set the Default Value
        $active = "No";
      }  

      // 3. Upload The image If The The Image Is Selected 
      if(isset($_FILES['image']['name'])){
        // Get The Details Of The Image Selected
        $image_name = $_FILES['image']['name'];
        if($image_name !=""){  // Look to the Under Line
          // This Last Condition To Check Upload Image Only Selected Or Not !important Understand //
          $ext              = end(explode('.', $image_name)); // This code To Change The Extension Image
          $image_name       = "clothes_name_".rand(0000,9999).'.'.$ext; //This Code To Change The Name Image
          $source_path      = $_FILES['image']['tmp_name']; 
          $destination_path = "../images/clothes/".$image_name;
          $upload           = move_uploaded_file($source_path, $destination_path);
          if($upload == false){
            $_SESSION['upload'] = "<div class='error-msg'>Failed To Upload The Image.</div>";
            header("location:".SITEURL.'admin/add-clothes.php');
            die();
          }
        }
      }else{
        // Set The Default Value
        $image_name = "";
      }

      // 4. Insert The Clothes Information In Database
      // Remember!! For Numerical we don`t Need To '' Such as Price And category_Id But For The String we Need ''
      $sql2       = "INSERT INTO tbl_clothes SET
      title       = '$title',
      description = '$description',
      price       =  $price,
      image_name  = '$image_name',
      category_id =  $category,
      featured    = '$featured',
      active      = '$active' 
      ";
    
    // Execute The Query 
    $res2  =  mysqli_query($conn, $sql2);
    
    if($res2 == true){
      // Create SomeThing == Add the Data Successfully
      $_SESSION['add-clothes'] = '<div class="success-msg">The Clothes Added Successfully</div>';
      header("location:" .SITEURL.'admin/manage-clothes.php');
    }else{
      // Create Something == Failed To Add the Data
      $_SESSION['add-clothes'] = '<div class="error-msg">Failed To Add The Data Of Clothes </div>';
      header("location: ".SITEURL.'admin/manage-clothes.php');
    }

  }
?>
  </div>
</div>

<?php include('partials/footer.php'); ?>