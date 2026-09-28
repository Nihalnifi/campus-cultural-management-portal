<?php
session_start();
include("db.php");

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check email first
    $query = mysqli_query($conn, "SELECT * FROM registrations WHERE email='$email'");

    if (mysqli_num_rows($query) > 0) {

        $row = mysqli_fetch_assoc($query);

        // Check password
        if ($row['password'] == $password) {

            $_SESSION['participant'] = $email;

            header("Location: user_dashboard.php");
            exit();

        } else {
            $error = "Wrong Password!";
        }

    } else {
        $error = "Email Not Found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Participant Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 35px;
            width: 350px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            color: white;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border-radius: 6px;
            border: none;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 5px #fff;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 6px;
            background: #f6c23e;
            color: black;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #dda20a;
        }

        .error {
            background: #dc3545;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #fff;
            font-weight: bold;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .show-pass {
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 15px;
        }
	.home-container {
    	    text-align: center;
   	    margin-bottom: 20px;
	}

	.home-btn {
    	    display: inline-block;
    	    margin-bottom: 20px;
    	    padding: 10px 20px;
    	    background:  #34495e;
    	    color: white;
    	    text-decoration: none;
    	    border-radius: 8px;
    	    font-weight: bold;
    	    transition: 0.3s;
	}
	
	.home-btn:hover {
    	    background: #3d566e;}
    </style>

    <script>
        function togglePassword() {
            var pass = document.getElementById("password");
            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }
    </script>

</head>

<body>

<div class="login-box">
    <h2>Participant Login</h2>

    <?php if (isset($error)) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" id="password" required>

        <div class="show-pass">
            <input type="checkbox" onclick="togglePassword()"> Show Password
        </div>

        <button type="submit" name="login" class="btn">
            Login
        </button>

    </form>
    
    <a href="index.php" class="home-btn"> Home</a>

    <div class="register-link">
        Don't have an account? 
        <a href="register.php">Register Here</a>
    </div>
</div>

</body>
</html>