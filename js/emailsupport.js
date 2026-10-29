// email_support.js

function handleFileSelection(event) {
    const file = event.target.files[0];
    const fileLabelText = document.getElementById('fileLabelText');
    
    if (file) {
        if (file.size > 5 * 1024 * 1024) {
            alert("File size exceeds 5MB limit. Please choose a smaller file.");
            event.target.value = "";
            fileLabelText.innerText = "Tap to upload file";
            return;
        }
        fileLabelText.innerText = `Selected: ${file.name}`;
    } else {
        fileLabelText.innerText = "Tap to upload file";
    }
}

function submitSupportTicket() {
    const category = document.getElementById('issueCategory').value;
    const subject = document.getElementById('ticketSubject').value.trim();
    const description = document.getElementById('ticketDescription').value.trim();

    if (!subject || !description) {
        alert("Please fill in both the subject and description fields before submitting your ticket.");
        return;
    }

    alert(`Ticket Submitted Successfully!\n\nCategory: ${category}\nSubject: ${subject}\n\nOur team has received your message and will reply to your registered email within 24 hours.`);
    window.location.href = "helpAndSupport.html";
}