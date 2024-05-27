<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CheckRide</title>
    <!--<link rel="stylesheet" href="styleconnexion.css">-->
    <link rel="shortcut icon" href="public/img/faviconmoto.png" type="image/png">
    <style>
        body {
            height: 100vh;
            font-family: arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to top right, #482673 0%, #2b5876 100%);
            color: white;
        }

        .container {
            position: relative;
        }

        form {
            background: rgba(255, 255, 255, .3);
            padding: 3rem;
            height: 370px;
            border-radius: 20px;
            border-left: 1px solid rgba(255, 255, 255, .3);
            border-top: 1px solid rgba(255, 255, 255, .3);
            backdrop-filter: blur(10px);
            box-shadow: 20px 20px 40px -6px rgba(0, 0, 0, .2);
            text-align: center;
        }

        p {
            color: white;
            font-weight: 500;
            opacity: .7;
            font-size: 1.4rem;
            margin-bottom: 60px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, .2);
        }

        a {
            text-decoration: none;
            color: #ddd;
            font-size: 12px;
        }

        a:hover {
            text-shadow: 2px 2px 6px #00000040;
        }

        a:active {
            text-shadow: none;
        }

        input {
            background: transparent;
            border: none;
            border-left: 1px solid rgba(255, 255, 255, .3);
            border-top: 1px solid rgba(255, 255, 255, .3);
            padding: 1rem;
            width: 200px;
            border-radius: 50px;
            backdrop-filter: blur(5px);
            box-shadow: 4px 4px 60px rgba(0, 0, 0, .2);
            color: white;
            font-weight: 500;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, .2);
            transition: all .3s;
            margin-bottom: 2em;
        }
        input:hover,
        input[type="email"]:focus,
        input[type="password"]:focus{
            background: rgba(255,255,255,0.1);
            box-shadow: 4px 4px 60px 8px rgba(0,0,0,0.2);
        }

        input[type="button"] {
            margin-top: 10px;
            width: 150px;
            font-size: 1rem;
            cursor: pointer;
        }

        ::placeholder {
            color: #fff;
        }
        .drop {
            background: rgba(255, 255, 255, .3);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            border-left: 1px solid rgba(255, 255, 255, .3);
            border-top: 1px solid rgba(255, 255, 255, .3);
            box-shadow: 10px 10px 60px -8px rgba(0,0,0,0.2);
            position: absolute;
            transition: all 0.2s ease;
        }
        .drop-1 {
            height: 80px; width: 80px;
            top: -20px; left: -40px;
            z-index: -1;
        }

        .drop-2 {
            height: 80px; width: 80px;
            bottom: -50px; right: -30px;
        }

        .drop-3 {
            height: 100px; width: 100px;
            bottom: -30px; left: -30px;
            z-index: -1;
        }

        .drop-4 {
            height: 120px; width: 120px;
            top: -60px; right: -60px;
        }
    </style>
</head>
<body>
<?php
require('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    try {
        $query = "SELECT * FROM `users` WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($query);
        $stmt->execute([':username' => $username, ':password' => hash('sha256', $password)]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirect to home page
        } else {
            $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>
<div class="container">
    <form action="" method="post">
        <p>Welcome</p>
        <input type="text" name="username" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Connexion"><br>
        <a href="#">Forgotten password?</a>
        <a href="register.php">No account yet?</a>
    </form>
    <div class="drop drop-1"></div>
    <div class="drop drop-2"></div>
    <div class="drop drop-3"></div>
    <div class="drop drop-4"></div>
    <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
</div>
</body>

</html>
