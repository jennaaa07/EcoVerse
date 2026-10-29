// ==========================
// Show / Hide Password
// ==========================

const passwordInput = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

if(togglePassword){

    togglePassword.addEventListener("click", function(){

        if(passwordInput.type === "password"){

            passwordInput.type = "text";
            togglePassword.innerHTML = "🙈";

        }else{

            passwordInput.type = "password";
            togglePassword.innerHTML = "👁";

        }

    });

}


// ==========================
// Form Validation
// ==========================

const loginForm = document.querySelector("form");

loginForm.addEventListener("submit", function(e){

    const userCode = document.getElementById("user_code").value.trim();
    const password = document.getElementById("password").value.trim();

    if(userCode === "" || password === ""){

        alert("Please enter User ID and Password.");

    e.preventDefault();

    }

});