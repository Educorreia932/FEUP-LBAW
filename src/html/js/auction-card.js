const cardTitles = document.querySelectorAll('.card-title');

for (let title of cardTitles)
    if (title.textContent.length > 17)
        title.textContent = title.textContent.substring(0, 16) + "...";
