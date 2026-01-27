<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="{{asset('css/loginStyle.css')}}">
    <style>
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            border: 1px solid #f5c6cb;
        }

        .error-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .switch-link {
            text-align: center;
            margin-top: 15px;
            color: #666;
        }

        .switch-link a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: 600;
        }

        .switch-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Registreren</h2>
        
        @if($errors->any())
            <div class="error-message">
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
               
        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            
            <div class="form-group">
                <label for="gebruikersnaam">Gebruikersnaam *</label>
                <input type="text" id="gebruikersnaam" name="gebruikersnaam" 
                       value="{{ old('gebruikersnaam') }}" required>
            </div>

            <div class="form-group">
                <label for="naam">Volledige Naam *</label>
                <input type="text" id="naam" name="naam" 
                       value="{{ old('naam') }}" required>
            </div>

            <div class="form-group">
                <label for="klas">Klas *</label>
                <input type="text" id="klas" name="klas" 
                       value="{{ old('klas') }}" 
                       placeholder="Bijv. Klas 1A" required>
            </div>
            
            <div class="form-group">
                <label for="wachtwoord">Wachtwoord * (minimaal 6 tekens)</label>
                <input type="password" id="wachtwoord" name="wachtwoord" required>
            </div>

            <div class="form-group">
                <label for="wachtwoord_confirmation">Bevestig Wachtwoord *</label>
                <input type="password" id="wachtwoord_confirmation" 
                       name="wachtwoord_confirmation" required>
            </div>
            
            <button type="submit">Registreren</button>
        </form>

        <div class="switch-link">
            Heb je al een account? <a href="{{ route('login') }}">Inloggen</a>
        </div>
    </div>
</body>
</html>