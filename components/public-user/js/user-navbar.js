var path = window.location.pathname;

if (path.includes('home.php')){
    document.getElementById('home-link').classList.add('active');
}

if (path.includes('articles.php') || (path.includes('article_view.php'))){
    document.getElementById('pb-link').classList.add('active');
}

if (path.includes('ipa.php') || (path.includes('ipa-view.php'))){
    document.getElementById('ipa-link').classList.add('active');
}

if (path.includes('about.php')){
    document.getElementById('abt-link').classList.add('active');
}