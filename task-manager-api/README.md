# Task Manager API

Este projeto é uma API RESTful desenvolvida com Laravel 11 para gerenciar tarefas.

## 🛠 Tecnologias Utilizadas
- **PHP 8.2** (Laravel 11)
- **MySQL 8.0**
- **Laravel Sanctum** (para autenticação via API Token)
- **Eloquent ORM**
- **Docker + Docker Compose**
- **TailwindCSS** (para o frontend Blade)
- **Swagger** (Documentação da API)

## 📌 Funcionalidades
- **Autenticação**: Registro, login e logout de usuários com Laravel Sanctum.
- **Gerenciamento de Tarefas**:
  - Criar, listar, atualizar e excluir tarefas.
  - Cada tarefa pertence a uma categoria.
  - Filtro por categoria e ordenação por data de criação.
- **Regras de Negócio**:
  - Usuário só pode gerenciar suas próprias tarefas.
  - O título da tarefa é obrigatório e deve ter pelo menos 5 caracteres.
  - O status da tarefa pode ser: `pendente`, `em andamento` ou `concluído`.

## 🚀 Como Rodar o Projeto

### 🔹 1. Pré-requisitos
Antes de iniciar, verifique se você tem as seguintes dependências instaladas:
- **Docker** e **Docker Compose**
- **Make** (Opcional, para atalhos de comandos)

### 🔹 2. Clonar o repositório
```bash
git clone https://github.com/seu-usuario/task-manager-api.git
cd task-manager-api
```

### 🔹 3. Configurar o ambiente
Copie o arquivo de variáveis de ambiente e edite conforme necessário:
```bash
cp .env.example .env
```

No arquivo `.env`, configure as credenciais do banco de dados:
```ini
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### 🔹 4. Subir os containers Docker
Para iniciar o ambiente com Docker, execute:
```bash
docker compose up -d
```
Isso iniciará os serviços **MySQL** e **PHP-FPM**.

### 🔹 5. Instalar dependências
Com os containers rodando, instale as dependências do projeto:
```bash
docker compose exec app composer install
```

### 🔹 6. Gerar chave da aplicação
```bash
docker compose exec app php artisan key:generate
```

### 🔹 7. Rodar migrations e seeders
```bash
docker compose exec app php artisan migrate --seed
```
Isso criará as tabelas e populá-las com alguns dados iniciais.

### 🔹 8. Rodar o servidor Laravel
Para rodar o servidor de desenvolvimento:
```bash
docker compose exec app php artisan serve
```
Acesse a aplicação em [http://localhost:8000](http://localhost:8000).



## 📝 Documentação da API (Swagger)
A documentação da API está disponível em:
```
http://localhost:8000/api/documentation
```

Para gerar ou atualizar a documentação, execute:
```bash
docker compose exec app php artisan l5-swagger:generate
```



## 🚧 Problemas Conhecidos
- **Nginx**: O projeto atualmente não possui um servidor Nginx configurado no Docker.
  - Para rodar a aplicação, use `php artisan serve` dentro do container.
- **Front-end**: O frontend do projeto ainda se encontra em desenvolvimento, porém o fundamento do projeto que era a api foi entregue. Uma previa do frontend do projeto pode ser obtido acessando `http://localhost:8000`.

## 📌 Endpoints da API
### 🔹 Autenticação
**Registro:**
```http
POST /api/register
```
**Login:**
```http
POST /api/login
```
**Logout:**
```http
POST /api/logout
```

### 🔹 Tarefas
**Listar Tarefas:**
```http
GET /api/tasks
```
**Criar Tarefa:**
```http
POST /api/tasks
```
**Atualizar Tarefa:**
```http
PUT /api/tasks/{task_id}
```
**Excluir Tarefa:**
```http
DELETE /api/tasks/{task_id}
```


