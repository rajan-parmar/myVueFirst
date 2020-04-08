<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    @stack('styles')
</head>
<body>
    <div class="container">
        @yield('contents')
    </div>
    <script src="/js/vue.js"></script>
    <script src="/js/axios.min.js"></script>
    @stack('scripts')
</body>
</html>
