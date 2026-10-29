// eco_tips.js

function toggleLike(button, countId) {
    const icon = button.querySelector('i');
    const countSpan = document.getElementById(countId);
    let currentLikes = parseInt(countSpan.innerText);

    if (icon.classList.contains('fa-regular')) {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid', 'text-red-500');
        currentLikes += 1;
    } else {
        icon.classList.remove('fa-solid', 'text-red-500');
        icon.classList.add('fa-regular');
        currentLikes -= 1;
    }
    countSpan.innerText = currentLikes;
}

function toggleBookmark(button) {
    const icon = button.querySelector('i');
    if (icon.classList.contains('fa-regular')) {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid', 'text-green-600');
        alert("Tip saved to your bookmarks!");
    } else {
        icon.classList.remove('fa-solid', 'text-green-600');
        icon.classList.add('fa-regular');
        alert("Tip removed from your bookmarks.");
    }
}

function toggleBookmarkAll() {
    alert("Opening your saved bookmarks collection drawer.");
}

function openComments(tipTitle) {
    prompt(`Viewing comments for: "${tipTitle}"\n\nWrite a comment or reply to this tip:`);
}