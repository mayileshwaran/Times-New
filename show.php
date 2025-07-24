<?php 
include('db.php'); 
include('auth.php'); 
if (!isset($_SESSION['user_id'])) {
    // redirect to login or set default name
    $username = "Guest";
} else {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT name FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close();
}
?>
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
?>
<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link rel="stylesheet" href="./css/show.css">
  <link rel="stylesheet" href="./css/nav.css">
<head>
  <title>Product List</title>
  
</head>
<body>
  <div class="navbar">
  <div class="left"><img src="./image/Time’s new.png" alt=""></div>

  
  <div class="right">
    <i class="fas fa-user-circle profile-icon"></i>
      <p class="text" style="color: white;">Hello, <?= htmlspecialchars($username) ?></p>
    <div class="dropdown">
      <a href="./orders.php">orders</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>


  <div class="center">
    <?php
    $type = $_GET['type'] ?? '';
if ($type) {
   $filter = "WHERE type = '$type'";
}
      // Adjust according to your URL parameters or logic
      if (isset($_GET['type'])) {
          echo htmlspecialchars($_GET['type']) . " Watches";
      } elseif (isset($_GET['brand'])) {
          echo htmlspecialchars($_GET['brand']) . " Watches";
      } else {
          echo "Our Watches";
      }
    ?>
  </div>


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
$statusFilter = "status = 'active'";
$sql = "SELECT * FROM products " . ($filter ? "$filter AND $statusFilter" : "WHERE $statusFilter");

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

        // ✅ Show Buy button only for non-admin users
        if (!isAdmin()) {
            echo "<div class='btn-buy'>Buy Now</div>";
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
}
 else {
    echo "<p>No products found.</p>";
}
?>
</div>
   <footer>
    <div class="foot-1">
             <img src="./image/Time’s new.png" alt="" width="200px">
             <p>Times New is a modern platform delivering fresh insights, trends, and updates across technology
                , lifestyle, and innovation.</p>
    </div>
    <div class="foot-2">
        <ul>
             <li><a href="./index.php" >HOME</a></li>
             <li><a href="./topbrands.php">TOP BRANDS</a></li>
             <li><a href="./about.php">ABOUT</a></li>
             <li> <a href="./contact.php">CONTACT</a></li></ul>
    </div>
    <div class="foot-3">
        <h3>Coffee with us</h3>
         <div class="fr"><i class="fa-solid fa-location-dot"></i> <p>Madurai</p></div>
         <div class="fr"><a href="tel:+91 9876543210" target="_blank"><i class="fa-solid fa-phone"></i> <span> 9876543210</span>
                    </a></div>
    </div>
   <div class="foot-4">
    <h3>Get into touch</h3>
    <div class="foot-4a">
   <a href="https://www.instagram.com/accounts/login/?hl=en" target="_blank"> <i class="fa-brands fa-square-instagram"></i></a>
    <a href="https://www.facebook.com/login/" target="_blank"><i class="fa-brands fa-square-facebook"></i></a>
  <a href="https://x.com/i/flow/login" target="_blank"><i class="fa-brands fa-square-x-twitter"></i></a>
  <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a></div></div>
    </footer>
<script src="./js/prod.js"></script>
  <script src="./js/nav.js"></script>

</body>
</html>
