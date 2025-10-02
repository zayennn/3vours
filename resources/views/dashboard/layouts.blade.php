<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | @yield('title')</title>
    <link rel="web icon" type="png" href="{{ asset('assets/images/logo-web.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        @include('dashboard.components.aside')

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            @include('dashboard.components.header')

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('assets/js/dashboard/script.js') }}"></script>
</body>

</html>