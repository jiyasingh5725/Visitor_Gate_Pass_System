<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "visitor pass");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM visitor_pass_form ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visitor Pass History</title>
    <link rel="stylesheet" href="history.css">
</head>
<body>
    <header>
        <h1>Visitor Pass History</h1>
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
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
<?php $conn->close(); ?>