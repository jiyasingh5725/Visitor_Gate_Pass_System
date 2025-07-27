<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Database connection
$conn = new mysqli("localhost", "root", "", "visitor pass");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form ID
$id = $_POST['id'];

// Fetch the form details
$sql = "SELECT * FROM visitor_pass_form WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $form = $result->fetch_assoc();
} else {
    echo "Form not found.";
    exit;
}

// Handle form submission for editing
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $visitor_name = $_POST['visitor_name'];
    $designation = $_POST['designation'];
    $purpose = $_POST['purpose'];

    // Update the form details
    $update_sql = "UPDATE visitor_pass_form SET visitor_name = '$visitor_name', designation = '$designation', purpose = '$purpose' WHERE id = $id";
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Form updated successfully!');</script>";
        header("Location: verify_edit.php");
        exit;
    } else {
        echo "Error updating form: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Form</title>
    <link rel="stylesheet" href="edit_form.css">
</head>
<body>
    <header>
        <h1>Edit Form</h1>
        <a href="verify_edit.php" class="back-btn">Back to Verify Page</a>
    </header>
    <main>
        <section class="edit-form">
            <h2>Update Form Details</h2>
            <form action="edit_form.php" method="post">
                <input type="hidden" name="id" value="<?php echo $form['id']; ?>">
                <div class="form-group">
                    <label for="visitor_name">Visitor Name:</label>
                    <input type="text" id="visitor_name" name="visitor_name" value="<?php echo htmlspecialchars($form['visitor_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="designation">Designation:</label>
                    <input type="text" id="designation" name="designation" value="<?php echo htmlspecialchars($form['designation']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="purpose">Purpose:</label>
                    <input type="text" id="purpose" name="purpose" value="<?php echo htmlspecialchars($form['purpose']); ?>" required>
                </div>
                <button type="submit" name="update" class="save-btn">Save Changes</button>
            </form>
        </section>
    </main>
</body>
</html>