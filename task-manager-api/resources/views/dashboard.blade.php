@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-3xl font-bold mb-6 text-center">Minhas Tarefas</h2>

        <div class="flex justify-between mb-4">
            <select id="categoryFilter" class="p-2 border rounded">
                <option value="">Todas as Categorias</option>
            </select>

            <select id="statusFilter" class="p-2 border rounded">
                <option value="">Todos os Status</option>
                <option value="pending">Pendente</option>
                <option value="in progress">Em Andamento</option>
                <option value="done">Concluído</option>
            </select>

            <button id="newTaskBtn" class="bg-green-600 text-white px-4 py-2 rounded">+ Nova Tarefa</button>
        </div>

        <div class="grid grid-cols-3 gap-4 text-white text-center">
            <div class="bg-yellow-500 p-4 rounded">
                <p class="text-xl font-bold" id="pendingCount">0</p>
                <p>Pendentes</p>
            </div>
            <div class="bg-blue-500 p-4 rounded">
                <p class="text-xl font-bold" id="progressCount">0</p>
                <p>Em Andamento</p>
            </div>
            <div class="bg-green-500 p-4 rounded">
                <p class="text-xl font-bold" id="doneCount">0</p>
                <p>Concluídas</p>
            </div>
        </div>

        <table class="w-full mt-6 border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Título</th>
                    <th class="border p-2">Categoria</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Criado em</th>
                    <th class="border p-2">Ações</th>
                </tr>
            </thead>
            <tbody id="tasksTable">
                <tr>
                    <td colspan="5" class="text-center p-4">Carregando...</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="taskModal" class="hidden fixed inset-0 bg-black bg-opacity-50  justify-center items-center">
        <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-bold mb-4">Nova Tarefa</h2>
            <form id="taskForm">
                <input type="text" id="taskTitle" class="w-full p-2 border mb-3" placeholder="Título">
                <select id="taskCategory" class="w-full p-2 border mb-3"></select>
                <select id="taskStatus" class="w-full p-2 border mb-3">
                    <option value="pending">Pendente</option>
                    <option value="in progress">Em Andamento</option>
                    <option value="done">Concluído</option>
                </select>
                <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded">Salvar</button>
            </form>
            <button id="closeModal" class="w-full bg-red-600 text-white p-2 rounded mt-3">Fechar</button>
        </div>
    </div>

    <script src="/js/dashboard.js"></script>
@endsection
