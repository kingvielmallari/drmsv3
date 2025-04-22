
<?php

require_once './config/db.php'; // Update with your actual DB connection file

session_start();

$token = $_GET['token'] ?? '';
$sessionToken = $_SESSION['token'] ?? '';

if (!$token || $token !== $sessionToken) {
    // Block unauthorized access
    header("Location: ./verify.php");
    exit;
}

// Continue with password creation form
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login User</title>
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
    <div class="col-md-8">
      <h2 class="text-center mb-4">Create New DRMS Account</h2>
      <p class="text-center text-muted mb-4">Make sure that your Student ID is registered in our school database to be able to create an account.</p>
      <form id="userForm">
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" oninput="this.value = this.value.replace(/\b\w/g, char => char.toUpperCase())" required>
              <label for="first_name">First Name</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle Name" oninput="this.value = this.value.replace(/\b\w/g, char => char.toUpperCase())">
              <label for="middle_name">Middle Name</label>
            </div>
          </div>

        </div>

        <div class="row g-3 mb-3">
        <div class="col-md-6">
            <div class="form-floating">
              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" oninput="this.value = this.value.replace(/\b\w/g, char => char.toUpperCase())" required>
              <label for="last_name">Last Name</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?php echo $_SESSION['email'] ?? ''; ?>" disabled required>  
            <label for="email">Email Address</label>
            </div>
          </div>

        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <div class="form-floating">
              <input type="number" class="form-control" name="year_graduated" id="year_graduated" placeholder="Year Graduated" min="1900" max="<?php echo date('Y'); ?>" maxlength="4" oninput="this.value = this.value.slice(0, 4)" required>
              <label for="year_graduated">Year Graduated</label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
              <input type="number" class="form-control" name="last_year_attended" id="last_year_attended" placeholder="Last Year Attended" min="1900" max="<?php echo date('Y'); ?>" maxlength="4" oninput="this.value = this.value.slice(0, 4)" required>
              <label for="last_year_attended">Last Year Attended</label>
            </div>
          </div>
         
        </div>
        
        <div class="row g-3 mb-3">
           <div class="col-md-6 position-relative">
            <div class="form-floating">
              <select class="form-select" name="gender" id="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <label for="gender">Gender</label>
            </div>
          </div>
           <div class="col-md-6 position-relative">
            <div class="form-floating">
              <select class="form-select" name="status" id="status" required>
                <option value="" disabled selected>Select Status</option>
                <option value="Graduated">Graduated</option>
                <option value="Irregular">Irregular</option>
                <option value="Regular">Regular</option>
              </select>
              <label for="status">Status</label>
            </div>
          </div>
        </div> 

        <div class="row g-3 mb-3">
          <div class="col-md-6 position-relative">
            <div class="form-floating">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          <label for="password">New Password</label>
          <i class="bi bi-eye toggle-password" data-target="password" style="position: absolute; top: 50%; right: 10px; cursor: pointer;"></i>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-floating">
            <input type="password" class="form-control" name="confirm_password" id="floatingConfirmPassword" placeholder="Confirm Password" required>
          <label for="floatingConfirmPassword">Confirm Password</label>
          <i class="bi bi-eye toggle-password" data-target="floatingConfirmPassword" style="position: absolute; top: 50%; right: 10px; cursor: pointer;"></i>
            </div>
          </div>
        </div>

        <p id="passwordError" class="text-danger text-center"></p>

        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-success btn-block">Register</button>
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

document.getElementById("userForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    formData.append("email", document.getElementById("email").value);
    const submitBtn = form.querySelector("button[type='submit']");
    const passwordError = document.getElementById("passwordError");
    const responseEl = document.getElementById("response");


    // Show loading animation
    submitBtn.disabled = true;
    submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>`;

    try {
      const response = await fetch("./controllers/AddUser2.php", {
        method: "POST",
        body: formData,
      });

      const result = await response.text();
      responseEl.textContent = result;
      responseEl.classList.add("text-success");

      
      setTimeout(() => {
        setTimeout(() => {
          window.location.href = "index.php";
        }, 1250); // Redirect after 2 seconds
      }, 1250); // Keep spinner visible for 2 seconds
    } catch (error) {
      console.error("Error:", error);
      responseEl.textContent = "Something went wrong.";
      submitBtn.disabled = false; // Re-enable button only if there's an error
      submitBtn.innerHTML = `Register`;
    }
  });


// Prevent form submission if passwords don't match or password is less than 6 characters
document.getElementById("floatingConfirmPassword").addEventListener("input", function() {
    let password = document.getElementById("password").value;
    let confirmPassword = this.value;
    let errorText = document.getElementById("passwordError");
    let registerButton = document.querySelector("button[type='submit']");

    if (password.length < 6) {
        this.style.boxShadow = "0 0 3px 2px rgba(255, 0, 0, 0.5)"; // Red border shadow
        errorText.textContent = "Password must be at least 6 characters long!";
        errorText.style.color = "red";
        registerButton.disabled = true; // Disable the button
    } else if (confirmPassword.length > 0) {
        if (confirmPassword === password) {
            this.style.boxShadow = "0 0 3px 2px rgba(0, 128, 0, 0.5)"; // Green border shadow
            errorText.textContent = ""; // Clear error text if passwords match
            registerButton.disabled = false; // Enable the button
        } else {
            this.style.boxShadow = "0 0 3px 2px rgba(255, 0, 0, 0.5)"; // Red border shadow
            errorText.textContent = "Passwords do not match!"; // Show error text
            errorText.style.color = "red";
            registerButton.disabled = true; // Disable the button
        }
    } else {
        this.style.boxShadow = "none"; // Remove box shadow if input is empty
        errorText.textContent = ""; // Clear error text if input is empty
        registerButton.disabled = true; // Disable the button
    }
});

document.getElementById("password").addEventListener("input", function() {
    let confirmPassword = document.getElementById("floatingConfirmPassword").value;
    document.getElementById("floatingConfirmPassword").dispatchEvent(new Event("input")); // Trigger input event for confirm password
});

document.getElementById("userForm").addEventListener("submit", function(event) {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("floatingConfirmPassword").value;
    let errorText = document.getElementById("passwordError");

    if (password.length < 6) {
        event.preventDefault(); // Stop form submission
        errorText.textContent = "Password must be at least 6 characters long!";
        errorText.style.color = "red"; // Set text color to red
    } else if (confirmPassword !== password) {
        event.preventDefault(); // Stop form submission
        errorText.textContent = "Passwords do not match!";
        errorText.style.color = "red"; // Set text color to red
    } else {
        errorText.textContent = ""; // Clear error text if passwords match
    }
});

const toggleIcon = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');

document.querySelectorAll('.toggle-password').forEach(toggleIcon => {
    const targetId = toggleIcon.dataset.target;
    const passwordInput = document.getElementById(targetId);
  
    const showPassword = () => {
      passwordInput.setAttribute('type', 'text');
      toggleIcon.classList.add('bi-eye-slash');
      toggleIcon.classList.remove('bi-eye');
    };
  
    const hidePassword = () => {
      passwordInput.setAttribute('type', 'password');
      toggleIcon.classList.add('bi-eye');
      toggleIcon.classList.remove('bi-eye-slash');
    };
  
    toggleIcon.addEventListener('touchstart', showPassword);
    toggleIcon.addEventListener('touchend', hidePassword);
    toggleIcon.addEventListener('mousedown', showPassword);
    toggleIcon.addEventListener('mouseup', hidePassword);
    toggleIcon.addEventListener('mouseleave', hidePassword);
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




</script>
<script src="./vendor/bootstrapv5/js/bootstrap.bundle.min.js"></script>

</body>
</html>
