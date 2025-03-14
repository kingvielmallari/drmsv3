
document.addEventListener("DOMContentLoaded", () => {

    const fetchUsers = async () => {
        try {
            const response = await fetch("fetch.php"); // The PHP file to fetch users
            const result = await response.text(); // Get the result from PHP

            // Update the table with the fetched data
            document.querySelector("#userTable tbody").innerHTML = result;
        } catch (error) {
            console.error("Error:", error);
        }
    };

    // Initial fetch when the page loads
    fetchUsers();

    // Optionally, set an interval to refresh the data (e.g., every 5 seconds)
    setInterval(fetchUsers, 1000); // Refresh every 5 seconds
});

