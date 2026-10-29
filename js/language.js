// language.js

function filterLanguages() {
    const input = document.getElementById('langSearchInput').value.toLowerCase();
    const langItems = document.querySelectorAll('.lang-item');

    langItems.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(input)) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    });
}

function saveLanguage() {
    const selectedRadio = document.querySelector('input[name="language"]:checked');
    if (selectedRadio) {
        const langValue = selectedRadio.value.toUpperCase();
        alert(`Language successfully updated to ${langValue}!`);
        window.location.href = "setting.html";
    } else {
        alert("Please select a language option.");
    }
}