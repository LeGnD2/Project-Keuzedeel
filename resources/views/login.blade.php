<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
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
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        
        h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        button:hover {
            transform: translateY(-2px);
        }
        
        .error {
            background: #fee;
            color: #c33;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #c33;
        }
        
        .success {
            background: #efe;
            color: #3c3;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #3c3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inloggen</h2>
        
        <?php
        session_start();
        
        // Database configuratie
        $host = 'localhost';
        $dbname = 'login_db';
        $username = 'root';
        $password = '';
        
        // Foutmelding weergeven
        if (isset($_SESSION['error'])) {
            echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        
        // Succesmelding weergeven
        if (isset($_SESSION['success'])) {
            echo '<div class="success">' . htmlspecialchars($_SESSION['success']) . '</div>';
            unset($_SESSION['success']);
        }
        
        // Login verwerken
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['username'] ?? '';
            $pass = $_POST['password'] ?? '';
            
            if (empty($user) || empty($pass)) {
                $_SESSION['error'] = 'Vul alle velden in';
            } else {
                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    // Hash het wachtwoord
                    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
                    
                    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
                    $stmt->execute([$user]);
                    $userRecord = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($userRecord && password_verify($pass, $userRecord['password'])) {
                        $_SESSION['user_id'] = $userRecord['id'];
                        $_SESSION['username'] = $userRecord['username'];
                        $_SESSION['success'] = 'Succesvol ingelogd!';
                        header('Location: dashboard.php');
                        exit;
                    } else {
                        $_SESSION['error'] = 'Onjuiste gebruikersnaam of wachtwoord';
                    }
                } catch (PDOException $e) {
                    $_SESSION['error'] = 'Database fout: ' . $e->getMessage();
                }
            }
            
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
        ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Inloggen</button>
        </form>
    </div>
</body>
</html>