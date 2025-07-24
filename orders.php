<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
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
$user_id = $_SESSION['user_id'];

// Get user role
$role_sql = "SELECT role FROM users WHERE id = ?";
$role_stmt = $conn->prepare($role_sql);
$role_stmt->bind_param("i", $user_id);
$role_stmt->execute();
$role_result = $role_stmt->get_result();
$user = $role_result->fetch_assoc();
$is_admin = ($user && $user['role'] === 'admin');

// Fetch orders (all if admin, only user orders otherwise)
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
  <title>Your Orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/nav.css">
  <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/order.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<!-- Navbar -->
<div class="navbar">
  <div class="logo"><img src="./image/Time’s new.png" alt=""></div>
  <div class="center"><?= $is_admin ? 'All Orders' : 'Your Orders' ?></div>
  <div class="user-profile">
    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="dropdown">
        <i class="fa-solid fa-user-circle dropdown-toggle" onclick="toggleDropdown()" style="cursor:pointer;"></i>
          <p class="text" style="color: white;">Hello, <?= htmlspecialchars($username) ?></p>
        <div class="dropdown-menu" id="dropdownMenu" style="display: none; position: absolute; background: #fff; box-shadow: 0 0 5px rgba(0,0,0,0.2); padding: 10px;">
          <a href="orders.php">Your Orders</a><br>
          <a href="logout.php">Logout</a>
        </div>
        
      </div>
    <?php else: ?>
      <a href="login.php" class="login-btn">Login</a>
    <?php endif; ?>
  </div>
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

<script src="./js/nav.js"></script>
</body>
</html>
