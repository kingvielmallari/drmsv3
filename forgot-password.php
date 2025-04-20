<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="./vendor/bootstrapv5/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<header class="text-white text-center">
    <nav class="navbar navbar-expand-lg navbar-light bg-success fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white d-flex align-items-center" href="index.php">
                <img src="./assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
                <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#" style="font-size: 1.1rem;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" style="font-size: 1.1rem;">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#" style="font-size: 1.1rem;">Contact</a>
                    </li>
                    <li class="nav-item">
                        <div class="form-check form-switch d-flex align-items-center">
                            <input class="form-check-input me-2" type="checkbox" id="themeToggle">
                            <label class="form-check-label text-white" for="themeToggle" style="font-size: 1.1rem;">
                                <i class="bi bi-moon-fill"></i>
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container d-flex justify-content-center align-items-center flex-grow-1">
    <div class="row justify-content-center align-self-center w-100">
        <div class="col-md-6">
            <h2 class="text-center">Forgot Password</h2>
            <p class="text-center text-muted">Enter your registered email address to reset your password.</p>
            <form id="forgotPasswordForm">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    <label for="email">Email Address</label>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
            </form>
            <p id="response" class="text-center mt-3"></p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-success text-white text-center py-1 mt-auto">
    &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
</footer>


<script>
    document.getElementById("forgotPasswordForm").addEventListener("submit", async function(e) {
        e.preventDefault();

        const email = document.getElementById("email").value;
        const formData = new FormData();
        formData.append("email", email);

        const submitButton = e.target.querySelector("button[type='submit']");
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...';

        try {
            const res = await fetch("./controllers/ForgotPassword.php", {
                method: "POST",
                body: formData
            });

            const text = await res.text();
            const responseElement = document.getElementById("response");
            responseElement.textContent = text;

            if (text.includes("You are not a student of PTC.")) {
                responseElement.className = "text-center text-danger";
                setTimeout(() => {
                    responseElement.textContent = "";
                }, 2500);
            }

            if (text.includes("A reset link has already been sent. Please check your email.")) {
                responseElement.className = "text-center text-success";
            }

            if (res.ok && text.includes("Reset link sent!")) {
                responseElement.className = "text-center text-success";
                submitButton.classList.remove("btn-primary");
                submitButton.classList.add("btn-success");
                submitButton.innerHTML = "Email Sent!";
                submitButton.disabled = true;
            }
        } catch (error) {
            console.error("Error:", error);
        } finally {
            if (!submitButton.classList.contains("btn-success")) {
                submitButton.disabled = false;
                submitButton.innerHTML = "Submit";
            }
        }
    });

</script>
<!-- <script src="./js/forgotPassword.js"></script> -->
<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

</body>
</html>
