document.addEventListener("DOMContentLoaded", async function () {
    const token = localStorage.getItem("auth_token");
    if (!token) {
        window.location.href = "/login";
        return;
    }

    async function fetchTasks() {
        try {
            const response = await fetch("/api/tasks", {
                method: "GET",
                headers: { Authorization: `Bearer ${token}` },
            });
            const tasks = await response.json();
            renderTasks(tasks);
        } catch (error) {
            console.error("Erro ao buscar tarefas:", error);
        }
    }

    function renderTasks(tasks) {
        const tableBody = document.getElementById("tasksTable");
        tableBody.innerHTML = "";

        let pending = 0,
            progress = 0,
            done = 0;

        tasks.forEach((task) => {
            if (task.status === "pending") pending++;
            if (task.status === "in progress") progress++;
            if (task.status === "done") done++;

            tableBody.innerHTML += `
                <tr>
                    <td class="border p-2">${task.title}</td>
                    <td class="border p-2">${task.category.name}</td>
                    <td class="border p-2">${task.status}</td>
                    <td class="border p-2">${new Date(
                        task.created_at
                    ).toLocaleDateString()}</td>
                    <td class="border p-2 text-center">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded editTask" data-id="${
                            task.id
                        }">Editar</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded deleteTask" data-id="${
                            task.id
                        }">Excluir</button>
                    </td>
                </tr>`;
        });

        document.getElementById("pendingCount").textContent = pending;
        document.getElementById("progressCount").textContent = progress;
        document.getElementById("doneCount").textContent = done;
    }

    document.getElementById("newTaskBtn").addEventListener("click", () => {
        document.getElementById("taskModal").classList.remove("hidden");
    });

    document.getElementById("closeModal").addEventListener("click", () => {
        document.getElementById("taskModal").classList.add("hidden");
    });

    fetchTasks();
});

document.getElementById("newTaskBtn").addEventListener("click", () => {
    document.getElementById("taskModal").classList.remove("hidden");
    document.getElementById("taskModal").classList.add("flex");
});

document.getElementById("closeModal").addEventListener("click", () => {
    document.getElementById("taskModal").classList.remove("flex");
    document.getElementById("taskModal").classList.add("hidden");
});

