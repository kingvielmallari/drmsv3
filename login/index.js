
document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#userForm").addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        try {
            const response = await fetch("login/student-login.php", {
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


// Toggle Password Visibility
document.getElementById('togglePassword').addEventListener('mousedown', function () {
    const passwordInput = document.getElementById('password');
    passwordInput.setAttribute('type', 'text');
    this.classList.add('bi-eye-slash');
    this.classList.remove('bi-eye');
});

document.getElementById('togglePassword').addEventListener('mouseup', function () {
    const passwordInput = document.getElementById('password');
    passwordInput.setAttribute('type', 'password');
    this.classList.add('bi-eye');
    this.classList.remove('bi-eye-slash');
});

document.getElementById('togglePassword').addEventListener('mouseleave', function () {
    const passwordInput = document.getElementById('password');
    passwordInput.setAttribute('type', 'password');
    this.classList.add('bi-eye');
    this.classList.remove('bi-eye-slash');
});


// Change Theme
document.getElementById('themeToggle').addEventListener('change', function() {
    if (this.checked) {
        document.documentElement.setAttribute('data-bs-theme', 'dark');
        document.cookie = "theme=dark; path=/";
    } else {
        document.documentElement.removeAttribute('data-bs-theme');
        document.cookie = "theme=light; path=/";
    }
});


// Load Theme from Cookie
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

// Privacy Policy Modal
document.addEventListener('DOMContentLoaded', function () {
  var privacyModal = new bootstrap.Modal(document.getElementById('privacyModal'));
  privacyModal.show();
  });
