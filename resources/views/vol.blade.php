<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sedgwick+Ave+Display&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <title>Keuzedeel vol</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #000;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background: linear-gradient(135deg, #1a1a1a, #0d0d0d);
            border: 1px solid #333;
            border-radius: 16px;
            padding: 3rem;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);
        }

        h1 {
            color: #e74c3c;
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }

        p {
            color: #b0b0b0;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .emoji {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .btn {
            background: linear-gradient(135deg, #4a90e2, #357abd);
            color: #fff;
            padding: 0.75rem 1.75rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 144, 226, 0.4);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="emoji">🚫</div>
        <h1>Dit keuzedeel is vol</h1>
        <p>
            Helaas, alle plekken voor dit keuzedeel zijn al bezet.<br>
            Vol = vol, zodat iedereen dezelfde kans heeft.
        </p>

        <a href="{{ route('home') }}" class="btn">⬅ Terug naar overzicht</a>
    </div>
</body>
</html>
