@extends('layouts.app')

@section('title', 'Registrar')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">Crie sua conta</h2>

        <form id="registerForm">
            <div class="mb-3">
                <input type="text" id="name" class="w-full p-2 border rounded" placeholder="Nome">
                <p class="text-red-500 text-sm hidden" id="nameError"></p>
            </div>

            <div class="mb-3">
                <input type="email" id="email" class="w-full p-2 border rounded" placeholder="E-mail">
                <p class="text-red-500 text-sm hidden" id="emailError"></p>
            </div>

            <div class="mb-3">
                <input type="password" id="password" class="w-full p-2 border rounded" placeholder="Senha">
                <p class="text-red-500 text-sm hidden" id="passwordError"></p>
            </div>

            <div class="mb-3">
                <input type="password" id="password_confirmation" class="w-full p-2 border rounded" placeholder="Confirme a senha">
                <p class="text-red-500 text-sm hidden" id="passwordConfirmationError"></p>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">
                Registrar
            </button>

            <p class="mt-4 text-red-600 hidden" id="registerError">Erro ao registrar usuário.</p>
        </form>
    </div>

    <script src="{{ asset('js/auth.js') }}"></script>
@endsection
