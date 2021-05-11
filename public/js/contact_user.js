// Contact User Radio
const contact_user_form = document.getElementById("contact-user-form");
const thread_select = document.getElementById("thread-select");
const destination_div = document.getElementById("destination-div");
const radios = destination_div.querySelectorAll('input[type="radio"]');

for (const radio of radios) {
    radio.addEventListener("change", function () {
        if (this.value === "create-thread") {
            contact_user_form.action = "/messages";
            thread_select.disabled = true;
        } else {
            thread_select.disabled = false;
            contact_user_form.action = `/messages/${thread_select.value}/add_participant`;
        }
    })
}

thread_select.addEventListener("", function () {
    contact_user_form.action = `/messages/${thread_select.value}/add_participant`;
});
