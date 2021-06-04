import { createPopUpAlert } from './alerts.js';

const auction_entries = document.querySelectorAll('.auction-entry');
auction_entries.forEach(elem => {
    
    const active = elem.querySelector('.active-input');
    const term = elem.querySelector('.term-input');

    active.addEventListener('change', () => {
        // send ajax request (activate or terminate auction)
        const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        const myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        const auction_id = elem.getAttribute("id");
        if (active.checked) {
            // Is now banned
            const request = new Request('/admin/activate_auction/' + auction_id, { method: 'PUT', headers: myHeaders });
            fetch(request)
                .then(response => {
                    response.json().then(json => {
                        createPopUpAlert(response.ok, json);
                    });
                });
        }
    }, false);


    term.addEventListener('change', () => {
        // send ajax request (ban or unban user)
        const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        const myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        const auction_id = elem.getAttribute("id");
        if (term.checked) {
            // Auction terminated
            const request = new Request('/admin/terminate_auction/' + auction_id, { method: 'PUT', headers: myHeaders });
            fetch(request)
                .then(response => {
                    response.json().then(json => {
                        createPopUpAlert(response.ok, json);
                    });
                });
        }

    }, false);
});
