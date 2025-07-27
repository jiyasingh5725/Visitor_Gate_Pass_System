<?php
session_start();
if (!isset($_SESSION['security'])) {
    header("Location: security_login.php");
    exit;
}

// Check if visitor ID is passed
if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("Error: Visitor ID is not set.");
}

// Database connection
$conn = new mysqli("localhost", "root", "", "visitor pass");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$visitor_id = $_POST['id'];

// Handle form submission for document type and file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['document_type'])) {
    $document_type = $conn->real_escape_string($_POST['document_type']);
    $upload_dir = "uploads/";
    $file_path = "";

    // Handle file upload
    if (isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
        $file_name = basename($_FILES['document_file']['name']);
        $file_path = $upload_dir . $file_name;

        // Move uploaded file to the uploads directory
        if (!move_uploaded_file($_FILES['document_file']['tmp_name'], $file_path)) {
            die("Error uploading file.");
        }
    }

    // Update the visitor record with the document type, file path, and mark as verified
    $update_sql = "UPDATE visitor_pass_form SET document_type = '$document_type', document_file = '$file_path', is_verified = 1 WHERE id = $visitor_id";
    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Visitor verified successfully!');</script>";
        header("Location: security_dashboard.php");
        exit;
    } else {
        echo "Error verifying visitor: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitor Verification</title>
    <link rel="stylesheet" href="visitor_verification.css">
</head>
<body>
    <header>
        <h1>Visitor Verification</h1>
        <a href="security_dashboard.php" class="back-btn">Back to Dashboard</a>
    </header>
    <main>
        <section class="verify-form">
            <h2>Enter Document Type for Verification</h2>
            <form action="visitor_verification.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($visitor_id); ?>">
                <div class="form-group">
                    <label for="document_type">Document Type:</label>
                    <select id="document_type" name="document_type" required>
                        <option value="">Select Document Type</option>
                        <option value="ID Card">ID Card</option>
                        <option value="Passport">Passport</option>
                        <option value="Driving License">Driving License</option>
                        <option value="Aadhaar Card">Aadhaar Card</option>
                        <option value="Voter ID">Voter ID</option>
                        <option value="PAN Card">PAN Card</option>
                        <option value="Employee ID">Employee ID</option>
                        <option value="Student ID">Student ID</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="document_file">Upload Document (Image or PDF):</label>
                    <input type="file" id="document_file" name="document_file" accept=".jpg,.jpeg,.png,.pdf" required>
                </div>
                <button type="submit" class="verify-btn">Submit</button>
            </form>
        </section>
    </main>
</body>
</html>