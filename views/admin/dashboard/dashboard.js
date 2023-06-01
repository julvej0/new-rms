//TODO: transfer all scripts in dashboard.php here


// Nav Buttons

const navBtns = document.querySelectorAll('main .routes .nav-button');
const subpage = document.querySelectorAll('main .sub-page');

navBtns.forEach(navlinks => {
    navlinks.addEventListener('click', (e) => {
        e.preventDefault();
        navBtns.forEach(b => {
            b.classList.remove('focused');
        })
        subpage.forEach(page => {
            page.classList.remove('active');
        })

        const target = navlinks.dataset.target;
        document.querySelector(target).classList.add('active');

        navlinks.classList.toggle('focused')
    })
})

document.querySelector('#pb-page').classList.add('active');
document.querySelector('.nav-button[data-target="#pb-page"]').classList.add('focused');