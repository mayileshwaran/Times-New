<?php
include('db.php');

// Fetch all queries from the table
$result = $conn->query("SELECT * FROM query ORDER BY created_at DESC");
?>
<?php
include('./auth.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Queries</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/nav.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="./css/query.css">
</head>
<body>

<div class="navbar">
    <div class="logo">
        <img src="./image/Time’s new.png" alt="Logo">
    </div>
    <div class="center">Customer Queries</div>
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

<div class="container">
    <h2>All Queries</h2>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="query-card">
                <h3><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['phone']) ?>)</h3>
                <p>Email: <?= htmlspecialchars($row['email']) ?></p>
                <p><strong>Message:</strong><br><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                <div class="timestamp"><?= date('d M Y, h:i A', strtotime($row['created_at'])) ?></div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No queries found.</p>
    <?php endif; ?>
</div>

</body>
</html>
