
document.addEventListener("DOMContentLoaded", () => {

    const fetchUsers = async () => {
        try {
            const response = await fetch("fetch.php"); // The PHP file to fetch users
            const result = await response.text(); // Get the result from PHP

            // Update the table with the fetched data
            document.querySelector("#userTableBody").innerHTML = result;
        } catch (error) {
            console.error("Error:", error);
        }
    };

    // Initial fetch when the page loads
    fetchUsers();

    // Optionally, set an interval to refresh the data (e.g., every 5 seconds)
    setInterval(fetchUsers, 2300); // Refresh every 5 seconds
});



document.addEventListener("DOMContentLoaded", function () {
    // Select all delete buttons
    document.querySelectorAll(".deleteBtn").forEach(button => {
        button.addEventListener("click", function () {
            let studentId = this.getAttribute("data-id");
            let row = this.closest("tr");  // Get the row to remove after deletion

            if (confirm("Are you sure you want to delete this student?")) {
                fetch("delete_student.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "id=" + encodeURIComponent(studentId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        row.remove();  // Remove the row from the table
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});

