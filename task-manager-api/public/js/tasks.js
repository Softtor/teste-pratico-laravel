document.addEventListener("DOMContentLoaded", function () {
    const apiUrl = "/api/tasks";
    const token = localStorage.getItem("auth_token");

    if (!token) {
        window.location.href = "/login";
    }

    const taskList = document.getElementById("taskList");
    const taskForm = document.getElementById("taskForm");
    const titleInput = document.getElementById("title");
    const categoryInput = document.getElementById("category_id");
    const descriptionInput = document.getElementById("description");

    fetch("/api/categories", {
        headers: { Authorization: `Bearer ${token}` },
    })
        .then((response) => response.json())
        .then((categories) => {
            categories.forEach((category) => {
                let option = document.createElement("option");
                option.value = category.id;
                option.textContent = category.name;
                categoryInput.appendChild(option);
            });
        });

    function loadTasks() {
        taskList.innerHTML =
            "<p class='text-gray-500'>Carregando tarefas...</p>";

        fetch(apiUrl, {
            headers: { Authorization: `Bearer ${token}` },
        })
            .then((response) => response.json())
            .then((tasks) => {
                taskList.innerHTML = "";
                if (tasks.length === 0) {
                    taskList.innerHTML =
                        "<p class='text-gray-500'>Nenhuma tarefa encontrada.</p>";
                    return;
                }

                tasks.forEach((task) => {
                    let taskItem = document.createElement("div");
                    taskItem.classList.add(
                        "bg-white",
                        "p-4",
                        "rounded",
                        "shadow",
                        "flex",
                        "justify-between",
                        "items-center"
                    );

                    taskItem.innerHTML = `
                    <div>
                        <p class="text-lg font-semibold">${task.title}</p>
                        <p class="text-sm text-gray-600">${
                            task.description || "Sem descrição"
                        }</p>
                    </div>
                    <div>
                        <button class="bg-yellow-500 text-white px-3 py-1 rounded editTaskBtn" data-id="${
                            task.id
                        }">Editar</button>
                        <button class="bg-red-600 text-white px-3 py-1 rounded deleteTaskBtn" data-id="${
                            task.id
                        }">Excluir</button>
                    </div>
                `;

                    taskList.appendChild(taskItem);
                });

                document.querySelectorAll(".editTaskBtn").forEach((button) => {
                    button.addEventListener("click", editTask);
                });

                document
                    .querySelectorAll(".deleteTaskBtn")
                    .forEach((button) => {
                        button.addEventListener("click", deleteTask);
                    });
            });
    }

    taskForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let taskData = {
            title: titleInput.value,
            description: descriptionInput.value,
            category_id: categoryInput.value,
            status: "pending",
        };

        fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify(taskData),
        })
            .then((response) => response.json())
            .then((task) => {
                loadTasks();
                taskForm.reset();
            });
    });

    function editTask(event) {
        let taskId = event.target.dataset.id;
        let newTitle = prompt("Novo título:");

        if (!newTitle) return;

        fetch(`${apiUrl}/${taskId}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                Authorization: `Bearer ${token}`,
            },
            body: JSON.stringify({ title: newTitle }),
        })
            .then((response) => response.json())
            .then(() => {
                loadTasks();
            });
    }

    function deleteTask(event) {
        let taskId = event.target.dataset.id;
        if (!confirm("Deseja excluir esta tarefa?")) return;

        fetch(`${apiUrl}/${taskId}`, {
            method: "DELETE",
            headers: { Authorization: `Bearer ${token}` },
        }).then(() => {
            loadTasks();
        });
    }

    loadTasks();
});
