<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    exit;
}

include('db.php');

if (!isset($_GET['id']) || !isset($_GET['quantity'])) {
    echo "Product ID or Quantity missing.";
    exit;
}

$id = (int)$_GET['id'];
$quantity = max(1, (int)$_GET['quantity']);

$res = $conn->query("SELECT * FROM products WHERE id = $id");
$row = $res->fetch_assoc();

if (!$row) {
    echo "Product not found.";
    exit;
}

if ($quantity > $row['quantity']) {
    echo "<h3 style='color:red;text-align:center;margin-top:30px'>
             Not enough stock available. Only <b>{$row['quantity']}</b> in stock.
          </h3>";
    exit;
}

$discounted = $row['price'] - ($row['price'] * $row['discount_percent'] / 100);
$final_price = round($discounted, 2);
$total = $final_price * $quantity;

$errors = [];
$name = $address = $city = $pin = $phone = $method = '';
$upi_id = $card_number = $expiry = $cvv = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $pin = trim($_POST['pin']);
    $phone = trim($_POST['phone']);
    $method = $_POST['method'] ?? '';

    if (empty($name)) $errors['name'] = "Name is required.";
    if (empty($address)) $errors['address'] = "Address is required.";
    if (empty($city)) $errors['city'] = "City is required.";
    if (!preg_match("/^\d{6}$/", $pin)) $errors['pin'] = "Valid 6-digit pin code required.";
    if (!preg_match("/^\d{10}$/", $phone)) $errors['phone'] = "Valid 10-digit phone required.";
    if (empty($method)) $errors['method'] = "Please select payment method.";

    // Validate UPI
    if ($method == 'upi') {
        $upi_id = trim($_POST['upi_id'] ?? '');
        if (!preg_match("/^[\w.-]+@[\w.-]+$/", $upi_id)) {
            $errors['upi_id'] = "Enter a valid UPI ID (e.g., name@upi).";
        }
    }

    // Validate Card
    if ($method == 'card') {
        $card_number = trim($_POST['card_number'] ?? '');
        $expiry = $_POST['expiry'] ?? '';
        $cvv = $_POST['cvv'] ?? '';

        if (!preg_match("/^\d{16}$/", $card_number)) {
            $errors['card_number'] = "Card number must be 16 digits.";
        }
        if (!preg_match("/^\d{3,4}$/", $cvv)) {
            $errors['cvv'] = "CVV must be 3 or 4 digits.";
        }

        if ($expiry) {
            $current = date('Y-m');
            if ($expiry < $current) {
                $errors['expiry'] = "Card has expired.";
            }
        } else {
            $errors['expiry'] = "Expiry date is required.";
        }
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO orders (payment_method, fullname, address, city, pincode, phone) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $method, $name, $address, $city, $pin, $phone);
        $stmt->execute();
        $stmt->close();

        $conn->query("UPDATE products SET quantity = quantity - $quantity WHERE id = $id");

        $days = rand(5, 10);
        $start = date('d M Y', strtotime("+$days days"));
        $end = date('d M Y', strtotime("+".($days + 2)." days"));

        echo "<script>
          alert('Your order is placed!\\nDelivery expected between $start and $end.');
          window.location.href = 'show.php';
        </script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/prod.css">
  <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
  <title>Payment</title>
</head>
<body>

<div class="payment-container">
  <h2><?= htmlspecialchars($row['name']) ?> - Checkout</h2>

  <?php if (!empty($row['image_path'])): ?>
    <img src="uploads/<?= $row['image_path'] ?>" alt="Product Image" class="product-preview">
  <?php endif; ?>

  <div class="price-section">
    <p>Quantity: <strong><?= $quantity ?></strong></p>
    <p>Unit Price: ₹<?= $final_price ?></p>
    <p><strong>Total: ₹<?= $total ?></strong></p>
  </div>

  <form method="post">
    <h3>Enter Address Details</h3>

    <div class="input-box">
      <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Name">
      <?php if (isset($errors['name'])) echo "<div class='error'>{$errors['name']}</div>"; ?>
    </div>

    <div class="input-box">
      <input type="text" name="address" value="<?= htmlspecialchars($address) ?>" placeholder="Address">
      <?php if (isset($errors['address'])) echo "<div class='error'>{$errors['address']}</div>"; ?>
    </div>

    <div class="input-box">
      <input type="text" name="city" value="<?= htmlspecialchars($city) ?>" placeholder="City">
      <?php if (isset($errors['city'])) echo "<div class='error'>{$errors['city']}</div>"; ?>
    </div>

    <div class="input-box">
      <input type="text" name="pin" value="<?= htmlspecialchars($pin) ?>" placeholder="Pin Code">
      <?php if (isset($errors['pin'])) echo "<div class='error'>{$errors['pin']}</div>"; ?>
    </div>

    <div class="input-box">
      <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>" placeholder="Phone Number">
      <?php if (isset($errors['phone'])) echo "<div class='error'>{$errors['phone']}</div>"; ?>
    </div>

    <h3>Select Payment Method:</h3>

    <label><input type="radio" name="method" value="upi" <?= ($method == 'upi') ? 'checked' : '' ?> onclick="showSection('upi')"> UPI</label><br>
    <label><input type="radio" name="method" value="card" <?= ($method == 'card') ? 'checked' : '' ?> onclick="showSection('card')"> Card</label><br>
    <label><input type="radio" name="method" value="Cash on Delivery" <?= ($method == 'Cash on Delivery') ? 'checked' : '' ?> onclick="showSection('Cash on Delivery')"> Cash on Delivery</label><br>
    <?php if (isset($errors['method'])) echo "<div class='error'>{$errors['method']}</div>"; ?>

    <!-- UPI -->
    <div id="upi" class="payment-section" style="display: <?= ($method == 'upi') ? 'block' : 'none' ?>;">
      <input type="text" name="upi_id" value="<?= htmlspecialchars($upi_id ?? '') ?>" placeholder="Enter your UPI ID">
      <?php if (isset($errors['upi_id'])) echo "<div class='error'>{$errors['upi_id']}</div>"; ?>
    </div>

    <!-- Card -->
    <div id="card" class="payment-section" style="display: <?= ($method == 'card') ? 'block' : 'none' ?>;">
      <input type="text" name="card_number" value="<?= htmlspecialchars($card_number ?? '') ?>" placeholder="Card Number">
      <?php if (isset($errors['card_number'])) echo "<div class='error'>{$errors['card_number']}</div>"; ?><br><br>

      <input type="month" name="expiry" value="<?= htmlspecialchars($expiry ?? '') ?>">
      <?php if (isset($errors['expiry'])) echo "<div class='error'>{$errors['expiry']}</div>"; ?><br><br>

      <input type="password" name="cvv" maxlength="4" placeholder="CVV">
      <?php if (isset($errors['cvv'])) echo "<div class='error'>{$errors['cvv']}</div>"; ?>
    </div>

    <!-- Cash on Delivery -->
    <div id="Cash on Delivery" class="payment-section" style="display: <?= ($method == 'Cash on Delivery') ? 'block' : 'none' ?>;">
      <p><i>No details needed for Cash on Delivery</i></p>
    </div>

    <br>
    <button type="submit" class="btn">Confirm Payment</button>
  </form>
</div>

<script>
function showSection(method) {
  document.getElementById('upi').style.display = 'none';
  document.getElementById('card').style.display = 'none';
  document.getElementById('Cash on Delivery').style.display = 'none';

  document.getElementById(method).style.display = 'block';
}
</script>

</body>
</html>
