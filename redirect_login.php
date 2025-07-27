<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    if ($role == 'admin') {
        header("Location: admin_login.php");
    } elseif ($role == 'security') {
        header("Location: security_login.php");
    } else {
        echo "Invalid selection.";
    }
    exit;
}
?>
