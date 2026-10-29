// delete_account.js

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
    const form = document.getElementById('deleteAccountForm');

    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const password = document.getElementById('deletePassword').value;

            if (!password) {
                alert('Please enter your password to confirm account deletion.');
                return;
            }

            const confirmed = confirm('Are you absolutely sure you want to permanently delete your EcoRewards account? This action cannot be undone.');

            if (confirmed) {
                alert('Your account has been successfully scheduled for permanent deletion.');
                window.location.href = 'index.html';
            }
        });
    }
});