<?php
session_start();
$conn = new mysqli("localhost", "root", "", "visitor pass");

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admin_user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    // Compare plain text password directly
    if ($password === $user['password']) {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "❌ Incorrect password.";
    }
} else {
    echo "❌ Admin not found.";
}
?>