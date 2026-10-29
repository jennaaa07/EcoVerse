// privacy.js

function filterPrivacyTopics() {
    const query = document.getElementById('privacySearchInput').value.toLowerCase().trim();
    const items = document.querySelectorAll('.privacy-item');

    items.forEach(item => {
        const title = item.getAttribute('data-title');
        const content = item.getAttribute('data-content');

        if (title.includes(query) || content.includes(query)) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
}