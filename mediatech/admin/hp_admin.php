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
    <link rel="stylesheet" href="../css/style.css" />
    <!-- end css file -->
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-3E31Tp1gs6z+yYX9GUBd6d1s6UqyJ2uvfieHI8W+QtMgmyzDZMOpFmXWEClCnFji" crossorigin="anonymous">
    <title>Mediatech</title>
  </head>
  <body>

  <?php
include "header_admin.php";
?>

    <!-- start section 1 -->
    <section id="section1">
<div class="kk">
    <div class="backgroundInfo">
        <p>It's chapteron</p>
        <h1>We love literature</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid voluptate inventore quas, laborum optio reprehenderit praesentium praesentium </p>
        <a href="#section2"><button>Discover More</button></a>
    </div>
    <div>
    <img src="../images/bg.png" alt="" class="bg">
</div>
</div>
    </section>
    <!-- end section 1 -->
    <!-- start section 2 -->
    <section id="section2" class="section2">
      <div id="searchparent">
        <div>
        <ul>
   <a href="hp_admin.php?product_type=All"> <li>All</li></a>
    <a href="hp_admin.php?product_type=Books"><li>Books</li></a>
    <a href="hp_admin.php?product_type=Novels"><li>Novels</li></a>
    <a href="hp_admin.php?product_type=Magazines"><li>Magazines</li></a>
    <a href="hp_admin.php?product_type=Cassettes"><li>Cassettes</li></a>
   <a href="hp_admin.php?product_type=CDs"> <li>CDs</li></a>
    <a href="hp_admin.php?product_type=DVD"><li>DVD</li></a>
  </ul>
</div>
<form method="get" action="hp_admin.php">
  <div class="searchChild">
    <img src="../images/magnifying-glass-solid.svg" alt="" class="searchIcon">
    <input type="search" name="q" id="search" placeholder="Search for a book or author" value="<?php echo htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES); ?>">
    <button type="submit" class="searchBtn">Search</button>
  </div>
</form>
</div>
<div id="productCards">
  <?php
// Get the search query from the URL parameter
$search_query = isset($_GET['q']) ? $_GET['q'] : '';

if ($search_query == '') {
    $category = isset($_GET['product_type']) ? $_GET['product_type'] : 'All'; // Get the selected category from the URL parameter or set it to "All" if not specified
    // Construct the SQL query based on the selected category
    if ($category == 'All') {
        $sql = "SELECT * FROM products";
    } else {
        $sql = "SELECT * FROM products WHERE product_type = '$category'";
    }

    $items = $pdo->query($sql); // Execute the query to retrieve the items
} else {
    $sql = "SELECT * FROM products WHERE product_title LIKE :search_query OR product_author LIKE :search_query";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':search_query', '%' . $search_query . '%');
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($items)) {
        echo "<p>No products found.</p>";
    }
}

if (!empty($items)) {
    foreach($items AS $item){
?>
<div class="product">
<!-- <a href="../detail.php?product_id=<?= $item['product_id']; ?>"> -->
    <div class="overlayout">Reserve Now</div>
    <div><img src=".<?= $item['product_cover_image']; ?>" alt="product"></div>
    <div>
      <p><?= $item['product_author']; ?></p>
      <p><?= $item['product_title']; ?></p>
    </div>
  <!-- </a> -->
</div>
<?php
}}
?>

</div>
    </section>
    <!-- end section 2 -->
    <footer>
     <p> Copyright © 2023  All Rights Reserved. - Bassam Salik</p>
    </footer>
  </body>
  <script src="../js/homepage.js"></script>
</html>
