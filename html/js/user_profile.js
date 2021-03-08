function toggle_button(selector, class_from, class_to) {
    let buttons = document.querySelectorAll(selector);

    buttons.forEach(element => {
        element.addEventListener('click', function() {
            if (element.classList.contains(class_from)) {
                element.classList.replace(class_from, class_to);
            } else {
                element.classList.replace(class_to, class_from);
            }
        })
    })
}

let follow_button = document.querySelector('.user-details .follow');

follow_button.addEventListener('click', function () {
    let icon = follow_button.querySelector('i');
    let text = follow_button.querySelector('span');
    if (follow_button.classList.contains('btn-outline-danger')) {
        follow_button.classList.replace('btn-outline-danger', 'btn-danger');
        icon.classList.replace('bi-heart', 'bi-heart-fill');
        
        text.innerHTML = "Following";
    } else {
        follow_button.classList.replace('btn-danger', 'btn-outline-danger');
        icon.classList.replace('bi-heart-fill', 'bi-heart');

        text.innerHTML = "Follow";
    }
})