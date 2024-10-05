// Get references to elements
const toggleButton = document.getElementById('darkModeToggle');
const themeIcon = document.getElementById('themeIcon');

// Check if dark mode is enabled (using localStorage)
const currentTheme = localStorage.getItem('theme');
if (currentTheme === 'dark') {
  document.body.classList.add('dark-theme');
  themeIcon.src = 'images/favicons/moon.png'; // Change to moon icon
}

// Add event listener to toggle button
toggleButton.addEventListener('click', () => {
  document.body.classList.toggle('dark-theme');
  
  // Update icon and localStorage based on theme
  if (document.body.classList.contains('dark-theme')) {
    themeIcon.src = 'images/favicons/moon.png'; // Change to moon icon
    localStorage.setItem('theme', 'dark');
  } else {
    themeIcon.src = 'images/favicons/sun.png'; // Change back to sun icon
    localStorage.setItem('theme', 'light');
  }
});
