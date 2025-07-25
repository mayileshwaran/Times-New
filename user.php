<?php
session_start();

$role = $_SESSION['role'] ?? 'guest'; 

if (in_array($role, ['admin', 'superadmin'])) {
    die("Access Denied. Not accessible to admins or superadmins.");
}
?>
