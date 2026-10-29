// reviewerprofile.js — Manages form state, local storage saves, and profile interactions

document.addEventListener('DOMContentLoaded', () => {
    const firstNameInput = document.getElementById('firstNameInput');
    const lastNameInput = document.getElementById('lastNameInput');
    const emailInput = document.getElementById('emailInput');
    const saveBtn = document.getElementById('saveBtn');
    const discardBtn = document.getElementById('discardBtn');
    const logoutBtn = document.getElementById('logoutBtn');
    const profileName = document.getElementById('profileName');
    const profileAvatar = document.getElementById('profileAvatar');

    // 1. Load saved changes from localStorage if present
    if (localStorage.getItem('rev_firstName')) firstNameInput.value = localStorage.getItem('rev_firstName');
    if (localStorage.getItem('rev_lastName')) lastNameInput.value = localStorage.getItem('rev_lastName');
    if (localStorage.getItem('rev_email')) emailInput.value = localStorage.getItem('rev_email');

    updateHeaderInfo();

    const originalValues = {
        firstName: firstNameInput.value,
        lastName: lastNameInput.value,
        email: emailInput.value
    };

    // 2. Update Header Logic
    function updateHeaderInfo() {
        const fName = firstNameInput.value.trim();
        const lName = lastNameInput.value.trim();
        profileName.textContent = `${fName} ${lName}`;
        const initials = ((fName[0] || '') + (lName[0] || '')).toUpperCase();
        profileAvatar.textContent = initials || 'REV';
    }

    // 3. Dynamic Toast Notification Generator
    function showToast(message, type = 'success') {
        const existingToast = document.getElementById('notificationToast');
        if (existingToast) existingToast.remove();

        const toast = document.createElement('div');
        toast.id = 'notificationToast';
        toast.className = `fixed bottom-6 right-6 z-50 px-5 py-3 rounded-2xl shadow-xl text-xs font-black text-white flex items-center gap-3 transform translate-y-10 opacity-0 transition-all duration-300 ${
            type === 'success' ? 'bg-emerald-900 border-2 border-emerald-500' : 
            type === 'danger' ? 'bg-red-900 border-2 border-red-500' : 
            'bg-gray-800 border-2 border-gray-600'
        }`;
        
        toast.innerHTML = `<i class="fa-solid ${
            type === 'success' ? 'fa-circle-check text-emerald-400' : 
            type === 'danger' ? 'fa-triangle-exclamation text-red-400' : 
            'fa-circle-info text-gray-400'
        } text-base"></i> ${message}`;
        
        document.body.appendChild(toast);
        
        // Trigger animation
        setTimeout(() => toast.classList.remove('translate-y-10', 'opacity-0'), 50);
        setTimeout(() => {
            toast.classList.add('translate-y-10', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    // 4. Form Action Listeners
    saveBtn.addEventListener('click', (e) => {
        e.preventDefault();
        localStorage.setItem('rev_firstName', firstNameInput.value);
        localStorage.setItem('rev_lastName', lastNameInput.value);
        localStorage.setItem('rev_email', emailInput.value);
        
        originalValues.firstName = firstNameInput.value;
        originalValues.lastName = lastNameInput.value;
        originalValues.email = emailInput.value;

        updateHeaderInfo();
        showToast('Modifications saved successfully!', 'success');
    });

    discardBtn.addEventListener('click', (e) => {
        e.preventDefault();
        firstNameInput.value = originalValues.firstName;
        lastNameInput.value = originalValues.lastName;
        emailInput.value = originalValues.email;
        
        updateHeaderInfo();
        showToast('Changes discarded.', 'info');
    });

    logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showToast('Terminating secure session... Logging out.', 'danger');
        setTimeout(() => {
            window.location.href = '../logout.php';
        }, 500);
    });
});
