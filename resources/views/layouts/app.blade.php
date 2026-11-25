<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POS System')</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
<style>
    :root {
    --charcoal: #30313a;
    --dark-text: #302d2d;
    --muted-text: #686363;
    --off-white: #fffdfb;
    --page-bg: #f5f3f1;
    --neutral-border: #d8d4d0;
    --soft-gray: #e8e5e2;

    --green: #3f8f68;
    --green-dark: #327653;
    --red: #c65353;
    --red-dark: #a83e3e;
}

    * {
        box-sizing: border-box;
    }

    body {
    margin: 0;
    font-family: "Libre Baskerville", Baskerville, Georgia, serif;
    background: var(--page-bg);
    color: var(--dark-text);
    line-height: 1.7;
}


    .navbar {
        min-height: 68px;
        padding: 0 48px;
        background: var(--charcoal);
        display: flex;
        align-items: center;
        gap: 30px;
        box-shadow: 0 3px 12px rgba(48, 49, 58, 0.18);
    }

    .navbar a {
        color: #fffaf8;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .navbar a:hover {
        color: var(--lilac);
    }

    .navbar .brand {
        margin-right: auto;
        font-size: 23px;
        font-weight: 700;
        letter-spacing: -0.3px;
    }

    .container {
        width: min(92%, 1050px);
        margin: 55px auto;
    }

    h1 {
    margin: 0 0 32px;
    text-align: center;
    color: var(--dark-text);
    font-size: 34px;
    font-weight: 700;
    letter-spacing: -0.5px;
}

    form {
        width: min(100%, 560px);
        margin: 0 auto;
        padding: 34px;
        background: var(--off-white);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(143, 70, 65, 0.10);
    }

    label {
    display: block;
    margin-bottom: 8px;
    color: var(--dark-text);
    font-size: 14px;
    font-weight: 700;
}

    input,
    select {
        width: 100%;
        margin-bottom: 4px;
        padding: 12px 14px;
        border: 1px solid #d8c6c5;
        border-radius: 7px;
        background: #ffffff;
        color: var(--text);
        font-family: inherit;
        font-size: 15px;
    }

    input:focus,
    select:focus {
        outline: none;
        border-color: var(--mulberry);
        box-shadow: 0 0 0 3px rgba(168, 93, 91, 0.16);
    }

    button,
    .btn {
        display: inline-block;
        padding: 10px 17px;
        border: none;
        border-radius: 7px;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-save {
        background: var(--green);
        color: white;
    }

    .btn-save:hover {
        background: var(--green-dark);
    }

    .btn-delete {
        background: var(--red);
        color: white;
    }

    .btn-delete:hover {
        background: var(--red-dark);
    }

    .btn-secondary {
        background: #eee6e5;
        color: var(--text);
    }

    .btn-secondary:hover {
        background: #dfd2d0;
    }

    a {
        color: var(--jam);
    }

    a:hover {
        color: var(--mulberry);
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
        background: var(--off-white);
        border: 1px solid var(--border);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(143, 70, 65, 0.08);
    }

    th {
    padding: 16px 18px;
    background: var(--soft-gray);
    color: var(--dark-text);
    text-align: left;
    font-size: 14px;
    font-weight: 700;
}

    td {
        padding: 16px 18px;
        border-top: 1px solid var(--border);
        color: var(--text);
        vertical-align: middle;
    }

    tr:hover td {
        background: #fff4f2;
    }

    td form {
        display: inline;
        width: auto;
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        background: transparent;
    }

    .validation-errors {
        width: min(100%, 560px);
        margin: 0 auto 20px;
        padding: 12px 16px;
        border-radius: 8px;
        background: #fff0f0;
        color: var(--red-dark);
    }

    .success-message {
        margin: 0 auto 22px;
        text-align: center;
        color: var(--green-dark);
        font-weight: 600;
    }
    .cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
    margin-top: 24px;
}

.card {
    padding: 26px;
    background: var(--off-white);
    border: 1px solid var(--border);
    border-radius: 14px;
    box-shadow: 0 8px 24px rgba(143, 70, 65, 0.09);
    text-align: center;
}

.card h3 {
    margin: 0 0 12px;
    color: var(--muted);
    font-size: 15px;
    font-weight: 600;
}

.card p {
    margin: 0;
    color: var(--jam);
    font-size: 34px;
    font-weight: 700;
}
.navbar a.active {
    padding: 9px 14px;
    border-radius: 7px;
    background: var(--off-white);
    color: var(--charcoal);
}

.navbar a.active:hover {
    color: var(--charcoal);
    background: #ffffff;
}

.btn {
    display: inline-block;
    padding: 10px 16px;
    border-radius: 7px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    transition: 0.2s ease;
}

.btn-add {
    background: var(--charcoal);
    color: var(--off-white) !important;
}

.btn-add:hover {
    background: #454752;
}

.btn-edit {
    background: #4c78a8;
    color: white !important;
}

.btn-edit:hover {
    background: #3b628d;
}

.btn-delete {
    background: var(--red);
    color: white;
}

.btn-delete:hover {
    background: var(--red-dark);
}

td .btn {
    margin-right: 6px;
}

.dashboard-welcome {
    margin: -10px 0 34px;
    text-align: center;
    color: var(--dark-text);
    font-size: 18px;
}
    @media (max-width: 700px) {
        .navbar {
            padding: 18px 22px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .navbar .brand {
            width: 100%;
        }

        .container {
            margin: 35px auto;
        }

        table {
            display: block;
            overflow-x: auto;
        }
        
    }
</style>
</head>
<body>

    <nav class="navbar">
        <a href="{{ url('/dashboard') }}"
   class="{{ request()->is('dashboard') ? 'active' : '' }}">
    Dashboard
</a>

<a href="{{ url('/products') }}"
   class="{{ request()->is('products*') ? 'active' : '' }}">
    Products
</a>

<a href="{{ url('/customers') }}"
   class="{{ request()->is('customers*') ? 'active' : '' }}">
    Customers
</a>

<a href="{{ url('/users') }}"
   class="{{ request()->is('users*') ? 'active' : '' }}">
    Staff
</a>

<a href="{{ url('/sales') }}"
   class="{{ request()->is('sales*') ? 'active' : '' }}">
    Sales
</a>
    </nav>

    <main class="container">
        @yield('content')
    </main>

</body>
</html>