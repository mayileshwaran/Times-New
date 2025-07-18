<?php 
include('db.php'); 
include('auth.php'); 
?>
<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/show.css">
<head>
  <title>Product List</title>
  
</head>
<body>

<h2>Products</h2>


<!-- Product Cards -->
<div class="product-grid">
  <?php if (isAdmin()): ?>
    <div class="product-card">
      <i class="bi bi-plus-lg"></i>
      <form action="add_product.php" method="get">
        <button type="submit" class="btn-add">Add New Product</button>
      </form>
    </div>
  <?php endif; ?>



  <?php
$filter = "";
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $filter = "WHERE type = '$type'";
} elseif (isset($_GET['brand'])) {
    $brand = $_GET['brand'];
    $filter = "WHERE brand = '$brand'";
}

$sql = "SELECT * FROM products $filter";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $discounted = $row['price'] - ($row['price'] * $row['discount_percent'] / 100);
        
        echo "<div class='product-card' onclick=\"window.location='view_product.php?id={$row['id']}'\">";

        // Product Image
        if (!empty($row['image_path'])) {
            echo "<img src='uploads/{$row['image_path']}' alt='Product Image'>";
        } else {
            echo "<div class='no-image'>No Image</div>";
        }

        // Product Info
        echo "<h3>" . htmlspecialchars($row['name']) . "</h3><hr>";
        echo "<p>Type: " . htmlspecialchars($row['type']) . "</p>";
        echo "<p>Brand: " . htmlspecialchars($row['brand']) . "</p>";

        // Price
        if ($row['discount_percent'] > 0) {
            echo "<p class='price'><s>₹" . $row['price'] . "</s> ₹" . number_format($discounted, 2) . "</p>";
        } else {
            echo "<p class='price'>₹" . $row['price'] . "</p>";
        }

        // Admin Buttons inside the card
        if (isAdmin()) {
            echo "<div class='admin-controls'>";
            echo "<button class='btn' onclick=\"event.stopPropagation(); window.location='update_product.php?id={$row['id']}'\">Edit</button>";
            echo "<button class='btndelete' onclick=\"event.stopPropagation(); confirmDelete('delete_product.php?id={$row['id']}')\">Delete</button>";
            echo "</div>";
        }

        echo "</div>"; // End of .product-card
    }
} else {
    echo "<p>No products found.</p>";
}
?>
</div>
<script src="./js/prod.js"></script>
</body>
</html>
