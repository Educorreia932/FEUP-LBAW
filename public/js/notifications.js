let toasts = document.querySelectorAll(".toast");
let toastInstances = []

toasts.forEach(function (e) {
    let toastInstance = new bootstrap.Toast(e, {
        autohide: false
    });

    toastInstances.push(toastInstance);
})

for (const toastInstance of toastInstances) {
    toastInstance.show();
}
