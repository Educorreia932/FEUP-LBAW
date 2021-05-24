const user_entries = document.querySelectorAll('.user-entry');
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

user_entries.forEach(elem => {

    let banned = elem.querySelector('#filter_check_actions_banned');
    let sell = elem.querySelector('#filter_check_actions_sell');
    let bid = elem.querySelector('#filter_check_actions_bid');

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
        let csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        let myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        let user_id = elem.getAttribute("user_id");
        if (banned.checked) {
            // Is now banned
            request = new Request('/admin/ban/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    this.createPopUpAlert("Ok", "User banned.")
                }
            });
        } else {
            // Unban
            request = new Request('/admin/unban/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                   this.createPopUpAlert("Ok", "User unbanned.")
                }
            });
        }
    }, false);


    sell.addEventListener('change', function(ev) {
        // send ajax request (ban or unban user)
        let csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        let myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        let user_id = elem.getAttribute("user_id");
        if (!sell.checked) {
            // Is now banned
            request = new Request('/admin/revoke_sell/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    this.createPopUpAlert("Ok", "Selling privilege revoked.")
                   
                }
            }).catch((e) => {
                console.log("Error");
                console.error(e);

            });
        } else {
            // Unban
            request = new Request('/admin/restore_sell/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    this.createPopUpAlert("Ok", "Selling privilege restored.")
                }
            });
        }
    }, false);


    bid.addEventListener('change', function(ev) {
        // send ajax request (ban or unban user)
        let csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        let myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        let user_id = elem.getAttribute("user_id");
        if (!bid.checked) {
            // Is now banned
            request = new Request('/admin/revoke_bid/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    this.createPopUpAlert("Ok", "Bidding privilege revoked.")

                }
            });
        } else {
            // Unban
            request = new Request('/admin/restore_bid/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    this.createPopUpAlert("Ok", "Bidding privilege restored.")
                }
            });
        }
    }, false);
});
