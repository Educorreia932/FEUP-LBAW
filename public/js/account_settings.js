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
