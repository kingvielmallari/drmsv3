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
  <div class="container-fluid ">
    <a class="navbar-brand text-white d-none d-lg-flex align-items-center" href="index.php"> 
      <img src="./assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;" class="me-3">
      <span style="font-size: 1.50rem; line-height: 60px;">Pateros Technological College</span>
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="d-lg-none d-flex justify-content-center">
      <a class="navbar-brand text-white d-flex align-items-center" href="index.php">
        <img src="./assets/images/logo.png" alt="PTC Logo" style="width: 60px; height: 60px;">
      </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="#" style="font-size: 1.1rem;">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#" style="font-size: 1.1rem;">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#" style="font-size: 1.1rem;">Contasct</a>
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
        <div id="ptcemail" class="col-md-6">
            <h2 class="text-center">Verify PTC Student Email</h2>
            <p class="text-center text-muted">Enter your institutional email address to create account.</p>
            <form id="forgotPasswordForm">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email" required>
                    <label for="email">Email Address</label>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Verify</button>
                </div>
            </form>
            <p id="response" class="text-center mt-3"></p>
            <p class="text-center mt-3">
                Don't active have a PTC account?
                <a id="createPersonalAccountLink" class="text-decoration-underline" style="cursor: pointer;"> Create using personal email here.</a>
            </p>
        </div>
        
        <div id="personalemail" style="display: none;" class="col-md-6">
            <h2 class="text-center">Enter Personal Email</h2>
            <p class="text-center text-muted">Enter your personal email address to create account.</p>
            <form id="forgotPasswordForm2">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="email2" id="email" placeholder="Email" required>
                    <label for="email">Email Address</label>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Verify</button>
                </div>
            </form>
            <p id="response2" class="text-center mt-3"></p>
            <p class="text-center mt-3">
                Have an active PTC account?
                <a id="createPTCAccountLink" class="text-decoration-underline" style="cursor: pointer;"> Create using PTC email here.</a>
            </p>
        </div>
    </div>
</div>

<script>
    document.getElementById("createPersonalAccountLink").addEventListener("click", function () {
        document.getElementById("ptcemail").style.display = "none";
        document.getElementById("personalemail").style.display = "block";
    });

    document.getElementById("createPTCAccountLink").addEventListener("click", function () {
        document.getElementById("ptcemail").style.display = "block";
        document.getElementById("personalemail").style.display = "none";
    });
</script>

        
   

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const emailInput = document.getElementById("email");
        const domain = "@paterostechnologicalcollege.edu.ph";

        // Set default value with domain
        emailInput.value = domain;

        // Update input value on user input
        emailInput.addEventListener("input", function () {
            if (!emailInput.value.endsWith(domain)) {
                const userInput = emailInput.value.replace(domain, "");
                emailInput.value = userInput + domain;
            }
        });

        // Ensure cursor stays before the domain
        emailInput.addEventListener("keydown", function (e) {
            const cursorPosition = emailInput.selectionStart;
            if (cursorPosition > emailInput.value.length - domain.length) {
                emailInput.setSelectionRange(emailInput.value.length - domain.length, emailInput.value.length - domain.length);
            }
        });
    });
</script>

<!-- Footer -->
<footer class="bg-success text-white text-center py-1 mt-auto">
    &copy; <?php echo date('Y'); ?> PTC. All rights reserved.
</footer>


<script>
    document.querySelectorAll("#forgotPasswordForm, #forgotPasswordForm2").forEach(form => {
        form.addEventListener("submit", async function(e) {
        e.preventDefault();

        const emailInput = e.target.querySelector("input[name='email'], input[name='email2']");
        const email = emailInput ? emailInput.value : "";
        const formData = new FormData();
        formData.append("email", email);

        const submitButton = e.target.querySelector("button[type='submit']");
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...';
        submitButton.disabled = true;

        try {
            const res = await fetch("./controllers/VerifyStudent.php", {
                method: "POST",
                body: formData
            });

            const text = await res.text();
            const responseElement = emailInput.name === "email" ? document.getElementById("response") : document.getElementById("response2");
            responseElement.textContent = text;
            responseElement.className = "text-center text-danger";   

            if (text.includes("OTP sent!")) {
                responseElement.className = "text-center text-success";

                // Change the DOM to require OTP input
                const formContainer = e.target.parentElement;
                formContainer.innerHTML = `
                    <h2 class="text-center">Enter OTP</h2>
                    <p class="text-center text-muted">A 4-digit OTP has been sent to your email. Please enter it below to verify.</p>
                    <form id="otpForm" class="text-center">
                        <div class="d-flex justify-content-center mb-3">
                            <input type="text" class="form-control text-center mx-1" name="otp1" id="otp1" maxlength="1" style="width: 50px;" inputmode="numeric" required>
                            <input type="text" class="form-control text-center mx-1" name="otp2" id="otp2" maxlength="1" style="width: 50px;" inputmode="numeric" required>
                            <input type="text" class="form-control text-center mx-1" name="otp3" id="otp3" maxlength="1" style="width: 50px;" inputmode="numeric" required>
                            <input type="text" class="form-control text-center mx-1" name="otp4" id="otp4" maxlength="1" style="width: 50px;" inputmode="numeric" required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
                        </div>
                    </form>
                    <p id="otpResponse" class="text-center mt-3"></p>
                `;

                // Automatically move focus to the next input box
                const otpInputs = document.querySelectorAll("#otpForm input");
                otpInputs.forEach((input, index) => {
                    input.addEventListener("input", function () {
                        if (input.value.length === 1 && index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    });

                    input.addEventListener("keydown", function (e) {
                        if (e.key === "Backspace" && input.value === "" && index > 0) {
                            otpInputs[index - 1].focus();
                        }
                    });

                    // Enable pasting OTP
                    input.addEventListener("paste", function (e) {
                        const pasteData = e.clipboardData.getData("text").split("");
                        otpInputs.forEach((otpInput, i) => {
                            otpInput.value = pasteData[i] || "";
                        });
                        otpInputs[0].focus(); // Always focus on the first input after pasting
                        e.preventDefault();
                    });
                });

        
                

                // Add event listener for OTP form submission
                document.getElementById("otpForm").addEventListener("submit", async function(e) {
                    e.preventDefault();

                    const otp = [...document.querySelectorAll("#otpForm input")]
                        .map(input => input.value)
                        .join("");

                    const otpFormData = new FormData();
                    otpFormData.append("otp", otp);
                    otpFormData.append("email", email);

                    const otpSubmitButton = e.target.querySelector("button[type='submit']");
                    otpSubmitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...';
                    otpSubmitButton.disabled = true;

                    try {
                        const otpRes = await fetch("./controllers/VerifyOTP.php", {
                            method: "POST",
                            body: otpFormData
                        });

                        const result = await otpRes.json();

                        if (result.status === "ptc") {
                            otpSubmitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                            setTimeout(() => {
                                window.location.href = `./create.php?token=${result.token}`;
                            }, 2000); // 2-second delay
                        } else if (result.status === "email") {
                            otpSubmitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                            setTimeout(() => {
                                window.location.href = `./create2.php?token=${result.token}`;
                            }, 2000); // 2-second delay
                        } else {
                            const otpResponseElement = document.getElementById("otpResponse");
                            otpResponseElement.textContent = result.message;
                            otpResponseElement.className = "text-center text-danger";
                            otpSubmitButton.disabled = false; // Ensure button remains enabled
                            otpSubmitButton.innerHTML = "Verify OTP"; // Reset button text
                            setTimeout(() => {
                                otpResponseElement.textContent = "";
                            }, 2000); // Hide message after 2 seconds
                        }
                    } catch (error) {
                        console.error("Error:", error);
                    } finally {
                        setTimeout(() => {
                            otpSubmitButton.disabled = false;
                            otpSubmitButton.innerHTML = "Verify OTP";
                        }, 2000); // 2-second delay for consistency
                    }
                });
            } else {
                responseElement.className = text.includes("not a student") ? "text-center text-danger" : "text-center text-danger";
                setTimeout(() => {
                    responseElement.textContent = "";
                }, 2500);
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
}
    );
</script>
<!-- <script src="./js/forgotPassword.js"></script> -->
<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

</body>
</html>
