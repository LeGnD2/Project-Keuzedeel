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
            font-size: clamp(1rem, 2vw, 1.5rem);
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
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
            text-decoration: none;
            display: inline-block;
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
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #4a90e2;
        }

        .keuzedeel-card p {
            font-size: 1rem;
            color: #b0b0b0;
            line-height: 1.6;
        }

        .keuzedeel-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-open {
            background: rgba(46, 204, 113, 0.2);
            color: #2ecc71;
            border: 1px solid #2ecc71;
        }

        .status-gesloten {
            background: rgba(231, 76, 60, 0.2);
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }

        .keuzedeel-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-enroll {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-enroll:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.4);
        }

        .btn-enroll:disabled {
            background: #666;
            cursor: not-allowed;
            transform: none;
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
            font-size: 2rem;
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
            font-size: 1rem;
        }

        .regels li strong {
            color: #fff;
            font-weight: 600;
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
                font-size: 0.9rem;
            }

            .keuzesec, .regelssec {
                margin: 2rem auto;
            }

            .keuzedeel-card h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="navbarg">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('image/Logo-TCR.webp') }}" alt="Logo TCR">
            </a>
            <div class="info">
                <h1>Hallo medeleerlingen, hier staan de keuzedelen die je kunt kiezen</h1>
            </div>
            <div class="login-container">
                <img class="inlog-image" src="{{ asset('image/inloggen12.png') }}" alt="Inloggen icoon">
                
                @if(session()->has('user_id'))
                    <span style="margin-right: 1rem; color: #4a90e2;">Welkom, {{ session('naam') }}!</span>
                    <a href="{{ route('logout') }}" class="login-btn">Uitloggen</a>
                @else
                    <a href="{{ route('login') }}" class="login-btn">Inloggen</a>
                @endif
            </div>
        </div>
    </nav>
        
    <div class="keuzesec">
        @if(session('error'))
    <div style="
        background: rgba(231,76,60,0.2);
        border: 1px solid #e74c3c;
        color: #e74c3c;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        text-align: center;
        font-weight: 600;
    ">
        {{ session('error') }}
    </div>
@endif
        <div class="sedgwick-ave-display-regular">
            @forelse($keuzedelen as $keuzedeel)
                <div class="keuzedeel-card">
                    <div class="keuzedeel-header">
                        <div>
                            <h2>Keuzedeel: {{ $keuzedeel->titel }}</h2>
                        </div>
                        <span class="status-badge status-{{ $keuzedeel->status }}">
                            {{ $keuzedeel->status }}
                        </span>
                    </div>
                    <p>{{ $keuzedeel->beschrijving }}</p>
                    <p style="margin-top: 1rem; color: #888; font-size: 0.9rem;"><strong>Eisen:</strong> {{ $keuzedeel->eisen }}</p>
                    <p style="color: #888; font-size: 0.9rem;"><strong>Max studenten:</strong> {{ $keuzedeel->max_studenten }} | <strong>Inschrijvingen:</strong> {{ $keuzedeel->inschrijvingen ?? 0 }}</p>
                    
                    <div class="keuzedeel-actions">
                        @if(session()->has('user_id'))
                            <form method="POST" action="{{ route('enroll.keuzedeel') }}" style="display: inline;">
                                @csrf
                                <input type="hidden" name="keuzedeel_id" value="{{ $keuzedeel->id }}">
                                <button type="submit" class="btn-enroll" {{ $keuzedeel->status === 'gesloten' ? 'disabled' : '' }}>
                                    ✏️ Inschrijven
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn-enroll">Inloggen om in te schrijven</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="keuzedeel-card">
                    <h2>Geen keuzedelen beschikbaar</h2>
                    <p>Er zijn momenteel geen keuzedelen beschikbaar. Kom later terug!</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="regelssec">
        <div class="regels">
            <h2>Regels</h2>
            <p>Hier staan regels die je moet volgen volgens onze school.</p>
            <ul>
                <li><strong>Capaciteit:</strong> Maximaal 30 studenten per keuzedeel <strong>(minimaal 15 studenten)</strong></li>
                <li>Je kunt dit keuzedeel als tweede keuzedeel kiezen als er <span class="highlight">rood</span> bij staat</li>
                <li><strong>Aanmelding:</strong> Zorg dat je op tijd inschrijft, want vol = vol!</li>
                <li><strong>Aanwezigheid:</strong> Minimaal 80% aanwezigheid is verplicht om het keuzedeel af te ronden</li>
            </ul>
        </div>
    </div>

</body>

</html>