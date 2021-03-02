const uploadBtn = document.getElementById('imageFile');

uploadBtn.addEventListener('change', handleImage)

function handleImage() {
    var input = this;

    var fileName = input.files[0].name;
    console.log('File name: ' + fileName);
    console.log(this.value);

    let carousel = document.querySelector('.carousel-inner');

    let item = document.createElement('div')
    item.className = 'carousel-item';
    let img = document.createElement('img');
    img.className = 'd-block w-100';
    img.src = this.value;
    item.appendChild(img);

    carousel.appendChild(item);
}
