const auction_entries = document.querySelectorAll('.auction-entry');
const alert_section = document.querySelector('.alert-section');

function createPopUpAlert(status, message) {
    let alert_span = document.createElement("span");
    alert_span.className = "alert alert-success alert-dismissible fade show fixed-top w-25 mt-5 translate-middle start-50";
    alert_span.role = "alert";
    alert_span.innerHTML = '<strong>' + status + '</strong> ' + message + 
                           '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
    setTimeout(function() {
        alert_span.remove();
    }, 2000);
    alert_section.appendChild(alert_span);
}

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
                    this.createPopUpAlert("Ok", "Auction activated.")
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
                    this.createPopUpAlert("Ok", "Auction terminated.")
                }
            });
        }

    }, false);
});
