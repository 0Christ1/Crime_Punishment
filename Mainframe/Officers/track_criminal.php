<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Track Criminal</title>   
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta
      name="keywords"
      content="New York Urban  Department, NYUPD, Police, Campus Safty"
    />
    <meta name="description" content="New York Urban Police Department" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />

    <link
      href="../../Styles/global.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />

    <link
      href="../../Styles/header-agencies.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />

    <link
      href="../../Styles/homepage-hero.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="../../Styles/index.css"
      media="screen"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="../../Styles/agency-styles.css"
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
                src="../../Assets/NYU.png"
                alt="NYU"
                class="small-nyc-logo" /></a
            ><img
              src="https://www.nyc.gov/assets/home/images/global/upper-header-divider.gif"
              alt=""
            /><span class="upper-header-black-title"
              >New York Urban Police Department</span
            ></span
          ><span class="upper-header-padding"></span
          ><span class="upper-header-right"
            ><span class="upper-header-three-one-one"
              ><a
                href="https://www.nyu.edu/life/safety-health-wellness/campus-safety.html"
                target="_blank"
                >911</a
              ></span
            ><img
              src="https://www.nyc.gov/assets/home/images/global/upper-header-divider.gif"
              alt=""
            /><span class="upper-header-search"
              ><a
                href="https://search.nyu.edu/s/search.html?query=&collection=nyu-all-meta-v02"
                target="_blank"
                >Visit NYUPD.gov websites</a
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
              >New York Urban's Finest</span
            >

            <div class="agency-logo-wrapper">
              <a href="#"
                ><img
                  class="agency-logo"
                  src="../../Assets/NYUPD-Logo.png"
                  alt="NYUPD New York Urban Police Department"
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
                New York Urban's Finest
              </h2>
              <ul>
                <li class="nav-home hidden-phone">
                  <a href="../Mainframe"> Home</a>
                </li>
                <li>
                  <a href="redirect.php">Crime</a>
                </li>
                <li>
                  <a href="redirect.php">Crime Code</a>
                </li>
                <li>
                  <a href="redirect.php">Crime Charges</a>
                </li>
                <li>
                  <a href="redirect.php">Criminal</a>
                </li>
                <li>
                  <a href="redirect.php">Officers</a>
                </li>
                <li>
                  <a href="redirect.php">Sentencing</a>
                </li>
                <li>
                  <a href="redirect.php">Appeal</a>
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
        <div class="container my-5" style="top:55%">
            <h1>Enter Officer ID to Track Criminals</h1>
            <form id="myForm" action="track_criminal.php" method="post">
                <input type="number" id="officer" placeholder="Officer ID" name="officer_id" value="<?php echo htmlspecialchars($id); ?>" required oninvalid="setCustomValidity('Officer ID is required.')" oninput="setCustomValidity('')">
                <input type="submit" value="Submit">
                <input type="button" value="Cancel" onclick="location.href='index.php';">
            </form>
            <!-- <table class="table">
              <thead>
                  <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                  </tr>
              </thead>
            </table> -->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              
                $officer_id = isset($_POST['officer_id']) ? (int)$_POST['officer_id'] : 0;

                $servname = "localhost";
                $username = "root";
                $password = "";
                $dbname = "Project3";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "CALL track_crinimal(?)";

                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    die("Error preparing statement: " . $conn->error);
                }

                $stmt->bind_param("i", $officer_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "
        <tr>
            <td><span style='font-size: larger;'>{$row['First']}</span></td>
            <td><span style='font-size: larger;'>{$row['Last']}</span></td>
        </tr>
        ";
                    }
                } else {
                    echo "0 results";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
          </div>
        </div>
      </div>
    </div>


    <div class="n_footer">(C) 2023 Golden EightPM Corp. v1.0.0</div>
    <script>
      document.getElementById('myForm').addEventListener('submit', function(event) {
        var input = document.getElementById('officer');
        if (!input.value) {
            input.setCustomValidity('Officer ID is required.');
        } else {
            input.setCustomValidity(''); 
        }
        });
    </script>
    
  </body>
</html>

