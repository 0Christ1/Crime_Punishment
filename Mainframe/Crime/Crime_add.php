<?php
$id = $Classification = $Date_charged = $Status = $Hearing_date = $Appeal_cut_date = "";
$errorMessage = $successMesssage = "";

//Database credentials 
$servname = "localhost";
$username = "root";
$password = "";
$dbname = "Project3";

//Database connection
$conn = mysqli_connect($servname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Check for form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $Classification = $_POST["Classification"];
    $Date_charged = $_POST["Date_charged"];
    $Status = $_POST["Status"];
    $Hearing_date = $_POST["Hearing_date"];
    $Appeal_cut_date = $_POST["Appeal_cut_date"];

    if (empty($id)) {
        $errorMessage = "Crime ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Crime (Crime_ID, Classification, Date_charged, Status, Hearing_date, Appeal_cut_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $id, $Classification, $Date_charged, $Status, $Hearing_date, $Appeal_cut_date);

        if ($stmt->execute()) {
            $successMesssage = "$id is registered successfully!";
            header("location: ./index.php");
            exit;
        } else {
            // $errorMessage = "Error: " . $stmt->error;
            echo '<script language="javascript">alert("Invalid input");</script>';
        }

        $stmt->close();
    }
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Crime</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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
          <span class="welcome-text hidden-phone agency-header"
            >New York Urban's Finest</span
          >
          <div class="agency-logo-wrapper">
            <a href="../Mainframe/index.php"
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
    <div class="content shadow">
        <div class="container my-5">
        <h2>New Crime</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo htmlspecialchars($errorMessage); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($successMesssage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo htmlspecialchars($successMesssage); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form id="myForm" method="post">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" id = 'crime' class="form-control" placeholder = "Crime ID" name="id" value="<?php echo htmlspecialchars($id); ?>"required oninvalid="setCustomValidity('Crime ID is required.')" oninput="setCustomValidity('')">
                </div>
            </div>
        
            <div class="row mb-3">
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder = "Classification" name="Classification" value="<?php echo htmlspecialchars($Classification); ?>">
        </div>
    </div> 

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Date charged" name="Date charged" value="<?php echo htmlspecialchars($Date_charged); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Status" name="Status" value="<?php echo htmlspecialchars($Status); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Hearing date"  name="Hearing_date" value="<?php echo htmlspecialchars($Hearing_date); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Appeal cut date" name="Appeal_cut_date" value="<?php echo htmlspecialchars($Appeal_cut_date); ?>">
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
  <script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        var input = document.getElementById('crime');
        if (!input.value) {
            input.setCustomValidity('Crime ID is required.');
        } else {
            input.setCustomValidity(''); 
        }
    });
  </script>
</div>
</body>
</html>

