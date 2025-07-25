<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user info
$user_id = $_SESSION['user_id'];
$query = "SELECT name, role FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $role);
$stmt->fetch();
$stmt->close();

// Check if admin or superadmin
$is_admin = in_array($role, ['admin', 'superadmin']);

// Fetch orders (all if admin/superadmin, else only user orders)
$sql = "SELECT 
            o.id AS order_id,
            o.product_id,
            o.quantity,
            o.price,
            o.payment_method,
            o.created_at,
            o.user_id,
            p.name AS product_name,
            p.image_path,
            u.name AS user_name
        FROM orders o
        JOIN products p ON o.product_id = p.id
        JOIN users u ON o.user_id = u.id ";

if (!$is_admin) {
    $sql .= "WHERE o.user_id = ?";
}

$sql .= " ORDER BY o.created_at DESC";
$stmt = $conn->prepare($sql);

if ($is_admin) {
    $stmt->execute();
} else {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Time's New Your Orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/nav.css">
  <link rel="stylesheet" href="./css/order.css">
  <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="logo"><img src="./image/Time’s new.png" alt=""></div>
  <div class="center"><?= $is_admin ? 'All Orders' : 'Your Orders' ?></div>
  <div class="right">
    <i class="fas fa-user-circle profile-icon"></i>
    <p class="text" style="color: white;">Hello, <?= htmlspecialchars($username) ?></p>
    <div class="dropdown">
      <a href="./index.php">Home</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>

<div class="arrow">
  <button onclick="history.back()" class="btn-back"><i class="fa-solid fa-circle-arrow-left"></i> Go Back </button>
</div>

<h2><?= $is_admin ? 'All Orders Placed' : 'Your Orders' ?></h2>

<?php if ($result->num_rows > 0): ?>
  <div class="order-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="order-card">
        <img src="uploads/<?= htmlspecialchars($row['image_path']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
        <div class="order-info">
          <p><strong><?= htmlspecialchars($row['product_name']) ?></strong></p>
          <p>Qty: <?= $row['quantity'] ?></p>
          <p>₹<?= number_format($row['price'], 2) ?></p>
          <p>Method: <?= $row['payment_method'] ?></p>
          <p>Date: <?= date('d M Y, h:i A', strtotime($row['created_at'])) ?></p>
          <?php if ($is_admin): ?>
            <p>User: <?= htmlspecialchars($row['user_name']) ?> (ID: <?= $row['user_id'] ?>)</p>
          <?php endif; ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php else: ?>
  <div class="no-orders">No orders found.</div>
<?php endif; ?>

<footer>
  <div class="foot-1">
    <img src="./image/Time’s new.png" alt="" width="200px">
    <p>Times New is a modern platform delivering fresh insights, trends, and updates across technology, lifestyle, and innovation.</p>
  </div>
  <div class="foot-2">
    <ul>
      <li><a href="./index.php">HOME</a></li>
      <li><a href="./topbrands.php">TOP BRANDS</a></li>
      <li><a href="./about.php">ABOUT</a></li>
      <li><a href="./contact.php">CONTACT</a></li>
    </ul>
  </div>
  <div class="foot-3">
    <h3>Coffee with us</h3>
    <div class="fr"><i class="fa-solid fa-location-dot"></i> <p>Madurai</p></div>
    <div class="fr"><a href="tel:+91 9876543210" target="_blank"><i class="fa-solid fa-phone"></i> <span>9876543210</span></a></div>
  </div>
  <div class="foot-4">
    <h3>Get into touch</h3>
    <div class="foot-4a">
      <a href="https://www.instagram.com/accounts/login/?hl=en" target="_blank"><i class="fa-brands fa-square-instagram"></i></a>
      <a href="https://www.facebook.com/login/" target="_blank"><i class="fa-brands fa-square-facebook"></i></a>
      <a href="https://x.com/i/flow/login" target="_blank"><i class="fa-brands fa-square-x-twitter"></i></a>
      <a href="https://www.youtube.com/" target="_blank"><i class="fa-brands fa-youtube"></i></a>
    </div>
  </div>
  <div class="copy"><p>All rights reserved © 2025</p></div>
</footer>

<script src="./js/nav.js"></script>
</body>
</html>
