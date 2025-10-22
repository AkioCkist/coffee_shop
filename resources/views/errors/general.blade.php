<!DOCTYPE html>
<html>
<head>
    <title>Error Occurred</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        h1 { color: #e74c3c; }
        p { color: #555; }
    </style>
</head>
<body>
    <h1>⚠️ Something went wrong!</h1>
    <p>{{ $errorMessage }}</p>
    <p>Tracking ID: <strong>{{ $tracking_id }}</strong></p>
    <p>Please contact support with this ID for assistance.</p>
</body>
</html>
