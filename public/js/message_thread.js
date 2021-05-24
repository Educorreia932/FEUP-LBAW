function genMessage(body, user_id, username, name, isOwn) {
    return `
        <div class="message mb-3 d-flex align-items-center
        ${isOwn ? 'align-self-end flex-row-reverse' : 'align-self-start flex-row'}"
        style="max-width: 70%; min-width: 45%;">

        <img style="border-radius:50%;" width="40" height="40"
            src="/images/users/${user_id}_small.jpg"
            alt="Profile Image"
            class="m-3"
        >

        <div class="flex-grow-1 ${isOwn ? 'bg-primary text-white' : 'bg-white'} d-inline-block p-2 rounded px-3">
            <a class="${isOwn ? 'link-light' : 'link-dark'} text-decoration-none"
            href="/users/${username}">
                <strong>${name}</strong>
            </a>
            <p class="m-0">${body}</p>
        </div>

        <p class="m-1 text-muted flex-shrink-0">Just now</p>
    </div>
    `;
}

// OTHERS
const form = document.getElementById("send-message-form");
const messages = document.getElementById("messages");

// Scroll to recent
messages.scrollTop = messages.scrollHeight;

// SEND MESSAGE
function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
}

form.addEventListener("submit", function (event) {
    event.preventDefault();

    sendMessage()
});

function sendMessage() {
    const body_elem = document.getElementById("body");
    const sender_id = document.getElementById("sender_id");
    const thread_id = document.getElementById("thread_id");
    const csrf = document.querySelector("meta[name='csrf-token']").getAttribute("content");
    const request = new Request(`/messages/${thread_id.value}`, {
        method: 'PUT',
        headers: new Headers({
            "X-CSRF-TOKEN": csrf,
            'X-Socket-ID': Echo.socketId(),
            'Content-Type': 'application/x-www-form-urlencoded',
        }),
        body: encodeForAjax({
            body: body_elem.value,
            sender_id: sender_id.value
        }),
    });

    fetch(request)
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Something went wrong on api server!');
            }
        })
        .then(response => {
            const user = document.getElementById('user-data');
            let messages = document.getElementById('messages');
            messages.innerHTML += genMessage(body_elem.value, user.dataset.id, user.dataset.username, user.dataset.name, true);

            // Update threads
            updateThread({'body': body_elem.value, 'thread_id': document.getElementById("thread-identifier").dataset.threadId});

            // Scroll to recent
            messages.scrollTop = messages.scrollHeight;

            // Clear input
            body_elem.value = "";
        }).catch(error => {
            console.error(error);
        });
}



// RECEIVE OTHER'S MESSAGES
let order_cur = -1;
function updateThread(e) {
    console.log(e.thread_id);
    let thread = document.querySelector(`.message-thread-entry[data-thread-id="${e.thread_id}"]`);

    thread.querySelector(".message-thread-timestamp").innerHTML = "just now";
    thread.querySelector(".message-thread-body").innerHTML = e.body;

    thread.style.order = order_cur;
    order_cur -= 1;
}

// Subscribe to current thread
let thread_id = document.getElementById("thread-identifier").dataset.threadId;
Echo.private(`message_thread.${thread_id}`)
    .listen('MessageSent', (e) => {
        let messages = document.getElementById("messages");
        messages.innerHTML += genMessage(e.body, e.sender_id, e.sender_username, e.sender_name, false);

        // Scroll to recent
        messages.scrollTop = messages.scrollHeight;
    });

// Subscribe to remaining threads
document.querySelectorAll('.message-thread-entry').
    forEach(function(elem) {
        Echo.private(`message_thread.${elem.dataset.threadId}`)
            .listen('MessageSent', updateThread);
    });

