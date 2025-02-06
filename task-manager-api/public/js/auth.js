document.addEventListener("DOMContentLoaded", function () {
    const token = localStorage.getItem("auth_token");

    if (token) {
        document.getElementById("logoutBtn").classList.remove("hidden");
        document.getElementById("loginLink").classList.add("hidden");
        document.getElementById("registerLink").classList.add("hidden");
    } else {
        document.getElementById("logoutBtn").classList.add("hidden");
        document.getElementById("loginLink").classList.remove("hidden");
        document.getElementById("registerLink").classList.remove("hidden");
    }

    document.getElementById("logoutBtn").addEventListener("click", function () {
        fetch("/api/logout", {
            method: "POST",
            headers: { Authorization: `Bearer ${token}` },
        }).then(() => {
            localStorage.removeItem("auth_token");
            window.location.href = "/login";
        });
    });

    const protectedRoutes = ["/dashboard", "/tasks"];
    if (protectedRoutes.includes(window.location.pathname) && !token) {
        window.location.href = "/login";
    }

    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", async function (e) {
            e.preventDefault();

            document.getElementById("emailError").classList.add("hidden");
            document.getElementById("passwordError").classList.add("hidden");
            document.getElementById("loginError").classList.add("hidden");

            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();

            if (!email) {
                document.getElementById("emailError").textContent =
                    "O campo e-mail é obrigatório.";
                document
                    .getElementById("emailError")
                    .classList.remove("hidden");
                return;
            }
            if (!password) {
                document.getElementById("passwordError").textContent =
                    "O campo senha é obrigatório.";
                document
                    .getElementById("passwordError")
                    .classList.remove("hidden");
                return;
            }

            try {
                const response = await fetch("/api/login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                    },
                    body: JSON.stringify({ email, password }),
                });

                const data = await response.json();

                if (!response.ok) {
                    if (response.status === 422) {
                        if (data.errors) {
                            if (data.errors.email) {
                                document.getElementById(
                                    "emailError"
                                ).textContent = data.errors.email[0];
                                document
                                    .getElementById("emailError")
                                    .classList.remove("hidden");
                            }
                            if (data.errors.password) {
                                document.getElementById(
                                    "passwordError"
                                ).textContent = data.errors.password[0];
                                document
                                    .getElementById("passwordError")
                                    .classList.remove("hidden");
                            }
                        }
                    } else if (response.status === 401) {
                        document.getElementById("loginError").textContent =
                            "E-mail ou senha inválidos.";
                        document
                            .getElementById("loginError")
                            .classList.remove("hidden");
                    }
                    return;
                }

                if (data.token) {
                    localStorage.setItem("auth_token", data.token);
                    window.location.href = "/dashboard";
                }
            } catch (error) {
                console.log(error)
                document.getElementById("loginError").textContent =
                    "Erro ao conectar ao servidor.";
                document
                    .getElementById("loginError")
                    .classList.remove("hidden");
            }
        });
    }

    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", async function (e) {
            e.preventDefault();
            resetErrors();

            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const password_confirmation = document
                .getElementById("password_confirmation")
                .value.trim();

            if (!name) showError("nameError", "O campo nome é obrigatório.");
            if (!email)
                showError("emailError", "O campo e-mail é obrigatório.");
            if (!password)
                showError("passwordError", "O campo senha é obrigatório.");
            if (!password_confirmation)
                showError("passwordConfirmationError", "Confirme sua senha.");
            if (password !== password_confirmation) {
                showError(
                    "passwordConfirmationError",
                    "As senhas não coincidem."
                );
            }
            if (
                !name ||
                !email ||
                !password ||
                password !== password_confirmation
            )
                return;

            try {
                const response = await fetch("/api/register", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                    },
                    body: JSON.stringify({
                        name,
                        email,
                        password,
                        password_confirmation,
                    }),
                });

                const data = await response.json();

                if (!response.ok) {
                    handleErrors(response, data);
                    return;
                }

                if (data.token) {
                    localStorage.setItem("auth_token", data.token);
                    window.location.href = "/dashboard";
                }
            } catch (error) {
                console.log(error.message);
                showError("registerError", "Erro ao conectar ao servidor.");
            }
        });
    }

    function showError(id, message) {
        const errorElement = document.getElementById(id);
        errorElement.textContent = message;
        errorElement.classList.remove("hidden");
    }

    function resetErrors() {
        document
            .querySelectorAll("p.text-red-500")
            .forEach((el) => el.classList.add("hidden"));
        document
            .querySelectorAll("p.text-red-600")
            .forEach((el) => el.classList.add("hidden"));
    }

    function handleErrors(response, data) {
        if (response.status === 422 && data.errors) {
            Object.keys(data.errors).forEach((field) => {
                showError(`${field}Error`, data.errors[field][0]);
            });
        } else if (response.status === 401) {
            showError("loginError", "E-mail ou senha inválidos.");
        } else {
            showError("registerError", "Erro ao processar requisição.");
        }
    }
});
