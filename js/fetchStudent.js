// fetch 2secs
document.addEventListener("DOMContentLoaded", () => {
    const fetchUsers = async () => {
        try {
            const response = await fetch("fetch.php");
            document.querySelector("#userTableBody").innerHTML = await response.text();
        } catch (error) {
            console.error("Error:", error);
        }
    };
    
    fetchUsers();
    setInterval(fetchUsers, 1000);
});


    document.body.addEventListener("click", async (e) => {
        const btn = e.target.closest(".deleteBtn");
        if (btn) {
            btn.closest("tr")?.remove();
            try {
                const res = await fetch("delete.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `student_id=${encodeURIComponent(btn.dataset.id)}`
                });
                const data = await res.json();
                if (!data.success) fetchUsers();
            } catch {
                fetchUsers();
            }
        }
    });

    // Add Student AJAX
document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#addStudentForm").addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(e.target);

        try {
            const response = await fetch("add-student.php", {
                method: "POST",
                body: formData,
            });

            const result = await response.json(); // Expect JSON response

            if (result.success) {
                document.querySelector("#response2").textContent = result.message;
            } else {
                document.querySelector("#response2").textContent = result.message;
            }

           
        } catch (error) {
            console.error("Error:", error);
        }
    });
});
