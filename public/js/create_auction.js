const uploadFile = document.getElementById('imageFile');
const carousel = document.querySelector('.carousel-inner');

const leftArrow = document.querySelector('.carousel-control-prev');
const rightArrow = document.querySelector('.carousel-control-next');
leftArrow.style.display = 'none';
rightArrow.style.display = 'none';

uploadFile.addEventListener('change', handleImage)

var itemCnt = 0

function createImageTags(src) {
    let img = document.createElement('img');
    img.className = 'd-block w-100';
    img.setAttribute('src', src)

    let item = document.createElement('div')

    item.className = 'carousel-item' + (itemCnt == 0 ? ' active' : '');

    // let deleteBtn = document.createElement('div');
    // deleteBtn.className = 'carousel-caption d-sm-block pb-0';
    // deleteBtn.innerHTML = '<button class="btn btn-danger float-end"><i class="bi bi-trash"></i></button>';

    // deleteBtn.addEventListener('click', removeItem);
    // item.appendChild(deleteBtn);

    item.appendChild(img);
    itemCnt++;

    return item;
}

function handleImage() {
    let files = this.files;

    carousel.innerHTML = "";

    function readAndPreview(file) {

      // Make sure `file.name` matches our extensions criteria
      if ( /\.(jpe?g|png|gif)$/i.test(file.name) ) {
        let reader = new FileReader();

        reader.addEventListener("load", function () {
            console.log("uwu");
            carousel.appendChild(createImageTags(this.result));
        }, false);

        reader.readAsDataURL(file);
      }

    }

    itemCnt = 0
    if (files.length > 0) {
        Array.prototype.forEach.call(files, readAndPreview);
        leftArrow.style.display = null;
        rightArrow.style.display = null;
    } else {
        leftArrow.style.display = 'none';
        rightArrow.style.display = 'none';
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
const incrInput = document.getElementById("inputIncr");
incrSpan.style.cursor = "pointer";
const incrCheck = document.getElementById("incrPercent");

var fixed_val = null
var percent_val = null
var fixed_placeholder = '0.20'
var percent_placeholder = '5'

// toggle increment type every time the span is clicked
incrSpan.addEventListener('click', function () {
    if (!incrCheck.checked) {
        // Go to percent
        incrSpan.innerText = "%";
        fixed_val = incrInput.value;
        incrInput.value = percent_val;
        incrInput.placeholder = percent_placeholder;
        incrInput.min = 1;
        incrInput.max = 50;
        incrInput.step = 1;
    }
    else {
        // Go to fixed
        incrSpan.innerText = "φ";
        percent_val = incrInput.value;
        incrInput.value = fixed_val;
        incrInput.placeholder = fixed_placeholder;
        incrInput.min = 0.01;
        incrInput.max = null;
        incrInput.step = 0.01;
    }
    incrCheck.checked = !incrCheck.checked;
});
