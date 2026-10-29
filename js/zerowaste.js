// zero_waste.js

// Toggle bookmark for the entire topic category header
function toggleBookmarkTopic() {
    const btn = document.getElementById('topicBookmarkBtn');
    const icon = btn.querySelector('i');
    
    if (icon.classList.contains('fa-regular')) {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid', 'text-teal-600');
        alert("Topic saved to your bookmarked guides!");
    } else {
        icon.classList.remove('fa-solid', 'text-teal-600');
        icon.classList.add('fa-regular');
        alert("Topic removed from bookmarks.");
    }
}

// Like or unlike individual posts dynamically
function likePost(postId) {
    const icon = document.getElementById(`like-icon-${postId}`);
    const countSpan = document.getElementById(`like-count-${postId}`);
    let currentCount = parseInt(countSpan.textContent);

    if (icon.classList.contains('fa-regular')) {
        icon.classList.remove('fa-regular', 'fa-heart');
        icon.classList.add('fa-solid', 'fa-heart', 'text-red-500');
        currentCount++;
    } else {
        icon.classList.remove('fa-solid', 'fa-heart', 'text-red-500');
        icon.classList.add('fa-regular', 'fa-heart');
        currentCount--;
    }
    countSpan.textContent = currentCount;
}

// Bookmark individual posts
function toggleBookmarkPost(postId) {
    const icon = document.getElementById(`bookmark-icon-${postId}`);
    
    if (icon.classList.contains('fa-regular')) {
        icon.classList.remove('fa-regular');
        icon.classList.add('fa-solid', 'text-teal-600');
    } else {
        icon.classList.remove('fa-solid', 'text-teal-600');
        icon.classList.add('fa-regular');
    }
}

// Open comments section placeholder
function openComments(postId) {
    alert(`Opening comments thread for Post #${postId}.`);
    // Future expansion: Trigger modal or redirect to comment section view
}