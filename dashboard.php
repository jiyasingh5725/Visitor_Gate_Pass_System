<?php
// Simulated login session (replace with actual session handling)
session_start();
$_SESSION['username'] = "Visitor123"; // Just for demonstration
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - BHEL Jhansi Visitor System</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="visitor_form.php">Fill Visitor Form</a></li>
        <li><a href="request_status.php">Request Status</a></li>
        <li><a href="edit_profile.php">Edit Profile</a></li>
        <li><a href="download_pass.php">Download Pass</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="welcome">
      <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
      <p>Select an option from the navigation bar to proceed.</p>
    </section>

    <section class="grid">
      <div class="card">
        <h3>Fill Visitor Form</h3>
        <p>Request a new visitor pass for your visit to BHEL Jhansi.</p>
        <a href="visitor_form.php">Fill Form</a>
      </div>

      <div class="card">
        <h3>Check Request Status</h3>
        <p>Track the approval status of your submitted requests.</p>
        <a href="request_status.php">View Status</a>
      </div>

      <div class="card">
        <h3>Edit Profile</h3>
        <p>Update your contact information and ID details.</p>
        <a href="edit_profile.php">Edit Now</a>
      </div>

      <div class="card">
        <h3>Download Visitor Pass</h3>
        <p>Download approved visitor passes in PDF format.</p>
        <a href="download_pass.php">Download</a>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> BHEL Jhansi | Visitor Management System</p>
  </footer>
</body>
</html>
