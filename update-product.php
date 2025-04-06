<?php
$success = "";
$error = "";
$product = null;

if (!isset($_GET["id"])) {
    die("❌ Product ID not provided.");
}

$productID = intval($_GET["id"]);
$db = new SQLite3("MortgageSystem.db");

$stmt = $db->prepare("SELECT * FROM Products WHERE ProductsID = :id");
$stmt->bindValue(":id", $productID, SQLITE3_INTEGER);
$result = $stmt->execute();
$product = $result->fetchArray(SQLITE3_ASSOC);

if (!$product) {
    die("Product not found.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete"])) {
        $deleteStmt = $db->prepare("DELETE FROM Products WHERE ProductsID = :id");
        $deleteStmt->bindValue(":id", $productID, SQLITE3_INTEGER);

        if ($deleteStmt->execute()) {
            $db->close();
            header("Location: view-products.php?deleted=1");
            exit();
        } else {
            $error = "Failed to delete product.";
        }
    } else {
        $name = trim($_POST["productName"]);
        $type = trim($_POST["productType"]);
        $range = $_POST["affordabilityRange"];
        $rate = $_POST["interestRate"];

        if ($name && $type && $range && $rate !== "") {
            $updateStmt = $db->prepare("UPDATE Products SET Name = :name, productType = :type, affordabilityRange = :range, interestRate = :rate WHERE ProductsID = :id");
            $updateStmt->bindValue(":name", $name, SQLITE3_TEXT);
            $updateStmt->bindValue(":type", $type, SQLITE3_TEXT);
            $updateStmt->bindValue(":range", $range, SQLITE3_INTEGER);
            $updateStmt->bindValue(":rate", $rate, SQLITE3_FLOAT);
            $updateStmt->bindValue(":id", $productID, SQLITE3_INTEGER);

            if ($updateStmt->execute()) {
                $success = "Product updated!";
                $product["Name"] = $name;
                $product["productType"] = $type;
                $product["affordabilityRange"] = $range;
                $product["interestRate"] = $rate;
            } else {
                $error = "Couldn't update product.";
            }
        } else {
            $error = "Please fill in all fields.";
        }
    }
}
$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="home">
    <?php include("navbar.php"); ?>

    <main class="form-updatedetails w-50 m-auto my-5">
        <form method="POST">
            <h1 class="h3 mb-3 fw-normal text-center">Update Product</h1>
            <h2 class="h5 mb-4 text-center">Product Name: <?= htmlspecialchars($product["Name"]) ?></h2>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php elseif ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="productName" name="productName"
                       value="<?= htmlspecialchars($product["Name"]) ?>" required>
                <label for="productName">Product Name</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="productType" name="productType"
                       value="<?= htmlspecialchars($product["productType"]) ?>" required>
                <label for="productType">Product Type</label>
            </div>

            <div class="mb-3">
                <label for="affordabilityRange" class="form-label">Affordability Range</label>
                <select class="form-select" id="affordabilityRange" name="affordabilityRange" required>
                    <?php
                    $ranges = [
                        "1" => "30,000–80,000",
                        "2" => "80,000–130,000",
                        "3" => "130,000–260,000",
                        "4" => "260,000–500,000"
                    ];
                    foreach ($ranges as $key => $label) {
                        $selected = ($product["affordabilityRange"] == $key) ? "selected" : "";
                        echo "<option value=\"$key\" $selected>$label</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-floating mb-4">
                <input type="number" step="0.01" class="form-control" id="interestRate" name="interestRate"
                       value="<?= htmlspecialchars($product["interestRate"]) ?>" required>
                <label for="interestRate">Interest Rate</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-3" type="submit" name="update">Update Product</button>
        </form>

        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
            <input type="hidden" name="delete" value="1">
            <button class="btn btn-danger w-100 py-2 mb-3" type="submit">Delete Product</button>
        </form>
        <a href="broker-products.php" class="btn btn-outline-secondary w-100 py-2">Back</a>
    </main>

    <?php include("footer.php"); ?>
</div>
</body>
</html>
