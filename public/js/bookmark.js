let marks = document.querySelectorAll('.auction-bookmark');

marks.forEach(elem => {
    elem.addEventListener('click', function(ev) {
        target = elem.querySelector('i');
        auction_id = elem.getAttribute('auction_id');

        csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        var myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        if (target.classList.contains("bi-bookmark-plus")) {
            // Is now bookmarked
            request = new Request('/auction/' + auction_id + '/bookmark', { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    target.classList.remove("bi-bookmark-plus");
                    target.classList.add("bi-bookmark-dash-fill");
                }
            });
        } else {
            // Removed bookmark
            request = new Request('/auction/' + auction_id + '/bookmark', { method: 'DELETE', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    target.classList.add("bi-bookmark-plus");
                    target.classList.remove("bi-bookmark-dash-fill");
                }
            });
        }
    }, false);
});
