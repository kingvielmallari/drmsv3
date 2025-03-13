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
