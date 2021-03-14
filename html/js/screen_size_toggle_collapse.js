// Create a media condition that targets viewports above bootstrap lg
const mediaQuery = window.matchMedia('(min-width: 992px)')

// Check if the media query is true
if (mediaQuery.matches) {
  // Then trigger an alert
  let sidebar = document.getElementById('sidebar');
  sidebar.classList.add("show");

  let btn_sidebar = document.getElementById('btn-sidebar');
  btn_sidebar.ariaExpanded = true;
}
