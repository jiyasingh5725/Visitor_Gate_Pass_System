<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "visitor pass");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID of the record to verify
$id = $_POST['id'];

// Update the record to mark it as verified
$sql = "UPDATE visitor_pass_form SET is_verified = 1 WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: security_dashboard.php"); // Redirect back to the dashboard
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>