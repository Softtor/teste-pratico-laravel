<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-blue-600 text-white p-4 flex justify-between">
        <a href="{{ route('dashboard') }}" class="text-lg font-bold">Task Manager</a>
        <div id="authLinks">
            <a href="{{ route('login') }}" class="px-4 hidden" id="loginLink">Entrar</a>
            <a href="{{ route('registro') }}" class="px-4 hidden" id="registerLink">Registrar</a>
            <button class="bg-red-500 px-4 py-1 rounded hidden" id="logoutBtn">Sair</button>
        </div>
    </nav>

    <div class="container mx-auto mt-10">
        @yield('content')
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
    @vite(['resources/js/app.js'])
</body>
</html>
