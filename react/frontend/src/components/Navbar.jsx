import React from "react";

const Navbar = () => {
  return (
    <section id="sidebar">
      <div className="logo">
        <div className="logo-wrapper">
          <img src="../../../assets/images/batStateUNeu-logo.png" alt="" />
        </div>
        <h4 className="logo-title">Research Management Services</h4>
      </div>
      <div className="loading-overlay" id="loadingOverlay">
        <div className="loading-spinner" />
      </div>
      <ul className="side-menu">
        <li>
          <a
            href="../../../views/admin/dashboard/dashboard.php"
            id="dashboard-link"
            // onClick="showLoadingScreen()"
          >
            <i className="bx bxs-dashboard icon" />
            Dashboard
          </a>
        </li>
        <li className="divider" data-text="Main">
          Main
        </li>
        <li>
          <a
            href="../../../views/admin/publications/publications.php"
            id="publication-link"
            // onClick="showLoadingScreen()"
          >
            <i className="bx bxs-book-open icon" />
            Publications
          </a>
        </li>
        <li>
          <a
            href="../../../views/admin/ip-assets/ip-assets.php"
            id="ip-assets-link"
            // onClick="showLoadingScreen()"
          >
            <i className="bx bxs-folder icon" />
            IP Assets
          </a>
        </li>
        <li>
          <a
            href="../../../views/admin/authors/authors.php"
            id="author-link"
            // onClick="showLoadingScreen()"
          >
            <i className="bx bxs-group icon" />
            Authors
          </a>
        </li>
        <li>
          <a
            href="../../../views/admin/user-accounts/user-accounts.php"
            id="user-accounts-link"
            // onClick="showLoadingScreen()"
          >
            <i className="bx bxs-user icon" />
            User Accounts
          </a>
        </li>
        <li className="divider" data-text="Account">
          Account
        </li>
        <li>
          <a
            href="../../../views/admin/logs/logs.php"
            id="log-link"
            // onClick="showLoadingScreen()"
          >
            <i className="bx bxs-log-in icon" />
            Logs
          </a>
        </li>
        <li id="account-settings">
          <a href="#" id="account-link">
            <i className="bx bxs-cog icon" />
            Account Settings
            <i className="bx bx-chevron-right icon-right" />
          </a>
          <ul className="side-dropdown">
            <li>
              <a
                href="../../../views/admin/account-management/user-profile.php"
                id="user-link"
                // onClick="showLoadingScreen()"
              >
                Profile
              </a>
            </li>
            <li>
              <a
                href="../../../views/admin/account-management/change-password.php"
                id="security-link"
                // onClick="showLoadingScreen()"
              >
                Change Password
              </a>
            </li>
          </ul>
          {/* <a className="logout" onClick="return showLogoutAlert()"> */}
            <i className="bx bx-log-out icon rotate" name="logout" />
            Sign Out
          {/* </a> */}
        </li>
      </ul>
    </section>
  );
};

export default Navbar;
