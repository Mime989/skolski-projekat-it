function validateForm() {
const name = document.getElementById("name").value.trim();
const genre = document.getElementById("genre").value.trim();
const platforms = document.getElementById("platforms").value.trim();
const releaseYear = document.getElementById("release_year").value.trim();

if (name === "" || genre === "" || platforms === "" || releaseYear === "") {
alert("Please fill in all required fields.");
return false;
}

const year = parseInt(releaseYear);
if (isNaN(year) || year < 1950 || year > 2030) {
alert("Please enter a valid release year between 1950 and 2030.");
return false;
}

return true;
}

// Theme switching functionality
document.addEventListener('DOMContentLoaded', function() {
const themeSelect = document.getElementById('theme-select');
const customControls = document.getElementById('custom-theme-controls');
const primaryColorInput = document.getElementById('primary-color');
const backgroundColorInput = document.getElementById('background-color');
const textColorInput = document.getElementById('text-color');

// Load saved theme and custom colors from localStorage
const savedTheme = localStorage.getItem('theme') || 'light';
const savedCustomColors = JSON.parse(localStorage.getItem('customColors') || '{}');

setTheme(savedTheme);
themeSelect.value = savedTheme;

// Load saved custom colors
if (savedCustomColors.primary) primaryColorInput.value = savedCustomColors.primary;
if (savedCustomColors.background) backgroundColorInput.value = savedCustomColors.background;
if (savedCustomColors.text) textColorInput.value = savedCustomColors.text;

// Show/hide custom controls based on theme selection
function toggleCustomControls() {
if (themeSelect.value === 'custom') {
customControls.style.display = 'block';
applyCustomColors();
} else {
customControls.style.display = 'none';
}
}

toggleCustomControls();

// Listen for theme changes
themeSelect.addEventListener('change', function() {
const selectedTheme = this.value;
setTheme(selectedTheme);
localStorage.setItem('theme', selectedTheme);
toggleCustomControls();
});

// Listen for custom color changes
[primaryColorInput, backgroundColorInput, textColorInput].forEach(input => {
input.addEventListener('input', function() {
if (themeSelect.value === 'custom') {
applyCustomColors();
saveCustomColors();
}
});
});
});

function setTheme(theme) {
document.body.className = theme + '-theme';
}

function applyCustomColors() {
const primaryColor = document.getElementById('primary-color').value;
const backgroundColor = document.getElementById('background-color').value;
const textColor = document.getElementById('text-color').value;

document.documentElement.style.setProperty('--custom-primary-color', primaryColor);
document.documentElement.style.setProperty('--custom-bg-color', backgroundColor);
document.documentElement.style.setProperty('--custom-text-color', textColor);

// Calculate hover color (darker version of primary)
const hoverColor = darkenColor(primaryColor, 0.2);
document.documentElement.style.setProperty('--custom-primary-hover', hoverColor);
}

function saveCustomColors() {
const customColors = {
primary: document.getElementById('primary-color').value,
background: document.getElementById('background-color').value,
text: document.getElementById('text-color').value
};
localStorage.setItem('customColors', JSON.stringify(customColors));
}

function deleteGame(index) {
if (confirm('Are you sure you want to delete this game? This action cannot be undone.')) {
window.location.href = 'delete.php?index=' + index;
}
}

function clearAllGames() {
if (confirm('Are you sure you want to delete ALL games? This action cannot be undone and will also delete all uploaded images.')) {
window.location.href = 'clear_all.php';
}
}
