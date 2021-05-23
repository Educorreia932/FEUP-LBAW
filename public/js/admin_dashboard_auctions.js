const auction_entries = document.querySelectorAll('.auction-entry');

auction_entries.forEach(elem => {

    let active = elem.querySelector('.active-input');
    let term = elem.querySelector('.term-input');

    active.addEventListener('change', function(ev) {
        // send ajax request (activate or terminate auction)
        let csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        let myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        let auction_id = elem.getAttribute("auction_id");
        if (active.checked) {
            // Is now banned
            request = new Request('/admin/activate_auction/' + auction_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    console.log("Auction activated");
                }
            }).catch((e) => {
                console.log("Error");
                console.error(e);

            });
        }
    }, false);


    term.addEventListener('change', function(ev) {
        // send ajax request (ban or unban user)
        let csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        let myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        let auction_id = elem.getAttribute("auction_id");
        if (term.checked) {
            // Auction terminated
            request = new Request('/admin/terminate_auction/' + auction_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    console.log("Auction terminated");
                }
            });
        }

    }, false);
});
