"use strict"

let masters = document.querySelectorAll(".master-checkbox , .master-checkbox-reverse");

// console.log(masters);

masters.forEach(master => {
    let check_state = master.querySelector(".form-check.master .form-check-input");
    let reversed = master.classList.contains("master-checkbox-reverse");

    if (check_state == null) {
        // console.log("[!] Missing elements in master-checkbox");
        return;
    }

    check_state.addEventListener("change", function () {
        let to_toggle = master.querySelectorAll(".form-check:not(.master) .form-check-input");

        if (check_state.checked !== reversed) {
            to_toggle.forEach(element => {
                element.removeAttribute("disabled");
            });
        }

        else {
            to_toggle.forEach(element => {
                element.setAttribute("disabled", "");
            });
        }
    });

    let event = new Event('change');
    check_state.dispatchEvent(event);
});
