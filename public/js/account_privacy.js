import { createPopUpAlert } from "./alerts.js";

function toggle_setting(setting) {
    const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

    const headers = new Headers();
    headers.append('X-CSRF-TOKEN', csrf);
    headers.append('Content-Type', 'application/json');

    const request = new Request('/user/settings/privacy/toggle', {method: 'PUT', headers: headers, body: JSON.stringify({"setting": setting})});

    fetch(request)
        .then(response => {
            response.json().then(json => {
                createPopUpAlert(response.ok, json);
            });
        });
}

document.getElementById("switch-nsfw").addEventListener('click', () => toggle_setting('nsfw_consent'));
document.getElementById("switch-use-data").addEventListener('click', () => toggle_setting('data_consent'));
document.getElementById("switch-notifications").addEventListener('click', () => toggle_setting('notifications'));
document.getElementById("switch-outbid-notifications").addEventListener('click', () => toggle_setting('outbid_notifications'));
document.getElementById("switch-start-auction-notifications").addEventListener('click', () => toggle_setting('start_auction_notifications'));
document.getElementById("switch-user-activity-notifications").addEventListener('click', () => toggle_setting('followed_user_activity'));