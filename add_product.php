<?php 
include('db.php'); 
include('auth.php'); 
if (!isAdmin()) die("Access denied"); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/addedit.css">
    <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
</head>
<body>

<div class="form-container">
  <h2>Add New Product</h2>

  <form method="post" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="Product Name" required>

    <select name="type" required>
      <option value="">Select Type</option>
      <?php foreach (['mens', 'womens', 'kids', 'boys', 'smart', 'couple'] as $type): ?>
        <option value="<?= $type ?>"><?= ucfirst($type) ?></option>
      <?php endforeach; ?>
    </select>

    <select name="brand" required>
      <option value="">Select Brand</option>
      <?php foreach (['rolex', 'omega', 'cartier', 'citizen'] as $brand): ?>
        <option value="<?= $brand ?>"><?= ucfirst($brand) ?></option>
      <?php endforeach; ?>
    </select>

    <input name="price" type="number" step="0.01" placeholder="Price (₹)" required>
    <input name="discount" type="number" value="0" placeholder="Discount %" required>
    <input name="quantity" type="number" placeholder="Quantity" min="1" required>

    <label class="upload-box">
      Upload Image
      <input type="file" name="image" accept="image/*" required>
    </label>

    <button type="submit" class="btn">Add Product</button>
  </form>
</div>

<?php
if ($_POST) {
    $name     = $_POST['name'];
    $type     = $_POST['type'];
    $brand    = $_POST['brand'];
    $price    = $_POST['price'];
    $discount = $_POST['discount'];
    $quantity = $_POST['quantity'];

    $imagePath = "";
    if ($_FILES['image']['error'] === 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imagePath = uniqid() . "." . strtolower($ext);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$imagePath");
    }

    $stmt = $conn->prepare("INSERT INTO products (name, type, brand, price, discount_percent, quantity, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdiis", $name, $type, $brand, $price, $discount, $quantity, $imagePath);
    $stmt->execute();

    echo "<script>alert(' Product added successfully'); window.location='show.php';</script>";
}
?>

</body>
</html>
