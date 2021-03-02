const uploadFile = document.getElementById('imageFile');

uploadFile.addEventListener('change', handleImage)

var active = false;

function handleImage() {

    var fileName = this.files[0].name;
    console.log('File name: ' + fileName);

    let img = document.createElement('img');
    img.className = 'd-block w-100';

    if (this.files) {
        const fileReader = new FileReader();

        fileReader.addEventListener("load", function () {
            // convert image to base64 encoded string
            img.setAttribute("src", this.result);
            console.log(this.result);
        });
        fileReader.readAsDataURL(this.files[0]);

        let carousel = document.querySelector('.carousel-inner');

        let item = document.createElement('div')

        item.className = 'carousel-item';
        if (!active) {
            item.className = 'carousel-item active';
            active = true;
        }
        
        img.src = this.value;
        item.appendChild(img);

        carousel.appendChild(item);
    }
    
}
