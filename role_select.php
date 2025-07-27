<!DOCTYPE html>
<html>
<head>
    <title>Select Role</title>
</head>
<body>
    <form action="redirect_login.php" method="POST">
        <h2>Select Login Type</h2>
        <input type="radio" name="role" value="admin" required> Admin<br>
        <input type="radio" name="role" value="security"> Security<br><br>
        <input type="submit" value="Proceed to Login">
    </form>
</body>
</html>
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #6a11cb, #2575fc); /* Gradient background */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #fff;
    }

    h2 {
        text-align: center;
        font-size: 2rem;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
    }

    form {
        background: rgba(0, 0, 0, 0.8);
        padding: 20px 30px;
        border-radius: 15px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5);
        text-align: center;
        animation: fadeIn 1s ease-in-out;
    }

    input[type="radio"] {
        margin: 10px;
        transform: scale(1.2);
    }

    input[type="submit"] {
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 25px;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    input[type="submit"]:hover {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>