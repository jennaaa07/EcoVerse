// policy.js

function handlePolicyAcknowledgement() {
    // Save acknowledgement status to local storage or session storage if needed
    localStorage.setItem('ecoRewards_policy_acknowledged', 'true');
    
    // Smooth transition back to help and support or previous view
    window.location.href = 'helpAndSupport.html';
}

function sharePolicySummary() {
    if (navigator.share) {
        navigator.share({
            title: 'EcoRewards App Guidelines & Policy',
            text: 'Check out the official EcoRewards terms and app guidelines.',
            url: window.location.href,
        }).catch((error) => console.log('Sharing failed', error));
    } else {
        alert('Link copied to clipboard: ' + window.location.href);
    }
}