"use strict"

let masters = document.querySelectorAll(".master-checkbox , .master-checkbox-reverse");

masters.forEach(master => {
    let check_state = master.querySelector(".form-check:first-child .form-check-input");
    let reversed = master.classList.contains("master-checkbox-reverse");

    check_state.addEventListener("change", function () {
        let to_toggle = master.querySelectorAll(".form-check:not(:first-child) .form-check-input");

        if (check_state.checked != reversed) {
            to_toggle.forEach(element => {
                element.removeAttribute("disabled");
            });
        } else {
            to_toggle.forEach(element => {
                element.setAttribute("disabled", "");
            });
        }
    });
    
    let event = new Event('change');
    check_state.dispatchEvent(event);
});
