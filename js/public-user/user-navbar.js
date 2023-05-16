var path = window.location.pathname;

if (path.includes('home.php')){
    document.getElementById('home-link').classList.add('active');
}

if (path.includes('articles.php') || (path.includes('article_view.php'))){
    document.getElementById('pb-link').classList.add('active');
}
