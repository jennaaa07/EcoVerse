// log_activity.js

// Request device location on page load to mock verification tracking
window.addEventListener('DOMContentLoaded', () => {
    const locationStatus = document.getElementById('locationStatusText');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                locationStatus.innerHTML = `<strong>Location verified:</strong> Lat: ${position.coords.latitude.toFixed(2)}, Lng: ${position.coords.longitude.toFixed(2)}`;
                document.getElementById('activityLocation').value = `${position.coords.latitude}, ${position.coords.longitude}`;
            },
            (error) => {
                locationStatus.innerHTML = `<strong>Location notice:</strong> Using default campus perimeter fallback coordinates.`;
                document.getElementById('activityLocation').value = 'Campus location unavailable';
            },
            { timeout: 10000 }
        );
    }
});

function previewFile(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const primaryText = document.getElementById('uploadTextPrimary');
        const secondaryText = document.getElementById('uploadTextSecondary');
        const iconContainer = document.getElementById('uploadIconContainer');

        primaryText.textContent = file.name;
        secondaryText.textContent = "File successfully attached ready for review";
        iconContainer.innerHTML = '<i class="fa-solid fa-check text-white"></i>';
        iconContainer.classList.remove('bg-green-100', 'text-green-600');
        iconContainer.classList.add('bg-green-600', 'text-white');
    }
}

async function submitActivity() {
    const fileInput = document.getElementById('proofFile');
    if (!fileInput.files || fileInput.files.length === 0) {
        alert("Please attach a photo proof before submitting your activity.");
        return;
    }

    const form = document.getElementById('logActivityForm');
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i><span>Saving...</span>';
    try {
        const response = await fetch('api/submit_activity.php', { method: 'POST', body: new FormData(form) });
        const data = await response.json();
        if (!data.success) throw new Error(data.message);
        alert(data.message);
        window.location.href = 'dashboard.php';
    } catch (error) {
        alert(error.message || 'Could not save your activity.');
        submitButton.disabled = false;
        submitButton.innerHTML = '<i class="fa-solid fa-paper-plane"></i><span>Submit for Review</span>';
    }
}

document.getElementById('logActivityForm').addEventListener('submit', (event) => {
    event.preventDefault();
    submitActivity();
});
