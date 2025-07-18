
<?php 
include('db.php'); 
include('auth.php'); 
if (!isAdmin()) die("Access denied"); 

if (!isset($_GET['id'])) die("Product ID not provided.");

$id = $_GET['id'];

// Fetch existing product
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

if (!$product) die("Product not found.");

// Handle update on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = $_POST['name'];
    $type     = $_POST['type'];
    $brand    = $_POST['brand'];
    $price    = $_POST['price'];
    $discount = $_POST['discount'];
    $quantity = $_POST['quantity'];
    $imagePath = $product['image_path']; // default to old image

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $newImage = uniqid() . "." . strtolower($ext);
        $uploadPath = $uploadDir . $newImage;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            if (!empty($imagePath) && file_exists($uploadDir . $imagePath)) {
                unlink($uploadDir . $imagePath);
            }
            $imagePath = $newImage;
        } else {
            echo " Failed to upload new image.";
            exit;
        }
    }

    // Update product with quantity
    $stmt = $conn->prepare("UPDATE products SET name=?, price=?, discount_percent=?, type=?, brand=?, quantity=?, image_path=? WHERE id=?");
    $stmt->bind_param("sdsssisi", $name, $price, $discount, $type, $brand, $quantity, $imagePath, $id);
    $stmt->execute();

    echo "<script>alert(' Product updated successfully'); window.location='show.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Update Product</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./image/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="./css/addedit.css">
</head>
<body>

<div class="form-container">
  <h2>Update Product</h2>

  <form method="post" enctype="multipart/form-data">
    <input name="name" type="text" value="<?= htmlspecialchars($product['name']) ?>" required>

    <select name="type" required>
      <?php foreach (['mens', 'womens', 'kids', 'boys', 'smart', 'couple'] as $type): ?>
        <option value="<?= $type ?>" <?= $product['type'] === $type ? 'selected' : '' ?>><?= ucfirst($type) ?></option>
      <?php endforeach; ?>
    </select>

    <select name="brand" required>
      <?php foreach (['rolex', 'omega', 'cartier', 'citizen'] as $brand): ?>
        <option value="<?= $brand ?>" <?= $product['brand'] === $brand ? 'selected' : '' ?>><?= ucfirst($brand) ?></option>
      <?php endforeach; ?>
    </select>

    <input name="price" type="number" step="0.01" value="<?= $product['price'] ?>" required>
    <input name="discount" type="number" value="<?= $product['discount_percent'] ?>" required>
    <input name="quantity" type="number" min="0" value="<?= $product['quantity'] ?>" required>

    <div style="margin-bottom: 15px;">
      <strong>Current Image:</strong><br>
      <?php if ($product['image_path']): ?>
        <img src="uploads/<?= $product['image_path'] ?>" alt="Product Image" width="150">
      <?php else: ?>
        <p>No image available.</p>
      <?php endif; ?>
    </div>

    <label class="upload-box">
      Upload New Image
      <input type="file" name="image" accept="image/*">
    </label>

    <button type="submit" class="btn">Update Product</button>
  </form>
</div>

</body>
</html>
