# teste-pratico-laravel
Teste prático dev PHP/Laravel

Objetivo
Desenvolver uma API RESTful para gerenciar um sistema de tarefas.

Requisitos
**1. Funcionalidades**
- Autenticação: Implementar login e registro de usuários utilizando Laravel Sanctum.
- CRUD de Tarefas: Criar, listar, editar e excluir tarefas.
- Categorias: Cada tarefa deve pertencer a uma categoria.
- Filtragem e Ordenação: Permitir filtrar as tarefas por categoria e ordenar por data de criação.

**2. Regras de Negócio**
- Um usuário só pode visualizar, editar e excluir suas próprias tarefas.
- O título da tarefa é obrigatório e deve ter no mínimo 5 caracteres.
- O status da tarefa pode ser: pendente, em andamento ou concluído.

**3. Tecnologias e Ferramentas**
- Laravel 10+
- Laravel Sanctum (para autenticação)
- Eloquent ORM
- Banco de dados: MySQL ou SQLite
- Testes com PHPUnit ou Pest
- Docker (opcional)

**Entrega Esperada**
- Código hospedado em um repositório público (GitHub/GitLab/Bitbucket).
- Um README.md contendo:
- Passos para instalar e rodar o projeto.
- Endpoints disponíveis e exemplos de requisição.
- Scripts de migração e seeders para popular o banco.
- Testes unitários e/ou de integração para validar as funcionalidades principais.

**Diferenciais (Opcional)**
- Utilizar Laravel Policy para controle de permissões.
- Implementar Swagger para documentação da API.
- Criar uma solução desacoplada utilizando Repositories e Service Layer.
