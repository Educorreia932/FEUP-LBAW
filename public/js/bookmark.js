let marks = document.querySelectorAll('.auction-bookmark');

marks.forEach(elem => {
    elem.addEventListener('click', function(ev) {
        target = elem.querySelector('i');

        if (target.classList.contains("bi-bookmark-plus")) {
            // Is now bookmarked
            target.classList.remove("bi-bookmark-plus");
            target.classList.add("bi-bookmark-dash-fill");
        } else {
            // Removed bookmark
            target.classList.add("bi-bookmark-plus");
            target.classList.remove("bi-bookmark-dash-fill");
        }
    }, false);
});