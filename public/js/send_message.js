function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

const form = document.getElementById("send-message-form");

form.addEventListener("submit", function (event) {
    event.preventDefault();

    sendMessage()
});

function sendMessage() {
    const body = document.getElementById("body").value;
    const sender_id = document.getElementById("sender_id").value;
    const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");
    const request = new XMLHttpRequest();

    request.open("PUT", "/messages/1");
    request.setRequestHeader("X-CSRF-TOKEN", csrf);
    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.addEventListener("error", function () {
        console.log(this.responseText);
    });

    request.addEventListener("load", function () {
        console.log(this.responseText);
    });

    request.send(encodeForAjax({
        body: body,
        sender_id: sender_id
    }));
}
