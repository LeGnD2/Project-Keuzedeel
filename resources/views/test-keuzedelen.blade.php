<!DOCTYPE html>
<html>
<head>
    <title>Test - Keuzedelen</title>
</head>
<body>
    <h1>TEST PAGINA</h1>
    
    <p>Aantal keuzedelen: {{ $keuzedelen->count() }}</p>
    
    @foreach($keuzedelen as $keuzedeel)
        <div style="border: 2px solid red; padding: 20px; margin: 10px;">
            <h2>{{ $keuzedeel->titel }}</h2>
            <p>{{ $keuzedeel->beschrijving }}</p>
            <p>Max: {{ $keuzedeel->max_studenten }}</p>
        </div>
    @endforeach
</body>
</html>