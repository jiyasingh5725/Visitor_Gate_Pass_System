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
  <title>BHEL Visitor Pass Admin Dashboard</title>
  <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
  <header>
    <div class="logo">
      <img src="assets/bhel logo.png" alt="BHEL Logo">
      <h2>Bharat Heavy Electricals Limited</h2>
    </div>
    <form action="logout.php" method="post">
      <button class="logout">Logout</button>
    </form>
  </header>

  <div class="dashboard">
    <aside class="sidebar">
      <nav>
        <ul>
          <li><a href="">Home</a></li>
          <li><a href="visitor_list.php">Visitor List</a></li>
          <li><a href="approved_requests.php">Approved Requests</a></li>
          <li><a href="HomePage.php">Visitor Pass Form</a></li>
          <li><a href="check_status.php">Reports</a></li>
          <li><a href="account.php">Account</a></li>
        </ul>
      </nav>
    </aside>

    <main class="main-content">
      <div style="position: relative; width: 100%; border-radius: 10px; margin-top: 0px; overflow: hidden; min-height: 600px; background: url('assets/visitor.png') center center / cover no-repeat;">
        <h2 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #fff; background: rgba(0,0,0,0.5); padding: 20px 40px; border-radius: 8px; font-size: 2em;">
          Welcome, <?php echo htmlspecialchars($_SESSION['admin']); ?>!
        </h2>
      </div>
      <div class="cards">
      <h3>Welcome to BHEL Visitor Pass Generation Portal</h3>
      <p>Manage visitor passes and requests efficiently.
        This portal is designed to streamline and simplify the visitor entry process at Bharat Heavy Electricals Limited (BHEL). Whether you're a guest, vendor, or official visitor, you can easily register and generate your visitor pass online before your visit. Please ensure that all details are accurate and valid to facilitate a smooth and secure entry into BHEL premises.
        Your safety and security is our priority.
      </p>
      </div>
      
      <section class="grid">
      <div class="card">
        <h3>Fill Visitor Form</h3>
        <p>Request a new visitor pass for your visit to BHEL Jhansi.</p>
        <a href="HomePage.php">Fill Form</a>
      </div>

      <div class="card">
        <h3>Check Request Status</h3>
        <p>Track the approval status of your submitted requests.</p>
        <a href="check_status.php">View Status</a>
      </div>

      <div class="card">
        <h3>Edit Profile</h3>
        <p>Update your contact information and ID details.</p>
        <a href="verify_edit.php">Edit Now</a>
      </div>

      <div class="card">
        <h3>Download Visitor Pass</h3>
        <p>Download approved visitor passes in PDF format.</p>
        <a href="downloaded_passes.php">Download</a>
      </div>
    </section>
    </main>
  </div>
   <footer>
    <p>&copy; <?php echo date("Y"); ?> BHEL Jhansi | Visitor Management System</p>
  </footer>
</body>
</html>
