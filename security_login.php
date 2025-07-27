<!DOCTYPE html>
<html>
<head>
    <title>Security Login</title>
</head>
<body>
    
    <form method="POST" action="security_process.php">
        <h2>Security Login</h2>
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
<style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
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
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        input[type="text"], input[type="password"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            box-shadow: inset 0 3px 6px rgba(0, 0, 0, 0.3);
            font-size: 1rem;
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