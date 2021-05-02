const modal = document.getElementById('edit-modal')
modal.addEventListener('show.bs.modal', function () {
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  // Update the modal's content.
  let inputName = document.getElementById('inputName');
  let inputDescription = document.getElementById('inputDescription');

  let startDate = document.getElementById('startDate');
  let endDate = document.getElementById('endDate');

  let startTime = document.getElementById('startTime');
  let endTime = document.getElementById('endTime');

  let startBid = document.getElementById('inputValue');
  let category = document.querySelector('.form-select');

  // Temporary
  startTime.value = "12:30";
  endTime.value = "12:30";
  startDate.value = "2021-02-09";
  endDate.value = "2021-02-09";
  startBid.value = 5;
  category.selectedIndex = 1;
  inputName.value = "JoJo Eyes of Heaven PS4 Key";
  let desc = document.querySelector("#product-information p");
  inputDescription.value = desc.textContent;
})
