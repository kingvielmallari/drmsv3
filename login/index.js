
    document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#userForm").addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        try {
            const response = await fetch("./student-login.php", {
                method: "POST",
                body: formData,
            });

            let result;
            try {
                result = await response.json(); // Attempt to parse JSON response
            } catch (error) {
                console.error("Invalid JSON response:", error);
                document.querySelector("#response").textContent = "An error occurred. Please try again.";
                return;
            }

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


