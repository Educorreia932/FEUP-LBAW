const user_entries = document.querySelectorAll('.user-entry');

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
                    console.log("BaNiDo");
                }
            });
        } else {
            // Unban
            request = new Request('/admin/unban/' + user_id, { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    console.log("DeSbANiDo")
                }
            });
        }
    }, false);
});
