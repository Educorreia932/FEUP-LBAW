let marks = document.querySelectorAll('.follow');

marks.forEach(elem => {
    elem.addEventListener('click', function(ev) {
        let target = elem.querySelector('i');
        let target_span = elem.querySelector('span');
        let member_username = elem.getAttribute('member_username');

        let csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");

        let myHeaders = new Headers();
        myHeaders.append('X-CSRF-TOKEN', csrf);

        if (target.classList.contains("bi-heart")) {
            // Is now following
            request = new Request('/users/' + member_username + '/follow', { method: 'PUT', headers: myHeaders });
            fetch(request).then(function(response) {
                if (response.ok) {
                    target.classList.remove("bi-heart");
                    target.classList.add("bi-heart-fill");
                    elem.classList.add("btn-primary");
                    elem.classList.remove("btn-outline-primary");
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
                    elem.classList.add("btn-outline-primary");
                    elem.classList.remove("btn-primary");
                    target_span.innerHTML = "Follow";
                }
            });
        }
    }, false);
});
