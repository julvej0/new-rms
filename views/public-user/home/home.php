<title>RMS | Home</title>
<?php 
    include dirname(__FILE__, 4) . '/components/header/header.php';
    include dirname(__FILE__, 4) . '/helpers/db.php';
    include dirname(__FILE__, 4) . '/components/public-user/templates/user-navbar.php'; 
    include_once './functionalities/home-publication-functions.php';
    include_once './functionalities/home-ipassets-functions.php';
?>
<link rel="stylesheet" href="../../../css/index.css">
<link rel="stylesheet" href="./home.css">
<link rel="stylesheet" href="../../../css/animatev4.1.1.min.css"/>
<style>
      
#loading-screen{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    height: 100%;
    background-color:  rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 9999;
  }

.loading-img img {
    animation: load 2s ease-in-out infinite;
    width: 130px;
}

@keyframes load {
    0% {
        opacity: 0;
    }
    50% {
        opacity: 50%;
    }
    100% {
        opacity: 100%;
    }
}
</style>
<body>
<div id="loading-screen">
    <div class="loading-img">
        <img src="../../../assets/images/redspartan_logo.png" alt="redSpartan">
    </div>
</div>
<div class="home-content">
    <section id="hero-img">
        <div class="rms-title">
            <h1>Research Management Services</h1>
        </div>
        <div class="search">
            <form id="search-form">
                <div class="form-group">
                    <select name="dropdown" id="select-option">
                        <option value="publications">Publications</option>
                        <option value="ip-assets">IP Assets</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Search" id="txt-search">
                    <i class='bx bx-search icon' ></i>
                </div>
            </form>
        </div>
    </section>
    <div class="main-container">
        <div class="content">
            <div class="title">
                <h3>Publications</h3>
            </div>
            <div class="card-container">
                <div class="card" id="card">
                    <div class="card-content">
                        <h3>Top Contributors</h3>
                        <div class="table">
                            <?php 
                            // Call the `getPublicationsContributors` function to retrieve publications contributors using the database connection object $conn
                            echo getPublicationsContributors($authorurl, $publicationurl)
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card " id="card">
                    <div class="card-content">
                        <h3>Most Cited </h3>
                        <div class="table">
                            <?php
                            // Call the `getMostViewedPapers` function to retrieve the most viewed papers using the database connection object $conn
                            getMostViewedPapers($publicationurl)//($conn)
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card " id="card">
                    <div class="card-content">
                        <h3>Recently Added </h3>
                        <div class="table">
                            <?php
                            // Call the `getRecentPublications` function to retrieve the most recent publications using the database connection object $conn and a limit of 5
                            getRecentPublications($publicationurl)//($conn, 3)
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="see-more-btn">
                <a href="../articles/articles.php">See More<i class='bx bx-right-arrow-alt icon'></i></a>
            </div>
        </div>
        <div class="content">
            <div class="title">
                <h3>IP ASSETS</h3>
            </div>
            <div class="card-container">
                <div class="card">
                    <div class="card-content">
                        <h3>Top Contributors</h3>
                        <div class="table">
                            <?php
                             // Call the `getIpAssetsContributors` function to retrieve the contributors of intellectual property (IP) assets using the database connection object $conn
                            getIpAssetsContributors($ipassetsurl, $authorurl)
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Top Campus with IP Assets</h3>
                        <div class="table">
                            <?php
                            //Call `getTopCampus` function to retrieve the top campus with most ip assets
                            getTopCampus($ipassetsurl)
                            ?>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h3>Recently Added</h3>
                        <div class="table">
                            <?php
                            // Call the `getRecentIpAssets` function to retrieve the most recent intellectual property (IP) assets using the database connection object $conn and a limit of 5
                            getRecentIpAssets($ipassetsurl)
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="see-more-btn">
                <a href="../ip-assets/ip-assets.php">See More<i class='bx bx-right-arrow-alt icon'></i></a>
            </div>
        </div>
        <div class="content">
            <div class="title">
                <h3>ABOUT</h3>
            </div>
            <div class="card-container">
                <div class="card abt-card">
                     <div class="abt-img">
                        <img src="../../../assets/images/vipcorals.webp" alt="">
                     </div>
                     <div class="abt-text">
                        <div class="title">
                            <h1>Why do we use it?</h1>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                        </div>
                        <div class="see-more-btn">
                            <a href="#">Read More<i class='bx bx-right-arrow-alt icon'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    include dirname(__FILE__, 4) . '/components/public-user/templates/user-footer.php';
    include dirname(__FILE__, 4) . '/components/footer/footer.php';
?>
</body>
<script src="./home.js"></script>

<script>

    function search_func(event) {
        event.preventDefault(); // Prevents the form from being submitted in the traditional way

        var txt_search = document.getElementById('txt-search').value;
        var select_option = document.getElementById('select-option').value;

        if (select_option == "publications") {
            window.location.href = "../articles/articles.php?search-table=" + encodeURIComponent(txt_search);
        } else if (select_option == "ip-assets") {
            window.location.href = "../ipa/ipa.php?search-table=" + encodeURIComponent(txt_search);
        }
    }
    
    document.getElementById('search-form').addEventListener('submit', search_func);

    window.addEventListener("load", function() {
        var loadingScreen = document.getElementById("loading-screen");
        var body = document.querySelector('body');

        function enableScroll (){
            body.style.overflow ='auto';
        }

        loadingScreen.style.display = "none";
        enableScroll();
    });

</script>