<?php include('db.php'); include('auth.php'); if (!isAdmin()) die("Access denied"); ?>
<?php
$id = $_GET['id'];
$conn->query("DELETE FROM products WHERE id=$id");
header("Location: show.php");
?>