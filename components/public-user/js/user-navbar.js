var path = window.location.pathname;

if (path.includes('home.php')){
    document.getElementById('home-link').classList.add('active');
}

if (path.includes('articles.php') || (path.includes('article_view.php'))){
    document.getElementById('pb-link').classList.add('active');
}

if (path.includes('ip-assets.php') || (path.includes('ip-assets-view.php'))){
    document.getElementById('ip-assets-link').classList.add('active');
}

if (path.includes('about.php')){
    document.getElementById('abt-link').classList.add('active');
}