<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar-custom {
            background-color: #1e7fe0;
        }
        .navbar-brand-custom {
            color: #fff;
        }
        .alert-custom {
            position: fixed;
            top: 10px;
            right: 10px;
            width: auto;
            max-width: 300px;
        }
        .content-title {
            margin-top: 20px;
        }
        .container {
            margin-top: 20px;
        }
        .welcome-message {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    @include('admin._menu')

    @if (session('notice'))
        <div class="alert alert-info alert-custom" role="alert">
            {{ session('notice') }}
        </div>
    @endif

    <h3 class="text-center text-primary content-title">@yield('titre')</h3>

    <!-- Welcome Message -->
    <div class="container">
        <div class="welcome-message">
            Bienvenue dans le tableau de bord de l'administrateur !
        </div>
        @yield('main')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
