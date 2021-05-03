let marks = document.querySelectorAll('.follow');

marks.forEach(elem => {
    elem.addEventListener('click', function(ev) {
        target = elem.querySelector('i');
        target_span = elem.querySelector('span');
        member_username = elem.getAttribute('member_username');

        csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        var myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        if (target.classList.contains("bi-heart")) {
            // Is now following
            request = new Request('/users/' + member_username + '/follow', { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    target.classList.remove("bi-heart");
                    target.classList.add("bi-heart-fill");
                    elem.classList.add("btn-danger");
                    elem.classList.remove("btn-outline-danger");
                    target_span.innerHTML = "Following";
                }
            });
        } else {
            // Stopped following
            request = new Request('/users/' + member_username + '/follow', { method: 'DELETE', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    target.classList.add("bi-heart");
                    target.classList.remove("bi-heart-fill");
                    elem.classList.add("btn-outline-danger");
                    elem.classList.remove("btn-danger");
                    target_span.innerHTML = "Follow";
                }
            });
        }
    }, false);
});
