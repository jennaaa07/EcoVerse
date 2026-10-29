// edit_profile.js

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('profilePreview');
        output.src = reader.result;
    };
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}

function handleProfileSave() {
    const fullName = document.getElementById('fullName').value;
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;

    if (!fullName || !username || !email) {
        alert("Please ensure all required fields are filled out.");
        return;
    }

    alert("Profile changes saved successfully!");
    window.location.href = "profile.html";
}