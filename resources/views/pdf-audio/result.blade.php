<!DOCTYPE html>
<html>
<head>
    <title>PDF to Audio Result</title>
</head>
<body>
    <h1>Audio Preview</h1>

    <p><strong>Extracted Text:</strong></p>
    <pre style="background-color: #f4f4f4; padding: 10px; border: 1px solid #ddd;">{{ $text }}</pre>

    <h3>Listen to Audio:</h3>
    <audio controls>
        <source src="{{ $audioPath }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <br><br>
    <a href="{{ url('/') }}">Convert another PDF</a>
</body>
</html>
