<?php 
require '../dbconnect.php'; // Include file for database connection

// Check if the form was submitted
if(isset($_POST["addBtn"])){

  // Get the form data
  $product_title = $_POST['product_title'];
  $product_author = $_POST['product_author'];
  $language = $_POST['Language'];
  $num_pages = $_POST['Npages'];
  $product_condition = $_POST['ProductCondition'];
  $product_edition_date =date('Y-m-d');
  $product_type = $_POST['typeaadd'];
  $description = $_POST['description'];
  $image_path = "./images/" . $_FILES['image']['name'];

  // Save the uploaded image to a directory on the server
  if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    // Save the uploaded image to a directory on the server
    move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
  }

  // Insert the data into the database
  $stmt = $pdo->prepare("INSERT INTO products (product_title, product_author, langue, numPages, product_condition,product_edition_date,product_type, description, product_cover_image) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?)");
  $stmt->bindParam(1, $product_title);
  $stmt->bindParam(2, $product_author);
  $stmt->bindParam(3, $language);
  $stmt->bindParam(4, $num_pages);
  $stmt->bindParam(5, $product_condition);
  $stmt->bindParam(6, $product_edition_date);
  $stmt->bindParam(7, $product_type);
  $stmt->bindParam(8, $description);
  $stmt->bindParam(9, $image_path);

  // Execute the statement
  $stmt->execute();
}
?>


<!-- ///////////////////////////////// -->




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
    <link rel="stylesheet" href="../css/adminMData.css" />
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
      <div id="lineParent">
        <h1>All Products</h1>
        <hr class="line">
    </div>
    <!-- add item modal -->
      <div class="modal modal-lg fade" id="addannounce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content h-25">
            <div class="modal-body container p-5">
              <form method="POST" action="adminMData.php" id="myFormadd" enctype="multipart/form-data">
                <h2 class="text-center">Add a Product</h2>
                <div class=" d-flex flex-column gap-3">
                  <div class="formvalid">
                  <div class="d-flex gap-2 flex-wrap m-3 ">
                    <div class="d-flex flex-wrap gap-3" id="images">
                    </div>
                    <div class="rectangle">
                      <input type="file" name="image" class="form-control">
                    </div>
                  </div>
                  <small></small>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="titleAdd" class="form-label">Title</label>
                      <input type="text" name="product_title" class="form-control" id="titleAdd" placeholder="Title" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="product_author" class="form-label">Author's Name</label>
                      <input type="text" min="0" name="product_author" class="form-control" id="product_author" placeholder="Joan Smith" />
                      <small></small>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="Npages" class="form-label">N° of pages</label>
                      <input type="number" name="Npages" class="form-control" id="Npages" placeholder="243" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="ProductCondition" class="form-label">Product Condition</label>
                      <select class="form-select" name="ProductCondition" id="ProductCondition">
                        <option selected disabled>Choose one</option>
                        <option value="New">New</option>
                        <option value="Good">Good</option>
                        <option value="Acceptable">Acceptable</option>
                        <option value="Good">quite worn</option>
                        <option value="Torn">Torn</option>
                      </select>
                      <small></small>
                    </div>
                  </div>
                  <div class="d-flex gap-3">
                    <div class="w-50 formvalid">
                      <label for="Language" class="form-label">Language</label>
                      <input type="text" name="Language" class="form-control" id="Language" placeholder="English" />
                      <small></small>
                    </div>
                    <div class="w-50 formvalid">
                      <label for="typeadd" class="form-label">Type</label>
                      <select class="form-select" name="typeaadd" id="typeaadd">
                        <option selected disabled>Choose one</option>
                        <option value="All">All</option>
                        <option value="Novels">Novels</option>
                        <option value="Magazines">Magazines</option>
                        <option value="Cassettes">Cassettes</option>
                        <option value="CDs">CDs</option>
                        <option value="DVD">DVD</option>
                      </select>
                      <small></small>
                    </div>
                  </div>
                  <div class="formvalid">
                    <label for="descriptionadd" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="descriptionadd" rows="3"></textarea>
                    <small></small>
                  </div>
                  <div class="justify-content-end d-flex">
                    <button name="addBtn" type="submit" class="btn bg-dark text-white" id="addBtn">Ajouter</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    <!-- Delete confirmation modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this product?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><span id="product-name"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <form method="POST" action="delete.php">
          <input type="hidden" name="delete" value="" id="delete-product-id">
          <button type="submit" class="btn btn-danger" id="delete-confirm">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
<section id="section2" class="section2">
  <div id="searchparent">
    <div>
    <ul>
   <a href="adminMData.php?product_type=All"> <li>All</li></a>
    <a href="adminMData.php?product_type=Books"><li>Books</li></a>
    <a href="adminMData.php?product_type=Novels"><li>Novels</li></a>
    <a href="adminMData.php?product_type=Magazines"><li>Magazines</li></a>
    <a href="adminMData.php?product_type=Cassettes"><li>Cassettes</li></a>
   <a href="adminMData.php?product_type=CDs"> <li>CDs</li></a>
    <a href="adminMData.php?product_type=DVD"><li>DVD</li></a>
  </ul>
</div>
<form method="get" action="adminMData.php">
  <div class="searchChild">
    <img src="../images/magnifying-glass-solid.svg" alt="" class="searchIcon">
    <input type="search" name="q" id="search" placeholder="Search for a book or author" value="<?php echo htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES); ?>">
    <button type="submit" class="searchBtn">Search</button>
  </div>
</form>
</div>
<div id="productCards">
<button type="button" class="add_item_btn" data-bs-target="#addannounce" data-bs-toggle="modal">+ Add a Product</button>
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
  <div><img src=".<?= $item['product_cover_image']; ?>" alt="product"></div>
  <div>
    <p><?= $item['product_author']; ?></p>
    <p class="title"><?= $item['product_title']; ?></p>
    <div class="icons">
      <img src="../images/trash-solid.svg" class="delete-product" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $item['product_id']; ?>">
      <img src="../images/pen-to-square-solid.svg" data-bs-target="#updateproduct" data-bs-toggle="modal" >
    </div>
  </div>
</div>



<!-- update modal -->
<div class="modal modal-lg fade" id="updateproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content h-25">
      <div class="modal-body container p-5">
        <form action="update.php" method="POST" id="myFormUpdate" enctype="multipart/form-data">
          <h2 class="text-center">Update Product</h2>
          <div class=" d-flex flex-column gap-3">
            <div class="formvalid">
              <div class="d-flex gap-2 flex-wrap m-3">
                <div class="d-flex flex-wrap gap-3" id="update-images">
                  <!-- Existing images will be displayed here -->
                </div>
                <div class="rectangle">
                  <input id="update-image-input" name="product_cover_image" type="file" multiple class="form-control">
                </div>
              </div>
              <small></small>
            </div>
            <div class="d-flex gap-3">
              <div class="w-50 formvalid">
                <label for="update-product-title" class="form-label">Title</label>
                <input type="text" name="product_title" class="form-control" id="update-product-title" placeholder="Title" />
                <small></small>
              </div>
              <div class="w-50 formvalid">
                <label for="update-product-author" class="form-label">Author's Name</label>
                <input type="text" name="product_author" class="form-control" id="update-product-author" placeholder="Author's Name" />
                <small></small>
              </div>
            </div>
            <div class="d-flex gap-3">
              <div class="w-50 formvalid">
                <label for="update-numPages" class="form-label">N° of pages</label>
                <input type="number" name="numPages" class="form-control" id="update-numPages" placeholder="243" />
                <small></small>
              </div>
              <div class="w-50 formvalid">
                <label for="update-product-condition" class="form-label">Product Condition</label>
                <select class="form-select" name="product_condition" id="update-product-condition">
                  <option selected disabled>Choose one</option>
                  <option value="Location">Location</option>
                  <option value="Vente">Vente</option>
                </select>
                <small></small>
              </div>
            </div>
            <div class="d-flex gap-3">
              <div class="w-50 formvalid">
                <label for="update-langue" class="form-label">Language</label>
                <input type="text" name="langue" class="form-control" id="update-langue" placeholder="English" />
                <small></small>
              </div>
              <div class="w-50 formvalid">
                <label for="update-product-type" class="form-label">Type</label>
                <select class="form-select" name="product_type" id="update-product-type">
                  <option selected disabled>Choose one</option>
                  <option value="appartement">appartement</option>
                  <option value="maison">maison</option>
                  <option value="villa">villa</option>
                </select>
                <small></small>
              </div>
            </div>
            <div class="formvalid">
  <label for="descriptionadd" class="form-label">Description</label>
  <textarea class="form-control" name="description" id="descriptionadd" rows="3" required></textarea>
  <small></small>
</div>
<div class="justify-content-end d-flex">
<input type="hidden" name="product_id" value="<?= $item['product_id']; ?>">
  <button value="addBtn" type="submit" class="btn bg-dark text-white" id="addBtn">Update</button>
</div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

<?php
    }}
    ?>
      </section>
      <footer>
        <p> Copyright © 2023  All Rights Reserved. - Bassam Salik</p>
       </footer>
<script src="../js/adminMdata.js"></script>
<script src="../js/homepage.js"></script>
</body>