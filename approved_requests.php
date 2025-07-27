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
    <title>Approved Requests</title>
    <link rel="stylesheet" href="approved_requests.css">
</head>
<body>
    <header>
        <h1>Approved Requests</h1>
        <div class="welcome">
            <h2>Welcome Admin: <?php echo htmlspecialchars($_SESSION['admin']); ?></h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>
    <main>
        <section class="approved-requests">
            <h2>Approved Visitor Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th>Visitor Pass No</th>
                        <th>Day Pass No</th>
                        <th>Visitor Name</th>
                        <th>Designation</th>
                        <th>Company Name</th>
                        <th>Contact No</th>
                        <th>Purpose</th>
                        <th>Approved At</th>
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

                    // Fetch approved requests
                    $sql = "SELECT * FROM visitor_pass_form WHERE is_verified = 1 ORDER BY created_at DESC";
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
                                <td><?php echo $row['purpose']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile;
                    else: ?>
                        <tr>
                            <td colspan="8">No approved requests found</td>
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