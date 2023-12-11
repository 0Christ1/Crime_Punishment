<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$id = $last = $first = $street = $city = $state = $zip = $phone = $v_status = $p_status =  "";
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
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $phone = $_POST["phone"];
    $v_status = $_POST["v_status"];
    $p_status = $_POST["p_status"];


    if (empty($id)) {
        $errorMessage = "Criminal ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Criminal (Criminal_ID, Last, First, Street, City, State, Zip, Phone, V_status, P_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("dsssssssss", $id, $last, $first, $street, $city, $state, $zip, $phone, $v_status, $p_status);

        if ($stmt->execute()) {
            $successMesssage = "$first is registered successfully!";
            header("location: ./index.php");
            exit;
        } else {
            echo '<script language="javascript">alert("Error: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
    }
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Criminal</title>
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
                <h2>New Criminal</h2>
                <form method="post">
                    <input type="hidden" name="id" value='<?php echo htmlspecialchars($id); ?>'>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "Criminal ID"  name="id" value="<?php echo htmlspecialchars($id); ?>">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "Last Name" name="last" value="<?php echo htmlspecialchars($last); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "First Name" name="first" value="<?php echo htmlspecialchars($first); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "Street" name="street" value="<?php echo htmlspecialchars($street); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "City" name="city" value="<?php echo htmlspecialchars($city); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "State" name="state" value="<?php echo htmlspecialchars($state); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "Zip" name="zip" value="<?php echo htmlspecialchars($zip); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "Phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "V_status" name="v_status" value="<?php echo htmlspecialchars($v_status); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" placeholder = "P_statu" name="p_status" value="<?php echo htmlspecialchars($p_status); ?>">
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
        var input = document.getElementById('appeal');
        if (!input.value) {
            input.setCustomValidity('Appeal ID is required.');
        } else {
            input.setCustomValidity(''); 
        }
    });
    </script>
</body>
</html>
