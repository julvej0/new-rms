const sortBtn = document.getElementById('btn-sort');
const sortOptions = document.querySelector('#main-content .header .sort-btn .sort-links');


sortBtn.addEventListener('click', (e) => {
    e.preventDefault();
    sortOptions.classList.toggle('show');
})

const filterBtn = document.getElementById('btn-filter');
const filterOptions = document.querySelector('.filter-options');
const closeBtn = document.querySelector('#main-content .header .filter-btn .filter-options form .icon');

filterBtn.addEventListener('click', (e) => {
    e.preventDefault();
    filterOptions.classList.add('show');
})

window.addEventListener('click', (e) => {
    if(e.target !== sortBtn){
        if(e.target !== sortOptions) {
            if(sortOptions.classList.contains('show')){
                sortOptions.classList.remove('show');
            }
        }
    }

    if(e.target === closeBtn) {
        filterOptions.classList.remove('show')
    }
})