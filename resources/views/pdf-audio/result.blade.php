<!DOCTYPE html>
<html>
<head>
    <title>PDF to Audio Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="card shadow p-4">
            <h1 class="text-center text-primary mb-4">🎧 Audio Preview</h1>

            <div class="mb-4">
                <h5><strong>Extracted Text:</strong></h5>
                <pre class="bg-light border p-3" style="white-space: pre-wrap;">{{ $text }}</pre>
            </div>

            <div class="mb-4">
                <h5>Listen to Audio:</h5>
                <audio controls class="w-100">
                    <source src="{{ $audioPath }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>

            <div class="text-center">
                <a href="{{ url('/') }}" class="btn btn-outline-primary">🔁 Convert Another PDF</a>
            </div>
        </div>
    </div>

</body>
</html>
