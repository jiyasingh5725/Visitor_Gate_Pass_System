<?php
session_start();
if (!isset($_SESSION['security'])) {
    header("Location: security_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Security Dashboard - Visitor Section</title>
    <link rel="stylesheet" href="security_dashboard.css">
</head>
<body>
    <header>
        <h1>Security Dashboard - Visitor Section</h1>
        <div class="welcome">
            <h2>Welcome Security Officer: <?php echo htmlspecialchars($_SESSION['security']); ?></h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>
    <main>
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
                    <th>Created At</th>
                    <th>Actions</th>
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
                            <td><?php echo $row['company_name']; ?></td>
                            <td><?php echo $row['contact_no']; ?></td>
                            <td><?php echo $row['other_visitors']; ?></td>
                            <td><?php echo $row['duration']; ?></td>
                            <td><?php echo $row['visit_type']; ?></td>
                            <td><?php echo $row['purpose']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <?php if ($row['is_verified'] == 0): ?>
                                    <!-- Redirect to visitor_verification.php -->
                                    <form action="visitor_verification.php" method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" class="verify-btn">Verify</button>
                                    </form>
                                <?php else: ?>
                                    <button class="verified-btn" disabled>Verified</button>
                                <?php endif; ?>
                                <form action="generate_pass.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="generate-btn">Generate Pass</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="12">No records found</td>
                    </tr>
                <?php endif;
                $conn->close();
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>