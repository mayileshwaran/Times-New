<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch orders with product info
$sql = "SELECT 
            o.id AS order_id,
            o.product_id,
            o.quantity,
            o.price,
            o.payment_method,
            o.created_at,
            p.name AS product_name,
            p.image_path
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE o.user_id = ?
        ORDER BY o.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Your Orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/nav.css">
 <link rel="stylesheet" href="./css/order.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
  <div class="navbar">
  <div class="logo"><img src="./image/Time’s new.png" alt=""></div>
  <div class="center">Payment</div>
  <div class="right">
    <i class="fas fa-user-circle profile-icon"></i>
    <div class="dropdown">
      <a href="./index.php">Home</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</div>

<h2>Your Orders</h2>

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
        </div>
      </div>
    <?php endwhile; ?>
  </div>
<?php else: ?>
  <div class="no-orders">No orders found.</div>
<?php endif; ?>

</body>
</html>
