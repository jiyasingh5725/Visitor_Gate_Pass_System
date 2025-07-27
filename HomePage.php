<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "visitor pass");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest visitor pass and day pass numbers
$sql = "SELECT MAX(visitor_pass_no) AS last_visitor_pass, MAX(day_pass_no) AS last_day_pass FROM visitor_pass_form";
$result = $conn->query($sql);

$visitor_pass_no = 1; // Default value if no records exist
$day_pass_no = 1;     // Default value if no records exist

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $visitor_pass_no = $row['last_visitor_pass'] + 1; // Increment the last visitor pass number
    $day_pass_no = $row['last_day_pass'] + 1;         // Increment the last day pass number
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BHEL Jhansi Visitor Pass</title>
    <link rel="stylesheet" href="HomePage.css">
</head>
<body>
    <header>
        <h1>BHEL Jhansi Visitor Pass System</h1>
    </header>

    <main>
        <section class="form-section">
            <h2>Create New Gate Pass</h2>
            <form action="submit.php" method="post">
                <!-- Gate Pass Section -->
                <div class="form-group">
                    <h3>Gate Pass</h3>
                    <div class="row">
                        <label>Visitor Pass No:</label>
                        <input type="text" name="visitor_pass_no" value="<?php echo $visitor_pass_no; ?>" readonly>
                        <label>Day Pass No:</label>
                        <input type="text" name="day_pass_no" value="<?php echo $day_pass_no; ?>" readonly>
                    </div>
                    <div class="row">
                        <label>Name of Visitor:</label>
                        <input type="text" name="visitor_name" required>
                        <label>Designation of Visitor:</label>
                        <input type="text" name="designation" required>
                    </div>
                    <div class="row">
                        <label>Company Name & Address:</label>
                        <input type="text" name="company_name" required>
                        <label>Contact No:</label>
                        <input type="text" name="contact_no" required>
                    </div>
                    <div class="row">
                        <label>No. of Other Visitors:</label>
                        <input type="number" name="other_visitors" value="0" min="0">
                        <label>Purposed Duration (in Hrs):</label>
                        <input type="number" name="duration" value="1" min="1">
                    </div>
                    <div class="row">
                        <label>Type of Visit:</label>
                        <input type="radio" name="visit_type" value="Official" checked> Official
                        <input type="radio" name="visit_type" value="Other"> Other
                        <label>Purpose:</label>
                        <select name="purpose">
                            <option value="Official Meeting">Official Meeting</option>
                            <option value="Vendor Visit">Vendor Visit</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <!-- Other Visitors Section -->
                <div class="form-group">
                    <h3>Details of Other Visitors</h3>
                    <div class="row">
                        <label>1.</label>
                        <select name="visitor_1_title">
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                        </select>
                        <input type="text" name="visitor_1_name" placeholder="Name">
                    </div>
                    <div class="row">
                        <label>2.</label>
                        <select name="visitor_2_title">
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                        </select>
                        <input type="text" name="visitor_2_name" placeholder="Name">
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="form-actions">
                    <input type="submit" value="Submit">
                    <input type="reset" value="Clear">
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> BHEL Jhansi | Designed and Developed by Jiya Singh, VIT</p>
    </footer>
</body>
</html>