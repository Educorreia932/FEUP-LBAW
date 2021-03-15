// Create a media condition that targets viewports above bootstrap lg
const mediaQuery = window.matchMedia('(min-width: 992px)')

let btn_sidebar = document.getElementById('btn-sidebar');

btn_sidebar.addEventListener('click', function() {
  let btn_sidebar_icon = btn_sidebar.querySelector('i');
  if (btn_sidebar_icon.classList.contains('bi-caret-right-fill'))
    btn_sidebar_icon.classList.replace('bi-caret-right-fill', 'bi-caret-left-fill');
  else
    btn_sidebar_icon.classList.replace('bi-caret-left-fill', 'bi-caret-right-fill');
});
// Check if the media query is true
if (mediaQuery.matches) {
  // Then trigger an alert
  let sidebar = document.getElementById('sidebar');
  sidebar.classList.add("show");

  let btn_sidebar_icon = btn_sidebar.querySelector('i');
  btn_sidebar.ariaExpanded = true;
  btn_sidebar_icon.classList.replace('bi-caret-right-fill', 'bi-caret-left-fill')
}
