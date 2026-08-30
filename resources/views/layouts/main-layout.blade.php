<!DOCTYPE html>
<html lang="pt_br" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <title>YOUIF</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/youif_logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
</head>

<body>
    @yield('content')
    <script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}">
    </script>
</body>
</html>