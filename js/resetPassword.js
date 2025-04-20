document.querySelector("#resetForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const studentId = document.querySelector("#student_id").value;
    const confirmPassword = document.querySelector("#floatingConfirmPassword").value;

    // ✅ Get token from URL
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');

    const formData = new FormData();
    formData.append("student_id", studentId);
    formData.append("confirm_password", confirmPassword);
    formData.append("token", token); // ✅ Add token to POST data

    try {
        const response = await fetch("./controllers/updatePassword.php", {
            method: "POST",
            body: formData,
        });

        const result = await response.text();
        const responseElement = document.querySelector("#response");
        responseElement.textContent = result;
        responseElement.classList.add("text-success");

        if (response.ok) {
            const resetButton = document.querySelector("button[type='submit']");
            resetButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'; // Show loading spinner
            resetButton.disabled = true; // Disable the button temporarily

            setTimeout(() => {
                resetButton.innerHTML = 'Reset Password'; // Restore original text
                resetButton.disabled = false; // Re-enable the button
                window.location.href = "index.php";
            }, 2000);
        }

        // Do not reset the form inputs
        document.getElementById("password").style.boxShadow = "none";
        document.getElementById("floatingConfirmPassword").style.boxShadow = "none";
    } catch (error) {
        console.error("Error:", error);
    }
});


// Prevent form submission if passwords don't match
document.getElementById("floatingConfirmPassword").addEventListener("input", function() {
let password = document.getElementById("password").value;
let confirmPassword = this.value;
let errorText = document.getElementById("passwordError");
let registerButton = document.querySelector("button[type='submit']");

if (confirmPassword.length > 0) {
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

if (confirmPassword !== password) {
    event.preventDefault(); // Stop form submission
    errorText.textContent = "Passwords do not match!";
    errorText.style.color = "red"; // Set text color to red
} else {
    errorText.textContent = ""; // Clear error text if passwords match
}
});



document.getElementById("floatingConfirmPassword").addEventListener("input", function() {
let password = document.getElementById("password").value;
let confirmPassword = this.value;
let errorText = document.getElementById("passwordError");

if (confirmPassword !== password) {
    errorText.style.display = "block"; // Show error if passwords don't match
} else {
    errorText.style.display = "none"; // Hide error if they match
}
});

// Toggle Password Visibility
document.getElementById('togglePassword').addEventListener('touchstart', function () {
const passwordInput = document.getElementById('password');
passwordInput.setAttribute('type', 'text');
this.classList.add('bi-eye-slash');
this.classList.remove('bi-eye');
});

document.getElementById('togglePassword').addEventListener('touchend', function () {
const passwordInput = document.getElementById('password');
passwordInput.setAttribute('type', 'password');
this.classList.add('bi-eye');
this.classList.remove('bi-eye-slash');
});

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


