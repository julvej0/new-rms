import React from "react";

const About = () => {
  return (
    <section id="main-content">
      <div className="page-title">
        <h3 className="animate__animated animate__fadeIn">About Us</h3>
      </div>
      <div className="about-content">
        <div className="left-content animate__animated animate__fadeIn">
          <img src="../../../assets/images/rms-abt.jpg" alt="" srcSet="" />
          <div className="team-desc">
            <div className="content-title animate__animated animate__zoomIn">
              <h4>The Team</h4>
            </div>
            <div className="team">
              <div className="left">
                <div className="roles">
                  <h4>Dr. Mark L. Sibag</h4>
                  <p>Director, RMS</p>
                </div>
                <div className="roles">
                  <h4>Dr. Leandro A. Dalhag</h4>
                  <p>Assistant Director, KTTM</p>
                </div>
              </div>
              <div className="right">
                <div className="roles">
                  <h4>Mr. Albert M. Arcega</h4>
                  <p>Assistant Director, RIA</p>
                </div>
                <div className="roles">
                  <h4>Ms. Ivy Fides R. Perez</h4>
                  <p>Faculty with Special Administrative Assignment</p>
                </div>
              </div>
            </div>
            <div className="third-col">
              <div className="content">
                <div className="content-title animate__animated animate__zoomIn">
                  <h4>Mission</h4>
                </div>
                <p>
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                  The point of using Lorem Ipsum is that it has a more-or-less
                  normal distribution of letters, as opposed to using 'Content
                  here, content here', making it look like readable English.
                  Many desktop publishing packages and web page editors now use
                  Lorem Ipsum as their default model text, and a search for
                  'lorem ipsum' will uncover many web sites still in their
                  infancy. Various versions have evolved over the years,
                  sometimes by accident, sometimes on purpose (injected humour
                  and the like).
                </p>
              </div>
              <div className="content">
                <div className="content-title animate__animated animate__zoomIn">
                  <h4>Vision</h4>
                </div>
                <p>
                  It is a long established fact that a reader will be distracted
                  by the readable content of a page when looking at its layout.
                  The point of using Lorem Ipsum is that it has a more-or-less
                  normal distribution of letters, as opposed to using 'Content
                  here, content here', making it look like readable English.
                  Many desktop publishing packages and web page editors now use
                  Lorem Ipsum as their default model text, and a search for
                  'lorem ipsum' will uncover many web sites still in their
                  infancy. Various versions have evolved over the years,
                  sometimes by accident, sometimes on purpose (injected humour
                  and the like).
                </p>
              </div>
            </div>
            {/* <div class="fourth-col">
                  <div class="content">
                      <div class="content-title animate__animated animate__zoomIn">
                           <h4>Contacts</h4>
                      </div>
                  </div>
              </div>
              <div class="fourth-col">
                  <div class="content">
                      <div class="content-title animate__animated animate__zoomIn">
                           <h4>Location</h4>
                      </div>
                  </div>
              </div> */}
          </div>
        </div>
      </div>
    </section>
  );
};

export default About;
