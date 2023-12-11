<?php
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

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!isset($_GET["id"])) {
        header("location: ./index.php");
        exit;
    }
    $id = $_GET["id"];

    // Using prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM Sentences WHERE Sentence_ID = ?");
    $stmt->bind_param("i", $id); // Change "i" to "s" if Officer_ID is a string
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }

    $id = $row["Sentence_ID"];
    $Criminal_ID = $row["Criminal_ID"];
    $Prob_ID = $row["Prob_ID"];
    $Type = $row["Type"];
    $Start_date = $row["Start_date"];
    $End_date = $row["End_date"];
    $Violations = $row["Violations"];

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $Criminal_ID = $_POST["Criminal_ID"];
    $Prob_ID = $_POST["Prob_ID"];
    $Type = $_POST["Type"];
    $Start_date = $_POST["Start_date"];
    $End_date = $_POST["End_date"];
    $Violations = $_POST["Violations"];

    if (empty($id)) {
        $errorMessage = "Sentence ID is required";
    } else {
        $sql = "UPDATE Sentences SET Criminal_ID = ?, Prob_ID = ?, Type = ?, Start_date = ?, End_date = ?, Violations = ? WHERE Sentence_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddsssdd",$Criminal_ID, $Prob_ID, $Type, $Start_date, $End_date, $Violations, $id);
        if ($stmt->execute()) {
            $successMesssage = "Sentence updated successfully";
        } else {
            $errorMessage = "Error updating record: " . $conn->error;
        }
        $stmt->close();

        header("location: ./index.php");
        exit;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Sentencing</title>
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
          <h2>Update Sentences</h2>
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

          <form method="post">
              <input type="hidden" name="id" value='<?php echo htmlspecialchars($id); ?>'>
              <div class="row mb-3">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder = "Can't Edit Sentence ID" disabled>
                      <input type="hidden" class="form-control" name = "Sentence_ID" value="<?php echo htmlspecialchars($id); ?>">
                  </div>
              </div>
              
              <div class="row mb-3">
                <div class="col-sm-6">
                  <input type="text" class="form-control" placeholder = "Can't Edit Criminal_ID" disabled>
                  <input type="hidden" class="form-control" name = "Criminal_ID" value="<?php echo htmlspecialchars($Criminal_ID); ?>">
                </div>
              </div>

              <div class="row mb-3">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder = "Can't Edit Prob_ID" disabled>
                      <input type="hidden" class="form-control" name = "Prob_ID" value="<?php echo htmlspecialchars($Prob_ID); ?>">
              </div>

              <div class="row mb-3">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder = "Type"  name="Type" value="<?php echo htmlspecialchars($Type); ?>">
                  </div>
              </div>

              <div class="row mb-3">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder = "Start_date" name="Start_date" value="<?php echo htmlspecialchars($Start_date); ?>">
                  </div>
              </div>

              <div class="row mb-3">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder = "End_date" name="End_date" value="<?php echo htmlspecialchars($End_date); ?>">
                  </div>
              </div>

              <div class="row mb-3">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder = "Violations" name="Violations" value="<?php echo htmlspecialchars($Violations); ?>">
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
