document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#userForm").addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        try {
            const response = await fetch("login/login.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json(); // Expect JSON response

            if (result.success) {
                window.location.href = "login/dashboard.php"; // 🔥 Redirect on success
            } else {
                document.querySelector("#response").textContent = result.message;
            }

        } catch (error) {
            console.error("Error:", error);
        }
    });
});




document.getElementById('themeToggle').addEventListener('change', function() {
    if (this.checked) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        document.cookie = "theme=dark; path=/";
    } else {
        document.documentElement.removeAttribute('data-bs-theme');
        document.cookie = "theme=light; path=/";
    }
});

window.addEventListener('load', function() {
    const theme = document.cookie.split(';').find((item) => item.trim().startsWith('theme='));
    if (theme) {
        const themeValue = theme.split('=')[1];
        if (themeValue === 'dark') {
            document.documentElement.setAttribute('data-bs-theme', 'dark');
            document.getElementById('themeToggle').checked = true;
        } else {
            document.documentElement.removeAttribute('data-bs-theme');
            document.getElementById('themeToggle').checked = false;
        }
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const emailInput = document.getElementById("email");

    emailInput.addEventListener("input", async function () {
        const email = emailInput.value.trim();

        if (email.length > 1) { // Prevent unnecessary requests for short inputs
            try {
                const response = await fetch("check_email.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "email=" + encodeURIComponent(email),
                });

                const result = await response.json();

                if (result.exists) {
                    emailInput.classList.remove("is-invalid");
                    emailInput.classList.add("is-valid");
                } else {
                    emailInput.classList.remove("is-valid");
                    emailInput.classList.add("is-invalid");
                }
            } catch (error) {
                console.error("Error:", error);
            }
        } else {
            emailInput.classList.remove("is-valid", "is-invalid");
        }
    });
});
