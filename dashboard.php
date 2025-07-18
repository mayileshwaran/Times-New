<?php
include("db.php");

// Metric cards
$total_products = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];
$total_orders = $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];
$total_revenue = $conn->query("SELECT SUM(quantity * price) FROM orders")->fetch_row()[0];

// Daily sales chart data
$query = "
  SELECT DATE(created_at) AS sale_date, 
         SUM(quantity * price) AS total
  FROM orders
  GROUP BY DATE(created_at)
  ORDER BY sale_date ASC
";

$dates = [];
$earnings = [];

$result = $conn->query($query);
while ($row = $result->fetch_assoc()) {
    $dates[] = $row['sale_date'];
    $earnings[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/dash.css">
  <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="dashboard-container">
  <h1>Admin Dashboard</h1>

  <div class="card-container">
    <div class="card">
      <h3>Total Products</h3>
      <p><?= $total_products ?></p>
    </div>
    <div class="card">
      <h3>Total Orders</h3>
      <p><?= $total_orders ?></p>
    </div>
    <div class="card">
      <h3>Total Revenue (₹)</h3>
      <p><?= round($total_revenue, 2) ?></p>
    </div>
  </div>

  <div class="chart-section">
    <h2>Daily Revenue</h2>
    <canvas id="salesChart"></canvas>
  </div>
</div>
<div class="move">
    <div class="btn"><a href="./show.php">Move to see the product</a></div></div>


<script>
const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: <?= json_encode($dates) ?>,
    datasets: [{
      label: 'Revenue (₹)',
      data: <?= json_encode($earnings) ?>,
      backgroundColor: 'rgba(0, 123, 255, 0.2)',
      borderColor: '#007bff',
      borderWidth: 2,
      fill: true,
      tension: 0.4,
      pointRadius: 4
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>

</body>
</html>
