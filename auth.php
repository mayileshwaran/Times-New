<?php
session_start();
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}
?>

<?php
include("db.php");



// Sign Up
if (isset($_POST['signup_btn'])) {
    $name = $_POST['signup_name'];
    $email = $_POST['signup_email'];
    $password = $_POST['signup_password'];
    $role = "user";

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.history.back();</script>";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();
    echo "<script>alert('Signup successful! Please login.'); window.location.href='index.php';</script>";
    exit;
}

// Login
if (isset($_POST['login_btn'])) {
    $email = $_POST['login_email'];
    $password = $_POST['login_password'];
    $res = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

    if ($row = $res->fetch_assoc()) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['name'] = $row['name'];
        $redirect = $row['role'] === 'admin' ? "dashboard.php" : "index.php";
        echo "<script>window.location.href='$redirect';</script>";
    } else {
        echo "<script>alert('Invalid credentials'); window.history.back();</script>";
    }
}
?>
<?php

include('db.php'); // your DB connection

// Example: user submits login form
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify password (assuming it's hashed)
        if (password_verify($password, $row['password'])) {
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['username']; // from user table
            $_SESSION['role'] = $row['role'];         // optional
            header("Location: index.php");
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>
