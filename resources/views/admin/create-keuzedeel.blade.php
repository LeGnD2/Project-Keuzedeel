<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuw Keuzedeel - Admin</title>
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
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 1px solid #333;
        }

        .header h1 {
            font-size: 2rem;
            color: #4a90e2;
            margin-bottom: 0.5rem;
        }

        .form-container {
            background: linear-gradient(135deg, #1a1a1a 0%, #0d0d0d 100%);
            border: 1px solid #333;
            border-radius: 12px;
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #b0b0b0;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            background: #0a0a0a;
            border: 1px solid #333;
            border-radius: 8px;
            color: #fff;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-group small {
            display: block;
            margin-top: 0.25rem;
            color: #666;
            font-size: 0.875rem;
        }

        .error-message {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid #e74c3c;
            border-left: 4px solid #e74c3c;
            color: #e74c3c;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .error-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
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

        .btn-success {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.4);
        }

        .btn-secondary {
            background: #555;
            color: white;
        }

        .btn-secondary:hover {
            background: #666;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>➕ Nieuw Keuzedeel Toevoegen</h1>
            <p style="color: #888;">Vul alle velden in om een nieuw keuzedeel aan te maken</p>
        </div>

        @if($errors->any())
            <div class="error-message">
                <strong>⚠️ Er zijn fouten in het formulier:</strong>
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-container">
            <form method="POST" action="{{ route('admin.store') }}">
                @csrf

                <div class="form-group">
                    <label for="titel">Titel *</label>
                    <input type="text" id="titel" name="titel" value="{{ old('titel') }}" required>
                    <small>Bijvoorbeeld: "JavaScript Advanced" of "Frontend Development"</small>
                </div>

                <div class="form-group">
                    <label for="beschrijving">Beschrijving *</label>
                    <textarea id="beschrijving" name="beschrijving" required>{{ old('beschrijving') }}</textarea>
                    <small>Geef een duidelijke uitleg over wat studenten leren in dit keuzedeel</small>
                </div>

                <div class="form-group">
                    <label for="eisen">Eisen *</label>
                    <input type="text" id="eisen" name="eisen" value="{{ old('eisen') }}" required>
                    <small>Bijvoorbeeld: "Basis kennis van HTML/CSS" of "Geen voorkennis vereist"</small>
                </div>

                <div class="form-group">
                    <label for="max_studenten">Maximum Aantal Studenten *</label>
                    <input type="number" id="max_studenten" name="max_studenten" value="{{ old('max_studenten', 30) }}" min="1" max="100" required>
                    <small>Hoeveel studenten kunnen zich maximaal inschrijven?</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-success">💾 Keuzedeel Opslaan</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">❌ Annuleren</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>