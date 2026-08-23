<!DOCTYPE html>
<html lang="pt_br" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>YOUIF</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/youif_logo.png') }}" type="image/png">
</head>

<body>
    @yield('content')
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}">
    </script>
</body>
</html>