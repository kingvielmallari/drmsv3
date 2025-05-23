document.querySelector("#userForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const submitButton = e.target.querySelector("button[type='submit']");
    const responseElement = document.querySelector("#response");

    // Add the three inputs to FormData
    formData.append("student_id", document.getElementById("student_id").value);


    // Change button content to loading spinner
    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
    submitButton.disabled = true;

    try {
        const response = await fetch("./controllers/AddUser.php", {
            method: "POST",
            body: formData,
        });

        const result = await response.text();

        // Update response text and style based on result
        if (result === "Sorry, you are not a student of PTC." || result === "Account already exists.") {
            responseElement.textContent = result;
            responseElement.className = "text-danger text-center";

            // Make text disappear after 2 seconds
            setTimeout(() => {
                responseElement.textContent = "";
            }, 2000);
        } else {
            responseElement.textContent = result;
            responseElement.className = "text-success text-center";

            // Simulate loading before redirect
            setTimeout(() => {
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                setTimeout(() => {
                    window.location.href = "index.php";
                }, 1250);
            }, 1250);
        }

        // Do not reset the form inputs
    } catch (error) {
        console.error("Error:", error);
    } finally {
        // Reset button content and state if not redirecting
        if (!responseElement.classList.contains("text-success")) {
            submitButton.innerHTML = "Register";
            submitButton.disabled = false;
        }
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


