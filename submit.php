<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "visitor pass");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$visitor_pass_no = $_POST['visitor_pass_no'];
$day_pass_no = $_POST['day_pass_no'];
$visitor_name = $_POST['visitor_name'];
$designation = $_POST['designation'];
$company_name = $_POST['company_name'];
$contact_no = $_POST['contact_no'];
$other_visitors = $_POST['other_visitors'];
$duration = $_POST['duration'];
$visit_type = $_POST['visit_type'];
$purpose = $_POST['purpose'];

// Insert data into the database
$sql = "INSERT INTO visitor_pass_form (visitor_pass_no, day_pass_no, visitor_name, designation, company_name, contact_no, other_visitors, duration, visit_type, purpose)
        VALUES ('$visitor_pass_no', '$day_pass_no', '$visitor_name', '$designation', '$company_name', '$contact_no', '$other_visitors', '$duration', '$visit_type', '$purpose')";

if ($conn->query($sql) === TRUE) {
    // Redirect to history page after successful submission
    header("Location: history.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>