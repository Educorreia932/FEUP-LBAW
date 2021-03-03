const uploadFile = document.getElementById('imageFile');
const carousel = document.querySelector('.carousel-inner');

const leftArrow = document.querySelector('.carousel-control-prev');
const rightArrow = document.querySelector('.carousel-control-next');
leftArrow.style.display = 'none';
rightArrow.style.display = 'none';

uploadFile.addEventListener('change', handleImage)

var itemCnt = 0;

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
        });
        fileReader.readAsDataURL(this.files[0]);

        
        let item = document.createElement('div')

        item.className = 'carousel-item';
        if (itemCnt == 0)
            item.className = 'carousel-item active';

        let deleteBtn = document.createElement('div');
        deleteBtn.className = 'carousel-caption d-sm-block pb-0';
        deleteBtn.innerHTML = '<button class="btn btn-danger float-end"><i class="bi bi-trash"></i></butotn>';
        
        deleteBtn.addEventListener('click', removeItem);
        item.appendChild(deleteBtn);

        img.src = this.value;
        item.appendChild(img);
        itemCnt++;

        carousel.appendChild(item);
    }

    console.log(itemCnt);
    if (itemCnt > 1) {
        leftArrow.style.display = null;
        rightArrow.style.display = null;
    }
    
}

function removeItem() {

    let carouselItem = this.parentNode;
    carousel.removeChild(carouselItem);
    itemCnt--;
    
    if (itemCnt != 0) {
        carousel.childNodes[itemCnt].classList.add('active');
    }
}

