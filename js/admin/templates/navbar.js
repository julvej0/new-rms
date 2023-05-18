// SIDEBAR DROP DOWN
const allDropdown = document.querySelectorAll('#sidebar .side-dropdown');

allDropdown.forEach(item => {
    const a = item.parentElement.querySelector('a:first-child');
    a.addEventListener('click', function (e) {
        e.preventDefault();

        if(!this.classList.contains('active')){
            allDropdown.forEach(i => {
                const aLink = i.parentElement.querySelector('a:first-child');

                aLink.classList.remove('active');
                i.classList.remove('show');
            })
        }

        this.classList.toggle('active');
        item.classList.toggle('show');
    })
})

// SIDEBAR COLLAPSE
const toggleSidebar = document.querySelector('nav .toggle-sidebar');
const allSideDivider = document.querySelectorAll('#sidebar .divider');

if(sidebar.classList.contains('hide')) {
	allSideDivider.forEach(item=> {
		item.textContent = '-'
	})
	allDropdown.forEach(item=> {
		const a = item.parentElement.querySelector('a:first-child');
		a.classList.remove('active');
		item.classList.remove('show');
	})
} else {
	allSideDivider.forEach(item=> {
		item.textContent = item.dataset.text;
	})
}

toggleSidebar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');

	if(sidebar.classList.contains('hide')) {
		allSideDivider.forEach(item=> {
			item.textContent = '-'
		})

		allDropdown.forEach(item=> {
			const a = item.parentElement.querySelector('a:first-child');
			a.classList.remove('active');
			item.classList.remove('show');
		})
	} else {
		allSideDivider.forEach(item=> {
			item.textContent = item.dataset.text;
		})
	}
})


// NAVLINKS
var path = window.location.pathname;

if(path.includes("dashboard.php")){
	document.getElementById('dashboard-link').classList.add('active');
}

if(path.includes("publications.php") || path.includes("new-publication.php")){
	document.getElementById('publication-link').classList.add('active');
}

if(path.includes("ip-assets.php") || path.includes("new-ip-asset.php")){
	document.getElementById('ip-assets-link').classList.add('active');
}

if(path.includes("authors.php") || path.includes("new-author.php")){
	document.getElementById('author-link').classList.add('active');
}

if(path.includes("user-security.php") || path.includes("user-profile.php")){
	document.getElementById('account-link').classList.add("active");
}

if(path.includes("user-accounts.php")){
	document.getElementById('user-accounts-link').classList.add("active");
}

if(path.includes("user-profile.php")){
	document.getElementById('user-link').classList.add("active");
	document.querySelector('#sidebar .side-dropdown').classList.add('show');
}

if(path.includes("user-security.php")){
	document.getElementById('security-link').classList.add("active");
	document.querySelector('#sidebar .side-dropdown').classList.add('show');
}