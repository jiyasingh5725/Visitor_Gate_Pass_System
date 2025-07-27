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

// Fetch all visitor details
$sql = "SELECT * FROM visitor_pass_form ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitor List</title>
    <link rel="stylesheet" href="visitor_list.css">
</head>
<body>
    <header>
        <h1>Visitor List</h1>
        <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
    </header>
    <main>
        <section class="visitor-list">
            <h2>All Visitors</h2>
            <table>
                <thead>
                    <tr>
                        <th>Visitor Pass No</th>
                        <th>Day Pass No</th>
                        <th>Visitor Name</th>
                        <th>Designation</th>
                        <th>Company Name</th>
                        <th>Contact No</th>
                        <th>Other Visitors</th>
                        <th>Duration (Hrs)</th>
                        <th>Visit Type</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['visitor_pass_no']; ?></td>
                                <td><?php echo $row['day_pass_no']; ?></td>
                                <td><?php echo $row['visitor_name']; ?></td>
                                <td><?php echo $row['designation']; ?></td>
                                <td><?php echo $row['company_name']; ?></td>
                                <td><?php echo $row['contact_no']; ?></td>
                                <td><?php echo $row['other_visitors']; ?></td>
                                <td><?php echo $row['duration']; ?></td>
                                <td><?php echo $row['visit_type']; ?></td>
                                <td><?php echo $row['purpose']; ?></td>
                                <td>
                                    <?php echo $row['is_verified'] ? '<span class="verified">Verified</span>' : '<span class="pending">Pending</span>'; ?>
                                </td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="12">No visitors found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
<?php $conn->close(); ?>