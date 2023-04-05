<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500&family=Open+Sans:ital,wght@0,400;0,500;0,600;1,600&display=swap"
      rel="stylesheet"
    />
    <!-- end google font -->
  <!-- start boostrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<!-- end boostrap -->
    <!-- css file -->
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/style.css">
    <!-- end css file -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-X9z+0H56JbhTzSjge0w+O/YtwBQ/2cR70Muh+8W/hXwhOdtzj3qJNzwweJYRZfxuwbtCu+bUGIwKInDZp/NnLg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Mediatech</title>
  </head>
<body>
<?php
include "header_admin.php";
?>
    <section id="adminSection">
<h1>Here is the Admin options :</h1>
        <div id="adminSectionCards">
          <div class="adminSectionProfile">
            <div><a href="./adminMData.php "><img src="../images/admin1.jpg" alt="product"></a></div>
            <div class="Cinfo">
              <p><b>Manage data in The Website</b></p>
            </div>
          </div>
          <div class="adminSectionProfile">
            <div><a href="./adminMusers.php"><img src="../images/admin2.jpg" alt="product"></a></div>
            <div class="Cinfo"> 
              <p><b>Manage Users And Reservation</b></p>
            </div>
          </div>
          <div class="adminSectionProfile">
            <div><a href="./archive.php "><img src="../images/viktor-talashuk-05HLFQu8bFw-unsplash.jpg" alt="product"></a></div>
            <div class="Cinfo">
              <p><b>Archive (Reservations , Borrowins)</b></p>
            </div>
          </div>
          </div>
</section>

<footer>
  <p> Copyright © 2023  All Rights Reserved. - Bassam Salik</p>
 </footer>
</body>