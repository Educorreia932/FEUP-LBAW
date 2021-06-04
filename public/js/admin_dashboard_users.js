import { createPopUpAlert } from './alerts.js';

const user_entries = document.querySelectorAll('.user-entry');
user_entries.forEach(elem => {

    const banned = elem.querySelector('.check_banned');
    const sell = elem.querySelector('.check_sell');
    const bid = elem.querySelector('.check_bid');

    banned.addEventListener('change', function(ev) {

        // disable non master checkboxes
        if (sell.getAttribute("disabled") === null) {
            sell.setAttribute("disabled", true);
            bid.setAttribute("disabled", true);
        }
        else {
            sell.removeAttribute("disabled");
            bid.removeAttribute("disabled");
        }


        // send ajax request (ban or unban user)
        const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        const myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        const user_id = elem.getAttribute("id");
        if (banned.checked) {
            // Is now banned
            const request = new Request('/admin/ban/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request)
                .then(response => {
                    response.json().then(json => {
                        createPopUpAlert(response.ok, json);
                    });
                });
        } else {
            // Unban
            const request = new Request('/admin/unban/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request)
                .then(response => {
                    response.json().then(json => {
                        createPopUpAlert(response.ok, json);
                    });
                });
        }
    }, false);


    sell.addEventListener('change', () => {
        // send ajax request (ban or unban user)
        const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        const myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        const user_id = elem.getAttribute("id");
        if (!sell.checked) {
            // Is now banned
            const request = new Request('/admin/revoke_sell/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request)
                .then(response => {
                    response.json().then(json => {
                        createPopUpAlert(response.ok, json);
                    });
                });
        } else {
            // Unban
            const request = new Request('/admin/restore_sell/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request)
                .then(response => {
                    response.json().then(json => {
                        createPopUpAlert(response.ok, json);
                    });
                });
        }
    }, false);


    bid.addEventListener('change', function(ev) {
        // send ajax request (ban or unban user)
        const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        const myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        const user_id = elem.getAttribute("id");
        if (!bid.checked) {
            // Is now banned
            const request = new Request('/admin/revoke_bid/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request)
                .then(response => {
                    response.json().then(json => {
                        createPopUpAlert(response.ok, json);
                    });
                });
        } else {
            // Unban
            const request = new Request('/admin/restore_bid/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request)
                .then(response => {
                    response.json().then(json => {
                        createPopUpAlert(response.ok, json);
                    });
                });
        }
    }, false);
});
