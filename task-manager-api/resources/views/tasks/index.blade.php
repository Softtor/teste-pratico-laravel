@extends('layouts.app')

@section('title', 'Minhas Tarefas')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Minhas Tarefas</h2>

    <div class="bg-white p-6 rounded shadow mb-4">
        <h3 class="text-lg font-semibold mb-2">Nova Tarefa</h3>
        <form id="taskForm">
            <input type="text" id="title" class="w-full p-2 border mb-3" placeholder="Título da tarefa">
            <select id="category_id" class="w-full p-2 border mb-3">
                <option value="">Selecione uma categoria</option>
            </select>
            <textarea id="description" class="w-full p-2 border mb-3" placeholder="Descrição (opcional)"></textarea>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Criar Tarefa</button>
        </form>
    </div>

    <div id="taskList" class="space-y-4">
        <p class="text-gray-500">Carregando tarefas...</p>
    </div>

    <script src="{{ asset('js/tasks.js') }}"></script>
@endsection
