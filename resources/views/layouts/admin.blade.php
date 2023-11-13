<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Your Application Name</title>
    <!-- Add your admin panel CSS styles and dependencies here -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <!-- Admin Navigation Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <!-- Add navigation links for different admin features, e.g., Feedback, Categories, Users, etc. -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.feedback.index') }}">Feedback</a>
            </li>
            <!-- Add other navigation links as needed -->
        </ul>
    </nav>

    <div class="container">
        @yield('content') <!-- This is where the content from admin views will be injected -->
    </div>

    <!-- Add admin panel-specific scripts and dependencies here -->
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
