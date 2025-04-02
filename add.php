<?php include('components/header.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="app.css">
  
</head>
<body>
<div class="container d-flex vh-100">
<div class="row justify-content-center align-self-center w-100">
<div class="col-md-6">
<h2 class="text-center">Add New User</h2>
<form id="userForm">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="name" id="floatingName" placeholder="Name" required>
        <label for="floatingName">Name</label>
    </div>
    <div class="form-floating mb-3">
        <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="name@example.com" required>
        <label for="floatingEmail">Email address</label>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
    </div>
    <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary btn-block">Register</button>
    </div>
</form>
<p id="response" class="text-center mt-3 text-danger"></p>
</div>
</div>
</div>
</div>



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
