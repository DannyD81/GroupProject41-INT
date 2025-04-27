<?php
session_start();

$success = "";
$error = "";
$user = null;

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== 'User') {
    header('Location: login-page.php?error=unauthorised');
    exit();
}

if (!isset($_SESSION['UserID'])) {
    die("User ID not found in session.");
}

$userID = intval($_SESSION['UserID']);
$db = new SQLite3("MortgageSystem.db");

$stmt = $db->prepare("SELECT * FROM user WHERE USERID = :id");
$stmt->bindValue(":id", $userID, SQLITE3_INTEGER);
$result = $stmt->execute();
$user = $result->fetchArray(SQLITE3_ASSOC);

if (!$user) {
    die("User not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["firstName"]);
    $lastName = trim($_POST["lastName"]);
    $dob = trim($_POST["dateOfBirth"]);
    $employment = $_POST["employmentStatus"];
    $income = $_POST["annualIncome"];
    $outgoings = $_POST["monthlyOutgoings"];
    $credit = $_POST["creditScore"];

    if ($firstName && $lastName && $dob && $employment && $income !== "" && $outgoings !== "" && $credit !== "") {
        $updateStmt = $db->prepare("
            UPDATE user 
            SET firstName = :firstName, lastName = :lastName, dob = :dob, employmentStatus = :employment, 
                annualIncome = :income, monthlyOutgoings = :outgoings, creditScore = :credit 
            WHERE USERID = :id
        ");
        $updateStmt->bindValue(":firstName", $firstName, SQLITE3_TEXT);
        $updateStmt->bindValue(":lastName", $lastName, SQLITE3_TEXT);
        $updateStmt->bindValue(":dob", $dob, SQLITE3_TEXT);
        $updateStmt->bindValue(":employment", $employment, SQLITE3_TEXT);
        $updateStmt->bindValue(":income", $income, SQLITE3_INTEGER);
        $updateStmt->bindValue(":outgoings", $outgoings, SQLITE3_INTEGER);
        $updateStmt->bindValue(":credit", $credit, SQLITE3_INTEGER);
        $updateStmt->bindValue(":id", $userID, SQLITE3_INTEGER);

        if ($updateStmt->execute()) {
            $success = "Details updated successfully!";
            $user["firstName"] = $firstName;
            $user["lastName"] = $lastName;
            $user["dob"] = $dob;
            $user["employmentStatus"] = $employment;
            $user["annualIncome"] = $income;
            $user["monthlyOutgoings"] = $outgoings;
            $user["creditScore"] = $credit;
        } else {
            $error = "Failed to update details.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous" defer></script>
</head>
<body>
<div class="home">
    <?php include("navbar.php"); ?>

    <main class="form-updatedetails w-50 m-auto my-5">
        <form method="POST" action="update-details.php">
            <h1 class="h3 mb-4 fw-normal text-center">Update Details</h1>

            <?php if (!empty($success)) : ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required value="<?= htmlspecialchars($user['firstName']) ?>">
                <label for="firstName">First Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required value="<?= htmlspecialchars($user['lastName']) ?>">
                <label for="lastName">Last Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="dateOfBirth" name="dateOfBirth" placeholder="DD/MM/YYYY" required value="<?= htmlspecialchars($user['dob']) ?>">
                <label for="dateOfBirth">Date of Birth</label>
            </div>

            <div class="mb-3">
                <label for="employmentStatus" class="form-label">Employment Status</label>
                <select class="form-select" id="employmentStatus" name="employmentStatus" required>
                    <option disabled <?= empty($user['employmentStatus']) ? 'selected' : '' ?>>Choose...</option>
                    <option value="Employed" <?= $user['employmentStatus'] == 'Employed' ? 'selected' : '' ?>>Employed</option>
                    <option value="Unemployed" <?= $user['employmentStatus'] == 'Unemployed' ? 'selected' : '' ?>>Unemployed</option>
                    <option value="Self-Employed" <?= $user['employmentStatus'] == 'Self-Employed' ? 'selected' : '' ?>>Self-Employed</option>
                    <option value="Retired" <?= $user['employmentStatus'] == 'Retired' ? 'selected' : '' ?>>Retired</option>
                </select>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="annualIncome" name="annualIncome" placeholder="Annual Income" required value="<?= htmlspecialchars($user['annualIncome']) ?>">
                <label for="annualIncome">Annual Income</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="monthlyOutgoings" name="monthlyOutgoings" placeholder="Monthly Outgoings" required value="<?= htmlspecialchars($user['monthlyOutgoings']) ?>">
                <label for="monthlyOutgoings">Monthly Outgoings</label>
            </div>

            <div class="form-floating mb-4">
                <input type="number" class="form-control" id="creditScore" name="creditScore" placeholder="Credit Score" required value="<?= htmlspecialchars($user['creditScore']) ?>">
                <label for="creditScore">Credit Score</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Save</button>
        </form>

        <a href="logged-in-home.php" class="btn btn-outline-secondary w-100 py-2">Back</a>
    </main>

    <?php include("footer.php"); ?>
</div>
</body>
</html>
