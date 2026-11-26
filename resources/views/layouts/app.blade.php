<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS System')</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            color: #222;
        }

        .navbar {
            background-color: #1f2937;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
        }

        .navbar .brand {
            font-size: 20px;
            font-weight: bold;
            margin-right: auto;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #00000015;
        }

        .card h3 {
            margin-top: 0;
            color: #555;
        }

        .card p {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 0;
        }

        @media (max-width: 800px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ url('/dashboard') }}" class="brand">POS System</a>
        <a href="{{ url('/dashboard') }}">Dashboard</a>
        <a href="{{ url('/products') }}">Products</a>
        <a href="{{ url('/customers') }}">Customers</a>
        <a href="{{ url('/users') }}">Staff</a>
        <a href="{{ url('/sales') }}">Sales</a>
    </nav>

    <main class="container">
        @yield('content')
    </main>

</body>
</html>