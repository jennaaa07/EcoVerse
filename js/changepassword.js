// change_password.js

function togglePasswordVisibility(fieldId, button) {
    const inputField = document.getElementById(fieldId);
    const icon = button.querySelector('i');

    if (inputField.type === 'password') {
        inputField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        inputField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('changePasswordForm');
    
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const currentPass = document.getElementById('currentPassword').value;
            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;

            if (!currentPass || !newPass || !confirmPass) {
                alert('Please fill out all password fields.');
                return;
            }

            if (newPass.length < 8) {
                alert('Your new password must be at least 8 characters long.');
                return;
            }

            if (newPass !== confirmPass) {
                alert('New password and confirmation password do not match.');
                return;
            }

            alert('Password updated successfully!');
            window.location.href = 'setting.html';
        });
    }
});