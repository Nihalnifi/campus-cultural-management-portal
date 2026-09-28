<?php
session_start();
include("db.php");

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if(mysqli_num_rows($query) > 0){
        $_SESSION['admin'] = $username;
        header("Location: admin/dashboard.php");
    } else {
        echo "<script>alert('Invalid Login Credentials');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <meta charset="UTF-8">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1d2671, #c33764);
        }

        .login-box {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(15px);
            padding: 40px;
            width: 350px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            text-align: center;
            color: white;
            animation: fadeIn 0.8s ease-in-out;
        }

        .login-box h2 {
            margin-bottom: 25px;
            font-weight: 600;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .input-group label {
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 8px;
            outline: none;
        }

        .input-group input:focus {
            box-shadow: 0 0 10px rgba(255,255,255,0.6);
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 25px;
            background: #ffffff;
            color: #c33764;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #f1f1f1;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .footer-text {
            margin-top: 15px;
            font-size: 12px;
            opacity: 0.8;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>🔐 Admin Login</h2>

    <form method="POST">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn">Login</button>
    </form>

    <div class="footer-text">
        Campus Cultural Management Portal
    </div>
</div>

</body>
</html>