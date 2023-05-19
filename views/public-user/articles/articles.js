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

//check all campuses
let checkAll = document.querySelector('input[id=all]');
let campuses = document.querySelectorAll('input[class=campus-bsu]');

checkAll.addEventListener('change', function() {
    if (this.checked) {
        campuses.forEach(function(checkbox){
            checkbox.checked = true;
        });
    } else{
        campuses.forEach(function(checkbox){
            checkbox.checked = false;
        });
    }
});