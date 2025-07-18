<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
include('db.php');

if (!isset($_GET['id'])) {
    echo "Product ID missing.";
    exit;
}

$id = (int) $_GET['id'];
$res = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $res->fetch_assoc();

if (!$product) {
    echo "Product not found.";
    exit;
}

$discounted = $product['price'] - ($product['price'] * $product['discount_percent'] / 100);
$final_price = round($discounted, 2);

// Fetch 4 random other products
$randoms = $conn->query("SELECT * FROM products WHERE id != $id ORDER BY RAND() LIMIT 4");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Product</title>
  <link rel="stylesheet" href="./css/prod.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
</head>
<body>

<div class="view-product-container">
  <div class="main-product">
    <?php if (!empty($product['image_path'])): ?>
      <img src="uploads/<?= $product['image_path'] ?>" alt="Product Image" class="product-image">
    <?php else: ?>
      <div class="no-image">No image available</div>
    <?php endif; ?>
  </div>

  <div class="product-details">
    <h2><?= htmlspecialchars($product['name']) ?></h2> <hr>
    <p><strong>Brand:</strong> <?= $product['brand'] ?></p>
    <p><strong>Type:</strong> <?= $product['type'] ?> Watch</p>

    <?php if ($product['discount_percent'] > 0): ?>
      <p><s>₹<?= $product['price'] ?></s><br> - <?= $product['discount_percent'] ?>% off</p>
      <p><strong>Discounted Price: ₹<?= $final_price ?></strong></p>
    <?php else: ?>
      <p><strong>Price: ₹<?= $product['price'] ?></strong></p>
    <?php endif; ?>

    <!-- Quantity and Buy Now -->
    <form action="payment.php" method="get">
      <input type="hidden" name="id" value="<?= $product['id'] ?>">
      <label>Quantity:</label>
      <input type="number" name="quantity" value="1" min="1" required> <br><br>
      <button type="submit" class="btn">Buy Now</button>
    </form>
  </div>
</div>

<!-- Related Products -->
<h3>Related Products</h3>
<div class="related-section">
  <div class="related-grid">
    <?php while ($r = $randoms->fetch_assoc()): 
      $r_discount = $r['price'] - ($r['price'] * $r['discount_percent'] / 100);
    ?>
      <!-- Wrap the whole card in <a> -->
      <a href="view_product.php?id=<?= $r['id'] ?>" class="related-card-link">
        <div class="related-card">
          <?php if (!empty($r['image_path'])): ?>
            <img src="uploads/<?= $r['image_path'] ?>" alt="Product" class="related-img">
          <?php else: ?>
            <div class="no-image">No image</div>
          <?php endif; ?>
          <h4><?= htmlspecialchars($r['name']) ?></h4>
          <p><strong>₹<?= round($r_discount, 2) ?></strong></p>
        </div>
      </a>
    <?php endwhile; ?>
  </div>
</div>


</body>
</html>
