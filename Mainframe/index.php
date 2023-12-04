<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>(NYUPD)New York Urban Police Department</title>
    <meta
      name="keywords"
      content="New York Urban Department, NYUPD, Police, Urban Safty"
    />
    <meta name="description" content="New York Urban Police Department" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <link
      href="../Styles/global.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />

    <link
      href="../Styles/header-agencies.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />

    <link
      href="../Styles/homepage-hero.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="../Styles/index.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="../Styles/agency-styles.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />
  </head>
  <body id="agencies-index">
    <?php
      session_start();
      if (!isset($_SESSION['user_role']) || time() - $_SESSION['login_time'] >300) { 
        echo '<script language="javascript">alert("Please Login to visit!");
        location.href = "../Login/index.html";</script>'; exit; 
      } 
    ?>
    <div class="agency-header">
      <div class="upper-header-black">
        <div class="container">
          <span class="upper-header-left"
            ><img src="../Assets/NYU.png" alt="NYU" class="small-nyc-logo" />
            <img
              src="https://www.nyc.gov/assets/home/images/global/upper-header-divider.gif"
              alt=""
            /><span class="upper-header-black-title"
              >New York Urban Police Department</span
            ></span
          ><span class="upper-header-padding"></span
          ><span class="upper-header-right"
            ><span class="upper-header-three-one-one">911</span
            ><img
              src="https://www.nyc.gov/assets/home/images/global/upper-header-divider.gif"
              alt=""
            /><span class="upper-header-search"
              >Visit NYUPD.gov websites</span
            ></span
          >
        </div>
      </div>
    </div>
    <div role="banner" class="main-header">
      <div class="header-top">
        <div class="container">
          <a
            href=""
            class="toggle-mobile-side-nav visible-phone"
            id="nav-open-btn"
            >Menu</a
          ><span class="welcome-text hidden-phone agency-header"
            >New York Urban's Finest</span
          >

          <div class="agency-logo-wrapper">
            <a href="#"
              ><img
                class="agency-logo"
                src="../Assets/NYUPD-Logo.png"
                alt="NYUPD New York Urban Police Department"
            /></a>
          </div>
          <div class="hidden-phone" id="header-links">
            <a class="text-size" href="../Security/logout.php">Log Out</a>
          </div>
        </div>
      </div>
      <div class="container">
        <nav id="nav">
          <ul>
            <li class="nav-home">
              <a href=""> Home</a>
            </li>
            <li><a href="../Security/redirect.php?page=Crime">Crime</a></li>
            <li>
              <a href="../Security/redirect.php?page=CrimeCode">Crime Code</a>
            </li>
            <li>
              <a href="../Security/redirect.php?page=CrimeCharges"
                >Crime Charges</a
              >
            </li>
            <li>
              <a href="../Security/redirect.php?page=Criminal">Criminal</a>
            </li>
            <li>
              <a href="../Security/redirect.php?page=Officers">Officers</a>
            </li>
            <li>
              <a href="../Security/redirect.php?page=Sentencing">Sentencing</a>
            </li>
            <li><a href="../Security/redirect.php?page=Appeal">Appeal</a></li>
            <li>
              <a href="https://github.com/0Christ1/NYUPD">Repo</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  
    <div class="content-img">
      <div class="content shadow">
        <div class="row">
          <div class="container my-5">
              <h2> About NYUPD </h2>
              <div class="context">
                <img title="About NYUPD" src="../Assets/Main-BG.png" alt="About NYUPD" />
                <span>
                  <p>The New York Urban Police Department (NYUPD), situated at 150 Justice Avenue, Manhattan, New York, 10001, is a prominent law enforcement entity dedicated to maintaining peace and order in the bustling city.</p>
                  <p> Led by Chief Supervisor Jane Doe, a seasoned professional known for her dedication to community safety, NYUPD operates with a team of highly trained officers and staff. </p>
                  <p>NYUPD prides itself on its strong community relations, advanced crime prevention strategies, and swift response to emergencies, solidifying its role as a pillar of safety and trust within the New York urban landscape.</p>
                  <p>The department can be reached for non-emergency inquiries at (212) 555-6789, or through email at contact@nyupd.gov. For documentation and official communication, their FAX number is (212) 555-9876.</p>
                </span>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="n_footer">(C) 2023 Golden EightPM Corp. v1.0.0</div>
  </body>
</html>
