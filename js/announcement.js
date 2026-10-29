// announcements.js

document.addEventListener('DOMContentLoaded', () => {
    // Notification bell listener
    const bellBtn = document.getElementById('notificationBellBtn');
    if (bellBtn) {
        bellBtn.addEventListener('click', () => {
            alert('No new system notifications at this time.');
        });
    }
});

// Toggle Like Action with dynamic counter adjustments
function toggleLike(button) {
    const icon = button.querySelector('i');
    const countSpan = button.querySelector('.like-count');
    let baseLikes = parseInt(button.getAttribute('data-likes'));

    if (icon.classList.contains('fa-regular')) {
        // Like the announcement
        icon.classList.remove('fa-regular', 'fa-heart');
        icon.classList.add('fa-solid', 'fa-heart', 'text-red-500');
        countSpan.innerText = baseLikes + 1;
    } else {
        // Unlike the announcement
        icon.classList.remove('fa-solid', 'fa-heart', 'text-red-500');
        icon.classList.add('fa-regular', 'fa-heart');
        countSpan.innerText = baseLikes;
    }
}

// Toggle Bookmark Action
function toggleBookmark(button) {
    const icon = button.querySelector('i');

    if (icon.classList.contains('fa-regular')) {
        icon.classList.remove('fa-regular', 'fa-bookmark');
        icon.classList.add('fa-solid', 'fa-bookmark', 'text-amber-600');
        alert('Announcement saved to your bookmarks.');
    } else {
        icon.classList.remove('fa-solid', 'fa-bookmark', 'text-amber-600');
        icon.classList.add('fa-regular', 'fa-bookmark');
        alert('Announcement removed from bookmarks.');
    }
}

// Open Comments Drawer or Redirect Prompt
function openComments(announcementId) {
    alert(`Opening discussion thread for announcement #${announcementId}.`);
}