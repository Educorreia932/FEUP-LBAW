const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");
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

    toastInstance._element.addEventListener("click", function () {
        const notification_id = toastInstance._element.querySelector("#notification_id");
        const request = new XMLHttpRequest();

        request.open('DELETE', `/notification/${notification_id.innerText}`);
        request.setRequestHeader('X-CSRF-TOKEN', csrf);
        request.send();

        request.addEventListener("error", function() {
            console.log(this.response.text);
        })
    });
}
