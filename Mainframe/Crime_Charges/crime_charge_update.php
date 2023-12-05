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
    $stmt = $conn->prepare("SELECT * FROM Crime_charges WHERE Charge_ID = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }

    $id = $row["Charge_ID"];
    $Crime_ID = $row["Crime_ID"];
    $Crime_Code = $row["Crime_Code"];
    $Charge_status = $row["Charge_status"];
    $Fine_amount = $row["Fine_amount"];
    $Court_fee = $row["Court_fee"];
    $Amount_paid = $row["Amount_paid"];
    $Pay_due_date = $row["Pay_due_date"];

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $Crime_ID = $_POST["Crime_ID"];
    $Crime_Code = $_POST["Crime_Code"];
    $Charge_status = $_POST["Charge_status"];
    $Fine_amount = $_POST["Fine_amount"];
    $Court_fee = $_POST["Court_fee"];
    $Amount_paid = $_POST["Amount_paid"];
    $Pay_due_date = $_POST["Pay_due_date"];

    if (empty($id)) {
        $errorMessage = "Charge ID is required";
    } else {
        $sql = "UPDATE Crime_charges SET Crime_ID = ?, Crime_Code = ?, Charge_status = ?, Fine_amount = ?, Court_fee = ?, Amount_paid = ?, Pay_due_date = ? WHERE Charge_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddsdddsd", $Crime_ID, $Crime_Code, $Charge_status, $Fine_amount, $Court_fee, $Amount_paid, $Pay_due_date, $id);
        if ($stmt->execute()) {
            $successMesssage = "Crime charges updated successfully";
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
      <title>Update Crime Charge</title>
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
          <h2>Edit Crime Charge</h2>
          <?php if (!empty($successMesssage)): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><?php echo htmlspecialchars($successMesssage); ?></strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          <?php endif; ?>
          <form method="post">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" id="crime charge" class="form-control" placeholder = "Charge ID" name="id" value="<?php echo htmlspecialchars($id); ?>"required oninvalid="setCustomValidity('Charge ID is required.')" oninput="setCustomValidity('')">
                </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-sm-6">
                <input type="text" class="form-control" placeholder = "Crime_ID" name="Crime_ID" value="<?php echo htmlspecialchars($Crime_ID); ?>">
              </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Crime_Code" name="Crime_Code" value="<?php echo htmlspecialchars($Crime_Code); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Charge_status" name="Charge_status" value="<?php echo htmlspecialchars($Charge_status); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Fine_amount"  name="Fine_amount" value="<?php echo htmlspecialchars($Fine_amount); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Court_fee" name="Court_fee" value="<?php echo htmlspecialchars($Court_fee); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Amount_paid" name="Amount_paid" value="<?php echo htmlspecialchars($Amount_paid); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Pay_due_date" name="Pay_due_date" value="<?php echo htmlspecialchars($Pay_due_date); ?>">
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
          var input = document.getElementById('crime charge');
          if (!input.value) {
              input.setCustomValidity('Charge ID is required.');
          } else {
              input.setCustomValidity(''); 
          }
      });
    </script>
  </body>
</html>
