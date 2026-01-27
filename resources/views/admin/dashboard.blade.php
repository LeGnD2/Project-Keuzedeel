<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Keuzedelen Beheer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0a0a;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        header {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #333;
        }

        .logo {
            display: inline-block;
            cursor: pointer;
            text-decoration: none;
            margin-right: 2rem;
        }

        .logo img {
            height: 50px;
            width: auto;
            transition: transform 0.3s ease;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        header h1 {
            font-size: 2rem;
            color: #4a90e2;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4a90e2 0%, #357abd 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(74, 144, 226, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(243, 156, 18, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }

        .btn-secondary {
            background: #555;
            color: white;
        }

        .btn-secondary:hover {
            background: #666;
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            border-color: #2ecc71;
            color: #2ecc71;
        }

        .alert-error {
            background: rgba(231, 76, 60, 0.1);
            border-color: #e74c3c;
            color: #e74c3c;
        }

        .actions {
            margin-bottom: 2rem;
        }

        .keuzedelen-grid {
            display: grid;
            gap: 1.5rem;
        }

        .keuzedeel-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .keuzedeel-card:hover {
            transform: translateY(-3px);
            border-color: #4a90e2;
            box-shadow: 0 8px 25px rgba(74, 144, 226, 0.2);
        }

        .keuzedeel-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1rem;
        }

        .keuzedeel-header h3 {
            font-size: 1.5rem;
            color: #4a90e2;
            margin-bottom: 0.5rem;
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

        .keuzedeel-info {
            margin-bottom: 1rem;
            color: #b0b0b0;
        }

        .keuzedeel-info p {
            margin-bottom: 0.5rem;
        }

        .info-row {
            display: flex;
            gap: 2rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #333;
        }

        .info-item {
            display: flex;
            flex-direction: column;
        }

        .info-label {
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
        }

        .card-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px dashed #333;
            border-radius: 12px;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: #666;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .card-actions {
                flex-direction: column;
            }

            .info-row {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('image/Logo-TCR.webp') }}" alt="Logo TCR">
            </a>
            <div>
                <h1>🎓 Admin Dashboard</h1>
                <p style="color: #888; margin-top: 0.5rem;">Beheer alle keuzedelen</p>
            </div>
            <div class="user-info">
                <span style="color: #4a90e2;">Welkom, {{ session('naam') }}</span>
                <a href="{{ route('logout') }}" class="btn btn-secondary">Uitloggen</a>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                ❌ {{ $errors->first() }}
            </div>
        @endif

        <div class="actions">
            <a href="{{ route('admin.create') }}" class="btn btn-success">➕ Nieuw Keuzedeel Toevoegen</a>
            <a href="{{ route('home') }}" class="btn btn-primary">📋 Bekijk Studentenpagina</a>
        </div>

        <div class="keuzedelen-grid">
            @if($keuzedelen->count() > 0)
                @foreach($keuzedelen as $keuzedeel)
                    <div class="keuzedeel-card">
                        <div class="keuzedeel-header">
                            <div>
                                <h3>{{ $keuzedeel->titel }}</h3>
                            </div>
                            <span class="status-badge status-{{ $keuzedeel->status }}">
                                {{ $keuzedeel->status }}
                            </span>
                        </div>

                        <div class="keuzedeel-info">
                            <p><strong>Beschrijving:</strong> {{ $keuzedeel->beschrijving }}</p>
                            <p><strong>Eisen:</strong> {{ $keuzedeel->eisen }}</p>
                        </div>

                        <div class="info-row">
                            <div class="info-item">
                                <span class="info-label">Max Studenten</span>
                                <span class="info-value">{{ $keuzedeel->max_studenten }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Inschrijvingen</span>
                                <span class="info-value" style="color: {{ $keuzedeel->inschrijvingen >= $keuzedeel->max_studenten ? '#e74c3c' : '#2ecc71' }}">
                                    {{ $keuzedeel->inschrijvingen }} / {{ $keuzedeel->max_studenten }}
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Aangemaakt op</span>
                                <span class="info-value">{{ date('d-m-Y', strtotime($keuzedeel->aangemaakt_op)) }}</span>
                            </div>
                        </div>

                        <div class="card-actions">
                            <a href="{{ route('admin.edit', $keuzedeel->id) }}" class="btn btn-warning">✏️ Bewerken</a>
                            <form method="POST" action="{{ route('admin.destroy', $keuzedeel->id) }}" style="display: inline;" 
                                  onsubmit="return confirm('Weet je zeker dat je dit keuzedeel wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">🗑️ Verwijderen</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <h3>Geen keuzedelen gevonden</h3>
                    <p style="color: #888; margin-bottom: 1.5rem;">Voeg je eerste keuzedeel toe om te beginnen!</p>
                    <a href="{{ route('admin.create') }}" class="btn btn-success">➕ Nieuw Keuzedeel Toevoegen</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>