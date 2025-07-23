<?php
include('db.php');
include('auth.php');
if (!isAdmin()) die("Access denied");
$id = (int) $_GET['id']; 
$conn->query("UPDATE products SET status = 'inactive' WHERE id = $id");
header("Location: show.php");
exit;
?>