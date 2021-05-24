function toggle_setting(setting) {
    const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

    const headers = new Headers();
    headers.append('X-CSRF-TOKEN', csrf);
    headers.append('Content-Type', 'application/json');

    const request = new Request('/user/settings/privacy/toggle', {method: 'PUT', headers: headers, body: JSON.stringify({"setting": setting})});

    fetch(request)
        .then(response => {
            response.json().then(json => {
                const status_div = document.getElementById('status-messages');
                const status = document.createElement('div');
                if (response.ok) {
                    status.classList.add('alert', 'alert-success');
                    status.id = 'status_ok';
                } else {
                    status.classList.add('alert', 'alert-danger');
                    status.id = 'status_error';
                }
                
                const ul = document.createElement('ul');
                Object.values(json).forEach(message => {
                    const li = document.createElement('li');
                    li.innerHTML = message;
                    ul.appendChild(li);
                });

                status.appendChild(ul);
                status_div.innerHTML = '';
                status_div.appendChild(status);
                
            });
        });
}

document.getElementById("switch-nsfw").addEventListener('click', () => toggle_setting('nsfw_consent'));
document.getElementById("switch-use-data").addEventListener('click', () => toggle_setting('data_consent'));
document.getElementById("switch-notifications").addEventListener('click', () => toggle_setting('notifications'));
document.getElementById("switch-outbid-notifications").addEventListener('click', () => toggle_setting('outbid_notifications'));
document.getElementById("switch-start-auction-notifications").addEventListener('click', () => toggle_setting('start_auction_notifications'));
document.getElementById("switch-user-activity-notifications").addEventListener('click', () => toggle_setting('followed_user_activity'));