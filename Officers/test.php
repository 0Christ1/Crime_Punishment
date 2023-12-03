<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>NYUPD - Officers</title>
    <meta
      name="keywords"
      content="New York University  Department, NYUPD, Police, Campus Safty"
    />
    <meta name="description" content="New York University Police Department" />
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
    <div class="agency-header">
      <div class="upper-header-black">
        <div class="container">
          <span class="upper-header-left"
            ><a href="https://www.nyu.edu/" target="_blank"
              ><img
                src="../Assets/NYU-logo.png"
                alt="NYU"
                class="small-nyc-logo" /></a
            ><img
              src="https://www.nyc.gov/assets/home/images/global/upper-header-divider.gif"
              alt=""
            /><span class="upper-header-black-title"
              >New York University Police Department</span
            ></span
          ><span class="upper-header-padding"></span
          ><span class="upper-header-right"
            ><span class="upper-header-three-one-one"
              ><a
                href="https://www.nyu.edu/life/safety-health-wellness/campus-safety.html"
                target="_blank"
                >212.998.2222</a
              ></span
            ><img
              src="https://www.nyc.gov/assets/home/images/global/upper-header-divider.gif"
              alt=""
            /><span class="upper-header-search"
              ><a
                href="https://search.nyu.edu/s/search.html?query=&collection=nyu-all-meta-v02"
                target="_blank"
                >Search all NYU.edu websites</a
              ></span
            ></span
          >
        </div>
      </div>
    </div>
    <div role="banner" class="main-header">
      <div class="block">
        <div class="header-top">
          <div class="container">
            <a
              href="#"
              class="toggle-mobile-side-nav visible-phone"
              id="nav-open-btn"
              >Menu</a
            ><span class="welcome-text hidden-phone agency-header"
              >New York University's Finest</span
            >

            <div class="agency-logo-wrapper">
              <a href="#"
                ><img
                  class="agency-logo"
                  src="../Assets/NYUPD-Logo.png"
                  alt="NYUPD New York University Police Department"
              /></a>
            </div>
            <div class="hidden-phone" id="header-links">
              <a class="text-size hidden-phone" href="../Login/index.html"
                >Log Out</a
              >
            </div>
            <a
              href="#"
              class="visible-phone nav-sprite-mobile"
              id="toggle-mobile-search"
              ><span class="hidden">Search</span></a
            >
          </div>
        </div>
        <div class="container nav-outer">
          <nav role="navigation" class="hidden-phone" id="nav">
            <div class="block">
              <h2 class="block-title visible-phone">
                New York University's Finest
              </h2>
              <ul>
                <li class="nav-home hidden-phone">
                  <a href="#"> Home</a>
                </li>
                <li>
                  <a href="../Crime">Crime</a>
                </li>
                <li>
                  <a href="../Crime_Code/index.php"
                    >Crime Code</a
                  >
                </li>
                <li>
                  <a href="../Crime_Charge/">Crime Charges</a>
                </li>
                <li>
                  <a href="../Criminal/">Criminal</a>
                </li>
                <li>
                  <a href="../Officers/index.php">Officers</a>
                </li>
                <li>
                  <a href="../Sentencing/">Sentencing</a>
                </li>
                <li>
                  <a href="../Appeal/">Appeal</a>
                </li>
                <li>
                  <a href="https://github.com/0Christ1/NYUPD">Repo</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <div class="content-img">
      <div class="container">
        <div class="container my-5">
          <h2>Officers</h2>
          <div class="position">
            <a class="btn btn-primary" href="./Officer_add.php" role="button">New Officer</a>
            <a class="btn btn-primary" href="./officer_sort.php" role="button">Sort by Officer ID by Ascending</a>
          </div>
          <br>
          <table class="table">
              <thead>
                  <tr>
                      <th>Officer ID</th>
                      <th>Last</th>
                      <th>First</th>
                      <th>Precinct</th>
                      <th>Badge Number</th>
                      <th>Phone Number</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  $servname = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "Project3";
                  
                  // Database connection
                  $conn = mysqli_connect($servname, $username, $password, $dbname);
                  if(!$conn){
                      die("Connection failed: " . mysqli_connect_error());
                  }
                  
                  $sql = "SELECT * FROM Officers";
                  $result = $conn->query($sql);
                  
                  if (!$result) {
                      die("Invalid query: " . $conn->error);
                  }
                  
                  while($row = $result->fetch_assoc()){
                      echo "<tr>
                              <td>{$row['Officer_ID']}</td>
                              <td>{$row['Last']}</td>
                              <td>{$row['First']}</td>
                              <td>{$row['Precinct']}</td>
                              <td>{$row['Badge_Number']}</td>
                              <td>{$row['Phone']}</td>
                              <td>{$row['Status']}</td>
                              <td>
                                  <a class='btn btn-primary btn-sm' href='./Officer_update.php?id=" . $row['Officer_ID'] . "'>Edit</a>
                                  <a class='btn btn-danger btn-sm' href='./Officer_delete.php?id=" . $row['Officer_ID'] . "'>Delete</a>
                              </td>
                            </tr>";
                  }
                  $conn->close();
                  ?>
              </tbody>
          </table>    
        </div>
      </div>
    </div>

    <div class="n_footer">(C) 2023 Golden EightPM Corp. v1.0.0</div>
  </body>
</html>
