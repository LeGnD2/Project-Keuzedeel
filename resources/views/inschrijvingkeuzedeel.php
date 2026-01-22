<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuzedeelinformatie - TCR</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sedgwick+Ave+Display&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #000;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }

        nav {
            background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbarg {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
        }

        .logo img {
            height: 60px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        .info h1 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 600;
            background: linear-gradient(90deg, #fff, #a0a0a0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-container {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .inlog-image {
            height: 32px;
            width: 32px;
            filter: brightness(0) invert(1);
        }

        .login-btn {
            background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.75rem;
            border-radius: 8px;
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 144, 226, 0.4);
        }

        .keuzesec {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }

        .sedgwick-ave-display-regular {
            display: grid;
            gap: 2.5rem;
        }

        .keuzedeel-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid #333;
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .keuzedeel-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4a90e2, #357abd);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .keuzedeel-card:hover {
            transform: translateY(-5px);
            border-color: #4a90e2;
            box-shadow: 0 10px 30px rgba(74, 144, 226, 0.2);
        }

        .keuzedeel-card:hover::before {
            transform: scaleX(1);
        }

        .keuzedeel-card h2 {
            font-family:clamp(1.5rem, 3vw, 2rem) ;
            font-size: clamp(1.5rem, 3vw, 2rem);
            margin-bottom: 1rem;
            color: #4a90e2;
        }

        .keuzedeel-card p {
            font-size: clamp(1.5rem, 3vw, 2rem);
            color: #b0b0b0;
        }

        .regelssec {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem 4rem 2rem;
        }

        .regels {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid #333;
            border-radius: 16px;
            padding: 2.5rem;
            border-left: 5px solid #e74c3c;
        }

        .regels h2 {
            font-size: clamp(1.5rem, 3vw, 2rem);
            margin-bottom: 1rem;
            color: #e74c3c;
        }

        .regels > p {
            margin-bottom: 1.5rem;
            color: #b0b0b0;
        }

        .regels ul {
            list-style: none;
            padding-left: 0;
        }

        .regels li {
            padding: 1rem;
            margin-bottom: 0.75rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            border-left: 3px solid #e74c3c;
            font-size: clamp(1.5rem, 3vw, 2rem);
        }

        .regels li .highlight {
            color: #e74c3c;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .navbarg {
                flex-direction: column;
                text-align: center;
            }

            .info h1 {
                font-size: 1.1rem;
            }

            .keuzesec, .regelssec {
                margin: 2rem auto;
            }

            .keuzedeel-card h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="navbarg">
            <div class="logo">
                <img src="image/Logo-TCR.webp" alt="Logo TCR">
            </div>
            <div class="info">
                <h1>Hallo medeleerlingen, hier staan de keuzedelen die je kunt kiezen</h1>
            </div>
            <div class="login-container">
                <img class="inlog-image" src="image/inloggen12.png" alt="Inloggen icoon">
                <button class="login-btn">Inloggen</button>
            </div>
        </div>
    </nav>
        
    <div class="keuzesec">
        <div class="sedgwick-ave-display-regular">
            <div class="keuzedeel-card">
                <h2>Keuzedeel: JavaScript</h2>
                <p>Hier leer je allerlei vaardigheden over JavaScript. Van basis syntax tot geavanceerde frameworks en libraries.</p>
            </div>

            <div class="keuzedeel-card">
                <h2>Keuzedeel: Frontend Development</h2>
                <p>Hier leer je allerlei vaardigheden over Frontend Development. Bouw moderne, responsive websites met HTML, CSS en JavaScript.</p>
            </div>

            <div class="keuzedeel-card">
                <h2>Keuzedeel: Gaming Development</h2>
                <p>Hier leer je allerlei vaardigheden over Gaming Development. Creëer je eigen games met moderne game engines en technieken.</p>
            </div>
        </div>
    </div>

    <div class="regelssec">
        <div class="regels">
            <h2>Regels</h2>
            <p>Hier staan regels die je moet volgen volgens onze school.</p>
            <ul>
                <li><strong>Max:</strong> 30 studenten per keuzedeel <strong>(min: 15)</strong></li>
                <li>Je kunt dit keuzedeel als tweede keuzedeel kiezen als er <span class="highlight">rood</span> staat</li>
            </ul>
        </div>
    </div>

</body>

</html>