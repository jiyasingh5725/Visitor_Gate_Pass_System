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

// Fetch all downloaded passes
$sql = "SELECT * FROM visitor_pass_form WHERE is_downloaded = 1 ORDER BY downloaded_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Downloaded Passes</title>
    <link rel="stylesheet" href="downloaded_passes.css">
</head>
<body>
    <header>
        <h1>Downloaded Passes</h1>
        <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
    </header>
    <main>
        <section class="downloaded-passes">
            <h2>List of Downloaded Passes</h2>
            <table>
                <thead>
                    <tr>
                        <th>Visitor Pass No</th>
                        <th>Day Pass No</th>
                        <th>Visitor Name</th>
                        <th>Designation</th>
                        <th>Purpose</th>
                        <th>Downloaded At</th>
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
                                <td><?php echo $row['purpose']; ?></td>
                                <td><?php echo $row['downloaded_at']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No downloaded passes found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
<?php $conn->close(); ?>