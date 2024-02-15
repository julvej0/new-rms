import batstateulogo from "../../../assets/images/batStateUNeu-logo.png";

import { Link } from "react-router-dom";

function Home() {
  return (
    <>
      <div id="loading-screen">
        <div className="loading-img">
          <Link href="/">
            <a>
              <img
                src={batstateulogo}
                alt="/"
                width="85"
                height="90"
                className=""
              />
            </a>
          </Link>
        </div>
      </div>
      <div className="">
        <section className="w-full h-[550px] bg-[linear-gradient(rgba(0,0,0,0.315),rgba(0,0,0,0.4)),url('./assets//images/vipcorals.webp')] bg-no-repeat bg-cover bg-center aspect-[12/6] flex flex-col justify-center items-center gap-[50px] border-[color:var(--bg-grey)] border-[3px] border-solid">
          <div className="rms-title">
            <h1 className="text-white tracking-[1px] text-6xl w-[800px] text-center text-shadow-xl ">
              Research Management Services
            </h1>
          </div>
          <div className="search">
            <form id="search-form">
              <div className="form-group">
                <select name="dropdown" id="select-option">
                  <option value="publications">Publications</option>
                  <option value="ip-assets">IP Assets</option>
                </select>
              </div>
              <div className="form-group">
                <input type="text" placeholder="Search" id="txt-search" />
                <i className="bx bx-search icon" />
              </div>
            </form>
          </div>
        </section>
        <div className="main-container">
          <div className="content">
            <div className="text-white">
              <h3>Publications</h3>
            </div>
            <div className="card-container">
              <div className="card" id="card">
                <div className="card-content">
                  <h3>Top Contributors</h3>
                  <div className="table">
                    {"{"}/* Call the `getPublicationsContributors` function to
                    retrieve publications contributors using the database
                    connection object $conn */{"}"}
                    {"{"}/* echo getPublicationsContributors($authorurl,
                    $publicationurl) */{"}"}
                  </div>
                </div>
              </div>
              <div className="card " id="card">
                <div className="card-content">
                  <h3>Most Cited </h3>
                  <div className="table">
                    {"{"}/*{" "}
                    {/*?php
                        // Call the `getMostViewedPapers` function to retrieve the most viewed papers using the database connection object $conn
                        getMostViewedPapers($publicationurl)//($conn)
                        ?*/}{" "}
                    */{"}"}
                  </div>
                </div>
              </div>
              <div className="card " id="card">
                <div className="card-content">
                  <h3>Recently Added </h3>
                  <div className="table">
                    {"{"}/*{" "}
                    {/*?php
                        // Call the `getRecentPublications` function to retrieve the most recent publications using the database connection object $conn and a limit of 5
                        getRecentPublications($publicationurl)//($conn, 3)
                        ?*/}{" "}
                    */{"}"}
                  </div>
                </div>
              </div>
            </div>
            <div className="see-more-btn">
              <a href="../articles/articles.php">
                See More
                <i className="bx bx-right-arrow-alt icon" />
              </a>
            </div>
          </div>
          <div className="content">
            <div className="title">
              <h3>IP ASSETS</h3>
            </div>
            <div className="card-container">
              <div className="card">
                <div className="card-content">
                  <h3>Top Contributors</h3>
                  <div className="table">
                    {"{"}/*{" "}
                    {/*?php
                         // Call the `getIpAssetsContributors` function to retrieve the contributors of intellectual property (IP) assets using the database connection object $conn
                        getIpAssetsContributors($ipassetsurl, $authorurl)
                        ?*/}{" "}
                    */{"}"}
                  </div>
                </div>
              </div>
              <div className="card">
                <div className="card-content">
                  <h3>Top Campus with IP Assets</h3>
                  <div className="table">
                    {"{"}/*{" "}
                    {/*?php
                        //Call `getTopCampus` function to retrieve the top campus with most ip assets
                        getTopCampus($ipassetsurl)
                        ?*/}{" "}
                    */{"}"}
                  </div>
                </div>
              </div>
              <div className="card">
                <div className="card-content">
                  <h3>Recently Added</h3>
                  <div className="table">
                    {"{"}/*{" "}
                    {/*?php
                        // Call the `getRecentIpAssets` function to retrieve the most recent intellectual property (IP) assets using the database connection object $conn and a limit of 5
                        getRecentIpAssets($ipassetsurl)
                        ?*/}{" "}
                    */{"}"}
                  </div>
                </div>
              </div>
            </div>
            <div className="see-more-btn">
              <a href="../ip-assets/ip-assets.php">
                See More
                <i className="bx bx-right-arrow-alt icon" />
              </a>
            </div>
          </div>
          <div className="content">
            <div className="title">
              <h3>ABOUT</h3>
            </div>
            <div className="card-container">
              <div className="card abt-card">
                <div className="abt-img">
                  <img src="../../../assets/images/vipcorals.webp" alt="" />
                </div>
                <div className="abt-text">
                  <div className="title">
                    <h1>Why do we use it?</h1>
                    <p>
                      It is a long established fact that a reader will be
                      distracted by the readable content of a page when looking
                      at its layout. The point of using Lorem Ipsum is that it
                      has a more-or-less normal distribution of letters, as
                      opposed to using 'Content here, content here', making it
                      look like readable English.
                    </p>
                  </div>
                  <div className="see-more-btn">
                    <a href="#">
                      Read More
                      <i className="bx bx-right-arrow-alt icon" />
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}

export default Home;
