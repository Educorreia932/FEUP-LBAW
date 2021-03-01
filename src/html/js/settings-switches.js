"use strict"

document.addEventListener('DOMContentLoaded', function() {
    let sw_notifications = document.querySelector("#switch-notifications").parentElement;

    sw_notifications.addEventListener("change", function() {
        let input_notifications = document.querySelector("#switch-notifications");
        let sw_to_toggle = input_notifications.parentElement.parentElement.querySelectorAll(".form-switch:not(:first-child) .form-check-input");

        if (input_notifications.checked)
            sw_to_toggle.forEach(element => {
                element.removeAttribute("disabled");
            });
        else
            sw_to_toggle.forEach(element => {
                element.setAttribute("disabled", "");
            });
    })
}, false);
