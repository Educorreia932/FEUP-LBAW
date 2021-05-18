function change_preview() {

    let file = this.files[0];

    let preview = document.querySelector('#image-preview');

    if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
        const reader = new FileReader();
        
        reader.addEventListener('load', () => {
            preview.src = reader.result;
        }, false);

        reader.readAsDataURL(file);
    }
}

const input_file = document.getElementById('imageFile');

input_file.addEventListener('change', change_preview);

const form = document.getElementById('account_form');
/*
form.addEventListener('submit', (event) => {
    event.preventDefault()

    let requestBody = {};

    Object.keys(form.elements).forEach(key => {
        let element = form.elements[key];

        if (element.type !== 'submit')
            requestBody[element.name] = element.value;
    });

    console.log(requestBody);

    let csrf = document.querySelector("meta[name='csrf-token']");

    const headers = new Headers();
    headers.append('X-CSRF-TOKEN', csrf);

    const request = new Request('user/settings/account', {method: 'PUT', headers: headers, body: requestBody});

    fetch(request).then(function(response) {
        
    });

});*/