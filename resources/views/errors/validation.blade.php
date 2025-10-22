<!DOCTYPE html>
<html>
<head><title>Validation Error</title></head>
<body>
    <h1>⚠️ Validation Error</h1>
    <ul>
        @foreach ($errors as $field => $messages)
            @foreach ($messages as $message)
                <li><strong>{{ $field }}:</strong> {{ $message }}</li>
            @endforeach
        @endforeach
    </ul>
    <p>Tracking ID: {{ $tracking_id }}</p>
</body>
</html>
