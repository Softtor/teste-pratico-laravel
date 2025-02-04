@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">Acesse sua conta</h2>

        <form id="loginForm">
            <div class="mb-3">
                <input type="email" id="email" class="w-full p-2 border rounded" placeholder="E-mail">
                <p class="text-red-500 text-sm hidden" id="emailError"></p>
            </div>

            <div class="mb-3">
                <input type="password" id="password" class="w-full p-2 border rounded" placeholder="Senha">
                <p class="text-red-500 text-sm hidden" id="passwordError"></p>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Entrar
            </button>

            <p class="mt-4 text-red-600 hidden" id="loginError">Erro ao tentar fazer login.</p>
        </form>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
@endsection
