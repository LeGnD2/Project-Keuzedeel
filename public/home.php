<?php
session_start();

// Controleer of gebruiker ingelogd is
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

// Logout verwerken
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: /login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .home-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .welcome-message {
            background: #efe;
            color: #3c3;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
            border-left: 4px solid #3c3;
        }
        
        .user-info {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        
        .user-info p {
            color: #555;
            margin: 10px 0;
            font-size: 16px;
        }
        
        .logout-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s;
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h1>Welkom!</h1>
        
        <div class="welcome-message">
            <p>Je bent succesvol ingelogd!</p>
        </div>
        
        <div class="user-info">
            <p><strong>Gebruikersnaam:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
            <p><strong>User ID:</strong> <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
        </div>
        
        <a href="?logout=true" class="logout-btn">Uitloggen</a>
    </div>
</body>
</html>
