<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>SaaS Landing Page</title>
    <meta content="Saas Landing page" name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Theme favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/card3d@2.6.5/dist/card3d.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<livewire:auth.login />
<livewire:auth.password.recovery />
<livewire:partials.top-bar />

{{ $slot }}

<x-partials.footer />
<x-partials.theme-toggle />
</body>
</html>
