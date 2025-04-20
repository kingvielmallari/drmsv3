document.getElementById(forgotPasswordForm).addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);

    try {
        const response = await fetch("../controllers/ForgotPassword.php", {
            method: "POST",
            body: formData,
        });



        const result = await response.text();
        document.querySelector("#response").textContent = result;
        e.target.reset();

        // Reset box shadows after form reset
        document.getElementById("password").style.boxShadow = "none";
        document.getElementById("floatingConfirmPassword").style.boxShadow = "none";
    } catch (error) {
        console.error("Error:", error);
    }
});
