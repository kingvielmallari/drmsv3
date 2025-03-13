
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
  import { getAuth, signInWithPopup, GoogleAuthProvider } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

  const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_CUSTOM_DOMAIN", // Example: auth.paterostechnologicalcollege.edu.ph
    projectId: "YOUR_PROJECT_ID",
  };

  const app = initializeApp(firebaseConfig);
  const auth = getAuth(app);
  const provider = new GoogleAuthProvider();

  document.getElementById("login-btn").addEventListener("click", async () => {
    try {
      const result = await signInWithPopup(auth, provider);
      const user = result.user;
      const email = user.email;

      if (!email.endsWith("@paterostechnologicalcollege.edu.ph")) {
        alert("Only school emails are allowed!");
        auth.signOut();
        return;
      }

      console.log("User signed in:", user);
    } catch (error) {
      console.error("Login error:", error);
    }
  });
