<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="/css/app.css" rel="stylesheet">
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
</head>
<body class="{{Route::is('admin*') ? 'admin-layout' : 'app-layout' }}">
@inertia
</body>
</html>
