// community.js

function toggleLike(button) {
    const icon = button.querySelector('.like-icon');
    const countSpan = button.querySelector('.like-count');
    let count = parseInt(countSpan.textContent);

    if (icon.classList.contains('fa-regular')) {
        icon.classList.remove('fa-regular', 'fa-heart');
        icon.classList.add('fa-solid', 'fa-heart', 'text-red-500');
        countSpan.textContent = count + 1;
    } else {
        icon.classList.remove('fa-solid', 'fa-heart', 'text-red-500');
        icon.classList.add('fa-regular', 'fa-heart');
        countSpan.textContent = count - 1;
    }
}

function toggleBookmark(button) {
    const icon = button.querySelector('.bookmark-icon');

    if (icon.classList.contains('fa-regular')) {
        icon.classList.remove('fa-regular', 'fa-bookmark');
        icon.classList.add('fa-solid', 'fa-bookmark', 'text-green-600');
    } else {
        icon.classList.remove('fa-solid', 'fa-bookmark', 'text-green-600');
        icon.classList.add('fa-regular', 'fa-bookmark');
    }
}

function createPost() {
    const input = document.getElementById('postInput');
    const content = input.value.trim();

    if (content === "") {
        alert("Please write something before posting!");
        return;
    }

    alert(`Successfully posted: "${content}"`);
    input.value = "";
    // Future expansion: Send data via AJAX/Fetch to backend handler script to save to database
}