<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
  
</head>
<body>

    <h2>Add New User</h2>
    <form id="userForm">
        <label for="name-label">Name:</label>
        <input type="text" id="name-label" name="name" required><br><br>

        <label>Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <p id="response"></p>




    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector("#userForm").addEventListener("submit", async (e) => {
                e.preventDefault();

                const formData = new FormData(e.target);

                try {
                    const response = await fetch("process.php", {
                        method: "POST",
                        body: formData,
                    });

                    const result = await response.text();
                    document.querySelector("#response").textContent = result;
                    e.target.reset();
                } catch (error) {
                    console.error("Error:", error);
                }
            });
        });
    </script>

</body>
</html>
