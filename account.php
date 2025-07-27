<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Check if admin_id is set in the session
if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    die("Error: Admin ID is not set. Please log in again.");
}

// Database connection
$conn = new mysqli("localhost", "root", "", "visitor pass");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch admin details
$admin_id = $_SESSION['admin_id']; // Assuming admin ID is stored in the session
$sql = "SELECT * FROM admin WHERE id = $admin_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $admin = $result->fetch_assoc();
    $is_new_account = false; // Admin details already exist
} else {
    $is_new_account = true; // Admin details do not exist
}

// Handle form submission for saving or updating account details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);

    if ($is_new_account) {
        // Insert new admin details
        $insert_sql = "INSERT INTO admin (id, name, email, contact) VALUES ($admin_id, '$name', '$email', '$contact')";
        if ($conn->query($insert_sql) === TRUE) {
            echo "<script>alert('Account details saved successfully!');</script>";
            header("Location: account.php");
            exit;
        } else {
            echo "Error saving account details: " . $conn->error;
        }
    } else {
        // Update existing admin details
        $update_sql = "UPDATE admin SET name = '$name', email = '$email', contact = '$contact' WHERE id = $admin_id";
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>alert('Account details updated successfully!');</script>";
            header("Location: account.php");
            exit;
        } else {
            echo "Error updating account details: " . $conn->error;
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Account</title>
    <link rel="stylesheet" href="account.css">
</head>
<body>
    <header>
        <h1>Admin Account</h1>
        <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
    </header>
    <main>
        <section class="account-details">
            <h2><?php echo $is_new_account ? 'Enter Your Details' : 'Account Information'; ?></h2>
            <form action="account.php" method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $is_new_account ? '' : htmlspecialchars($admin['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $is_new_account ? '' : htmlspecialchars($admin['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact" value="<?php echo $is_new_account ? '' : htmlspecialchars($admin['contact']); ?>" required>
                </div>
                <button type="submit" class="save-btn"><?php echo $is_new_account ? 'Save Details' : 'Update Details'; ?></button>
            </form>
        </section>
    </main>
</body>
</html>