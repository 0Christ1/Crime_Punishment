<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$id = $last = $first = $precinct = $badge = $phone = $status = "";
$errorMessage = $successMesssage = "";

// Database credentials
$servname = "localhost";
$username = "root";
$password = "";
$dbname = "Project3";
            
// Database connection
$conn = mysqli_connect($servname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $last = $_POST["last"];
    $first = $_POST["first"];
    $precinct = $_POST["precinct"];
    $badge = $_POST["badge"];
    $phone = $_POST["phone"];
    $status = $_POST["status"];

    if (empty($id)) {
        $errorMessage = "Officer ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Officers (Officer_ID, Last, First, Precinct, Badge_Number, Phone, Status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("dssssss", $id, $last, $first, $precinct, $badge, $phone, $status);

        if ($stmt->execute()) {
            $successMesssage = "$first is registered successfully!";
            header("location: ./index.php");
            exit;
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Officer</title>
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
  <body d="agencies-index">
    <div class="agency-header">
      <div class="upper-header-black">
          <div class="container">
            <span class="upper-header-left"
              ><img src="../../Assets/NYU.png" alt="NYU" class="small-nyc-logo" />
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
    </div>
    <div role="banner" class="main-header">
        <div class="header-top">
          <div class="container">
            <a
              href="../index.php"
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
              <a class="text-size" href="../../Security/logout.php">Log Out</a>
            </div>
          </div>
        </div>
        <div class="container">
          <nav id="nav">
            <ul>
              <li class="nav-home">
                <a href="../index.php"> Home</a>
              </li>
              <li><a href="../../Security/redirect.php?page=Crime">Crime</a></li>
              <li>
                <a href="../../Security/redirect.php?page=CrimeCode">Crime Code</a>
              </li>
              <li>
                <a href="../../Security/redirect.php?page=CrimeCharges"
                  >Crime Charges</a
                >
              </li>
              <li>
                <a href="../../Security/redirect.php?page=Criminal">Criminal</a>
              </li>
              <li>
                <a href="../../Security/redirect.php?page=Officers">Officers</a>
              </li>
              <li>
                <a href="../../Security/redirect.php?page=Sentencing">Sentencing</a>
              </li>
              <li><a href="../../Security/redirect.php?page=Appeal">Appeal</a></li>
              <li>
                <a href="https://github.com/0Christ1/NYUPD">Repo</a>
              </li>
            </ul>
          </nav>
        </div>
    </div>
    <div class="content-img">
      <div class="container">
        <div class="container my-5" style="top:55%">
            <h2>New Officer</h2>
            <?php if (!empty($successMesssage)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo htmlspecialchars($successMesssage); ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input type="text" placeholder="Officer ID" class="form-control" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input type="text" placeholder="Last Name" class="form-control"  name="last" value="<?php echo htmlspecialchars($last); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input type="text"  placeholder="First Name" class="form-control" name="first" value="<?php echo htmlspecialchars($first); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input type="text" placeholder="Precinct" class="form-control" name="precinct" value="<?php echo htmlspecialchars($precinct); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input type="text" placeholder="Badge Number" class="form-control" name="badge" value="<?php echo htmlspecialchars($badge); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input type="text" placeholder="Phone" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input type="text" placeholder="Status" class="form-control" name="status" value="<?php echo htmlspecialchars($status); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-3 d-grid">
                        <a class="btn btn-outline-primary" href="./index.php" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
    <div class="n_footer">(C) 2023 Golden EightPM Corp. v1.0.0</div>
  </body>
</html>
