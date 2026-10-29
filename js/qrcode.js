// qr_code.js

function shareQRCode() {
    const participantId = document.getElementById('participantId').textContent;
    if (navigator.share) {
        navigator.share({
            title: 'EcoRewards QR Code',
            text: `Here is my EcoRewards participant code: ${participantId}`,
            url: window.location.href,
        }).catch(() => {});
    } else {
        alert(`Participant ID copied or ready to share: ${participantId}`);
    }
}

function downloadQRCode() {
    const qrImg = document.getElementById('qrImageElement');
    const imageUrl = qrImg.src;
    
    // Create temporary download link element
    const link = document.createElement('a');
    link.href = imageUrl;
    link.download = 'EcoRewards-QRCode.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function refreshQRCode() {
    const qrImg = document.getElementById('qrImageElement');
    const refreshIcon = document.getElementById('refreshIcon');
    
    // Add spinning animation to icon
    refreshIcon.classList.add('fa-spin');
    qrImg.style.opacity = '0.4';

    // Simulate reloading code payload dynamically with a unique timestamp seed
    setTimeout(() => {
        const currentSrc = qrImg.src.split('&t=')[0];
        qrImg.src = `${currentSrc}&t=${new Date().getTime()}`;
        qrImg.style.opacity = '1';
        refreshIcon.classList.remove('fa-spin');
    }, 600);
}