// join_campaign.js

function shareCampaign() {
    if (navigator.share) {
        navigator.share({
            title: 'City Park Tree Planting - EcoRewards',
            text: 'Join me for the City Park Tree Planting campaign and earn 300 Eco-Points!',
            url: window.location.href,
        }).catch((error) => console.log('Sharing failed', error));
    } else {
        alert("Campaign link copied to clipboard!");
    }
}

function submitRegistration() {
    const name = document.getElementById('volunteerName').value.trim();
    const phone = document.getElementById('volunteerPhone').value.trim();
    const termsChecked = document.getElementById('terms').checked;

    if (!name || !phone) {
        alert("Please fill in both your full name and phone number.");
        return;
    }

    if (!termsChecked) {
        alert("You must agree to the event safety guidelines and terms.");
        return;
    }

    alert(`Registration Successful!\n\nThank you, ${name}. Your spot for the City Park Tree Planting campaign has been confirmed. See you on Saturday, April 18, 2026!`);
    window.location.href = "community.html";
}