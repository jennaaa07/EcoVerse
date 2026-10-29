// privacy_controls.js

function savePrivacyPreferences(event) {
    event.preventDefault();
    
    const btn = document.getElementById('savePreferencesBtn');
    btn.textContent = "Saving changes...";
    btn.disabled = true;

    // Simulate backend response delay
    setTimeout(() => {
        btn.textContent = "Save Preferences";
        btn.disabled = false;
        alert("Your privacy preferences have been updated successfully!");
    }, 600);
}

function requestDataDownload() {
    const confirmDownload = confirm("Would you like to request an archive of your EcoRewards data? We will email you a secure download link within 24 hours.");
    if (confirmDownload) {
        alert("Data export request submitted successfully! Check your email soon.");
    }
}