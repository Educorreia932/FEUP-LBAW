const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");
const notificationCount = document.getElementById("notification-count");
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

        request.addEventListener("load", function() {
            const responseJson = JSON.parse(this.responseText);

            notificationCount.innerText = `${responseJson.unread_count}`;
        })
    });
}
