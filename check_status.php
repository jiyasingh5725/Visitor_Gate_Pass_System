<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Check Status</title>
    <link rel="stylesheet" href="check_status.css">
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <div class="welcome">
            <h2>Welcome Admin: <?php echo htmlspecialchars($_SESSION['admin']); ?></h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>
    <main>
        <section class="check-status">
            <h2>Check Status</h2>
            <table>
                <thead>
                    <tr>
                        <th>Visitor Pass No</th>
                        <th>Day Pass No</th>
                        <th>Visitor Name</th>
                        <th>Designation</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $conn = new mysqli("localhost", "root", "", "visitor pass");

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch all visitor forms
                    $sql = "SELECT * FROM visitor_pass_form ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0):
                        while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['visitor_pass_no']; ?></td>
                                <td><?php echo $row['day_pass_no']; ?></td>
                                <td><?php echo $row['visitor_name']; ?></td>
                                <td><?php echo $row['designation']; ?></td>
                                <td><?php echo $row['purpose']; ?></td>
                                <td>
                                    <?php echo $row['is_verified'] ? '<span class="verified">Verified</span>' : '<span class="pending">Pending</span>'; ?>
                                </td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile;
                    else: ?>
                        <tr>
                            <td colspan="7">No records found</td>
                        </tr>
                    <?php endif;
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>