<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <!-- Important to make website responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Clothes Hose</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="stylesheet" href="css/normalize.css" />
  <!-- Link our CSS file -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  
  <!-- Start landing page -->
  <div class="landing-page">
    <div class="overlay"></div>
    <div class="header-area">
      <div class="logo">Dokany.com</div>
      <ul class="links">
        <li><a href="<?php echo SITEURL ;?>">Home</a></li>
        <li><a href="<?php echo SITEURL ;?>categories.php">Categories</a></li>
        <!-- <li><a href="category-clothes.php">Categories-Clothes</a></li> -->
        <li><a href="<?php echo SITEURL ;?>clothes.php">Clothes</a></li>
        <li><a href="contact.php">Contact</a></li>
        <!-- <li><a href="admin/login.php">Login</a></li> -->
      </ul>
    </div>
    <div class="introduction-text">
      <h1>We Are <span>Dokany.com</span> Website</h1>
      <p>
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Culpa,
        provident? Pariatur beatae odio sint sed consequatur id velit deleniti
        quisquam quidem necessitatibus quasi, alias eveniet.
      </p>
    </div>
  </div>
  <!-- End landing page -->