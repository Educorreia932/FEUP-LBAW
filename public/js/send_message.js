function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

const form = document.getElementById("send-message-form");
const messages = document.getElementById("messages");

messages.scrollTop = messages.scrollHeight;

form.addEventListener("submit", function (event) {
    event.preventDefault();

    sendMessage()
});

function sendMessage() {
    const body = document.getElementById("body");
    const sender_id = document.getElementById("sender_id");
    const thread_id = document.getElementById("thread_id");
    const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");
    const request = new XMLHttpRequest();

    request.open("PUT", `/messages/${thread_id.value}`);
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
        body: body.value,
        sender_id: sender_id.value
    }));

    body.value = "";
}
