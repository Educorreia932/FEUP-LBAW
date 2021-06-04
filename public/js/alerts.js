export function createPopUpAlert(ok, json) {
    const alert_section = document.querySelector('.alert-section');
    const alert_span = document.createElement("span");

    alert_span.classList.add('alert', 'alert-dismissible', 
        'fade', 'show', 'fixed-top', 'w-25', 'mt-5', 'mx-auto',
        (ok ? 'alert-success' : 'alert-danger')
    );
    alert_span.role = "alert";
    
    const status_message = document.createElement('strong');
    status_message.innerHTML = (ok ? 'Success.' : 'Error.');

    alert_span.appendChild(status_message);

    const ul = document.createElement('ul');
    ul.classList.add('m-0');
    Object.values(json).forEach(message => {
        const li = document.createElement('li');
        li.innerHTML = message;
        ul.appendChild(li);
    });

    alert_span.appendChild(ul);

    const close_button = document.createElement('button');
    close_button.type = 'button';
    close_button.classList.add('btn-close');
    close_button.setAttribute('data-bs-dismiss', 'alert');
    close_button.setAttribute('aria-label', 'Close');

    alert_span.appendChild(close_button);

    setTimeout(function() {
        alert_span.remove();
    }, 3000);
    alert_section.appendChild(alert_span);
}