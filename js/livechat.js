// live_chat.js

function getCurrentTime() {
    const now = new Date();
    let hours = now.getHours();
    const minutes = now.getMinutes().toString().padStart(2, '0');
    const ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; 
    return `${hours}:${minutes} ${ampm}`;
}

function sendMessage() {
    const inputField = document.getElementById('chatInput');
    const messageText = inputField.value.trim();

    if (!messageText) return;

    const chatContainer = document.getElementById('chatContainer');
    const timeString = getCurrentTime();

    // Append User Message
    const userMessageHTML = `
        <div class="flex items-start gap-2.5 justify-end">
            <div class="bg-green-600 text-white rounded-2xl rounded-tr-sm p-3.5 shadow-sm max-w-[80%]">
                <p class="text-xs leading-relaxed">${escapeHtml(messageText)}</p>
                <span class="text-[9px] text-green-100 mt-1.5 block text-right">${timeString}</span>
            </div>
            <div class="w-7 h-7 rounded-full bg-gray-300 text-gray-700 flex items-center justify-center font-bold text-[10px] shrink-0 mt-1">
                JD
            </div>
        </div>
    `;

    chatContainer.insertAdjacentHTML('beforeend', userMessageHTML);
    inputField.value = '';
    chatContainer.scrollTop = chatContainer.scrollHeight;

    // Simulate automated agent reply
    setTimeout(() => {
        const agentMessageHTML = `
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-full bg-green-600 text-white flex items-center justify-center font-bold text-[10px] shrink-0 mt-1">
                    CS
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl rounded-tl-sm p-3.5 shadow-sm max-w-[80%]">
                    <p class="text-xs text-gray-700 leading-relaxed">
                        Thank you for providing the details. We are cross-referencing your ticket with our submission logs.
                    </p>
                    <span class="text-[9px] text-gray-400 mt-1.5 block text-right">${getCurrentTime()}</span>
                </div>
            </div>
        `;
        chatContainer.insertAdjacentHTML('beforeend', agentMessageHTML);
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }, 1000);
}

function attachFile() {
    alert("Attachment dialog opened. You can select image files or proofs to upload.");
}

function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}