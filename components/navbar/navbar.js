// SIDEBAR DROP DOWN
document.addEventListener("DOMContentLoaded", () => {
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
	const toggleSidebar = document.querySelector('.toggle-sidebar');
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

	const dashboardContent = document.querySelector('#appbar-and-content');
	toggleSidebar.addEventListener('click', function () {
		sidebar.classList.toggle('collapse-down');
		dashboardContent.classList.toggle('collapse-wide');

		if(sidebar.classList.contains('collapse-down')) {
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
	console.log("path: " + path);

	if(path.includes("dashboard.php")){
		document.getElementById('dashboard-link').classList.add('active');
	}

	if(path.includes("publications.php") || path.includes("new-publication.php")){
		document.getElementById('publication-link').classList.add('active');
	}

	if(path.includes("ip-assets.php") || path.includes("new-ip-asset.php")){
		console.log("inside ip-assets");
		document.getElementById('ip-assets-link').classList.add('active');
	}

	if(path.includes("authors.php") || path.includes("new-author.php")){
		document.getElementById('author-link').classList.add('active');
	}

	if(path.includes("change-password.php") || path.includes("user-profile.php")){
		document.getElementById('account-link').classList.add("active");
	}

	if(path.includes("user-accounts.php")){
		document.getElementById('user-accounts-link').classList.add("active");
	}

	if(path.includes("user-profile.php")){
		document.getElementById('user-link').classList.add("active");
		document.querySelector('#sidebar .side-dropdown').classList.add('show');
	}

	if(path.includes("change-password.php")){
		document.getElementById('security-link').classList.add("active");
		document.querySelector('#sidebar .side-dropdown').classList.add('show');
	}
});
