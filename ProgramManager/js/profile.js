document.addEventListener("DOMContentLoaded",()=>{

    const editBtn=document.querySelector(".edit-profile-btn");

    if(editBtn){

        editBtn.addEventListener("click",()=>{

            alert("Edit Profile feature will be connected to the database.");

        });

    }

    const passwordBtn=document.querySelector(".change-password-btn");

    if(passwordBtn){

        passwordBtn.addEventListener("click",()=>{

            const newPassword=prompt("Enter New Password");

            if(newPassword!=null && newPassword!=""){

                alert("Password updated successfully.");

            }

        });

    }

    const mfaBtn=document.querySelector(".mfa-btn");

    if(mfaBtn){

        mfaBtn.addEventListener("click",()=>{

            const enable=confirm(
            "Enable or Update Multi-Factor Authentication?"
            );

            if(enable){

                alert("MFA preference updated.");

            }

        });

    }

    const saveBtn=document.querySelector(".save-pref-btn");

    if(saveBtn){

        saveBtn.addEventListener("click",()=>{

            alert("System preferences saved.");

        });

    }

    const toggle=document.querySelector(".toggle-password");

    const passwordField=document.querySelector("#password");

    if(toggle && passwordField){

        toggle.addEventListener("click",()=>{

            if(passwordField.type==="password"){

                passwordField.type="text";
                toggle.innerHTML="🙈";

            }else{

                passwordField.type="password";
                toggle.innerHTML="👁";

            }

        });

    }


    const rows=document.querySelectorAll(".audit-table tbody tr");

    rows.forEach(row=>{

        row.addEventListener("mouseenter",()=>{

            row.style.background="#F2FFF2";

        });

        row.addEventListener("mouseleave",()=>{

            row.style.background="white";

        });

    });


});