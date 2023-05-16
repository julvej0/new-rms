// FILTER
const allFilter = document.querySelectorAll('main .header .left .filter');
allFilter.forEach(item => {
    const filterBtn = item.querySelector('.btn');
    const filterLink = item.querySelector('.filter-link');
    const dropdownItems = item.querySelectorAll('a');

    filterBtn.addEventListener('click', (e) => {
        e.preventDefault();
        filterLink.classList.toggle('show');
    })

    dropdownItems.forEach(choices => {
        choices.addEventListener('click', () => {
            var icon = document.querySelector('.icon');
            const selected = choices.textContent;
            iconString = icon.toString();

            filterBtn.innerHTML = selected + "<i class='bx bx-chevron-down icon'></i>";
        });
    });
});

window.addEventListener('click', (e) => {
    allFilter.forEach(item => {
        const filterBtn = item.querySelector('.btn');
        const filterLink = item.querySelector('.filter-link');

        if(e.target !== filterBtn){
            if(e.target !== filterLink){
                if(filterLink.classList.contains('show')){
                    filterLink.classList.remove('show');
                }
            }
        }
    })
})