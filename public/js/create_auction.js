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
        deleteBtn.innerHTML = '<button class="btn btn-danger float-end"><i class="bi bi-trash"></i></button>';
        
        deleteBtn.addEventListener('click', removeItem);
        item.appendChild(deleteBtn);

        img.src = this.value;
        item.appendChild(img);
        itemCnt++;

        carousel.appendChild(item);
    }

    console.log(this.files)
    if (itemCnt > 1) {
        leftArrow.style.display = null;
        rightArrow.style.display = null;
    }
    
}

function removeItem() {

    let carouselItem = this.parentNode;
    carousel.removeChild(carouselItem);
    itemCnt--;
    
    // update image display
    if (itemCnt > 0) {
        let firstItem = carousel.querySelector('.carousel-item');
        firstItem.classList.add('active');
    }
}



// INCREMENT TYPE 
const incrSpan = document.getElementById("incrSpan");
incrSpan.style.cursor = "pointer";
const incrCheck = document.getElementById("incrPercent");
// toggle increment type every time the span is clicked
incrSpan.addEventListener('click', function () {
    if (!incrCheck.checked)
        incrSpan.innerText = "%";
    else
        incrSpan.innerText = "φ";
    incrCheck.checked = !incrCheck.checked;
});
