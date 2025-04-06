<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = trim($_POST["productName"]);
    $productType = trim($_POST["productType"]);
    $affordabilityRange = $_POST["affordabilityRange"];
    $interestRate = $_POST["interestRate"];

    if ($productName && $productType && $affordabilityRange && $interestRate !== "") {
        try {
            $db = new SQLite3('MortgageSystem.db');

            $stmt = $db->prepare("INSERT INTO Products (Name, productType, affordabilityRange, interestRate) VALUES (:name, :type, :range, :rate)");
            $stmt->bindValue(':name', $productName, SQLITE3_TEXT);
            $stmt->bindValue(':type', $productType, SQLITE3_TEXT);
            $stmt->bindValue(':range', $affordabilityRange, SQLITE3_INTEGER);
            $stmt->bindValue(':rate', $interestRate, SQLITE3_FLOAT);

            $result = $stmt->execute();

            if ($result) {
                $success = "Product created successfully!";
            } else {
                $error = "Couldn't create product.";
            }

            $stmt->close();
            $db->close();
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Products</title>

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
            <form method="POST" action="">
                <h1 class="h3 mb-4 fw-normal">Create Product</h1>

                <?php if ($success): ?>
                    <div class="alert alert-success"><?= $success ?></div>
                <?php elseif ($error): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <label for="productName" class="form-label mb-0">Product Name:</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name" required>
                    <label for="productName">Product Name</label>
                </div>

                <label for="productType" class="form-label mb-0">Product Type:</label>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="productType" name="productType" placeholder="Product Type" required>
                    <label for="productType">Product Type</label>
                </div>

                <label for="affordabilityRange" class="form-label">Affordability Range:</label>
                <select class="form-select mb-3" id="affordabilityRange" name="affordabilityRange" required>
                    <option selected disabled>Choose...</option>
                    <option value="1">30,000 - 80,000</option>
                    <option value="2">80,000 - 130,000</option>
                    <option value="3">130,000 - 260,000</option>
                    <option value="4">260,000 - 500,000</option>
                </select>

                <label for="interestRate" class="form-label mb-0">Interest Rate (%):</label>
                <div class="form-floating mb-3">
                    <input type="number" step="0.01" class="form-control" id="interestRate" name="interestRate" placeholder="Interest Rate" required>
                    <label for="interestRate">Interest Rate (%)</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Create Product</button>
            </form>

            <a href="broker-homepage.php" class="btn btn-outline-secondary w-100 py-2">Back</a>
        </main>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
