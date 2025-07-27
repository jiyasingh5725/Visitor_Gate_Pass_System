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

// Fetch all forms
$sql = "SELECT * FROM visitor_pass_form ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify and Edit Forms</title>
    <link rel="stylesheet" href="verify_edit.css">
</head>
<body>
    <header>
        <h1>Verify and Edit Forms</h1>
        <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>
    </header>
    <main>
        <section class="verify-edit">
            <h2>Forms List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Visitor Pass No</th>
                        <th>Day Pass No</th>
                        <th>Visitor Name</th>
                        <th>Designation</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Actions</th>
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
                                <td>
                                    <?php echo $row['is_verified'] ? '<span class="verified">Verified</span>' : '<span class="pending">Pending</span>'; ?>
                                </td>
                                <td>
                                    <?php if ($row['is_verified'] == 0): ?>
                                        <form action="edit_form.php" method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="edit-btn">Edit</button>
                                        </form>
                                    <?php else: ?>
                                        <button class="edit-btn disabled" disabled>Cannot Edit</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No forms found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
<?php $conn->close(); ?>