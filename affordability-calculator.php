<?php
$annual_income = 0;
$annual_expenditure = 0;
$max_mortgage = 0;
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $annual_income = $_POST["annual_income"];
    $annual_expenditure = $_POST["annual_expenditure"];

    if ($annual_income <= 0 || $annual_expenditure < 0) {
        $error_message = "Please enter valid values for all fields.";
    } else {
        $max_mortgage = ($annual_income - $annual_expenditure) * 4.5;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affordability Calculator</title>
    <?php include("navbar.php"); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Affordability Calculator</h2>
        <form method="POST" action="affordability_calculator.php">
            <div class="mb-3">
                <label for="annual_income" class="form-label">Annual Income (£)</label>
                <input type="number" class="form-control" id="annual_income" name="annual_income" value="<?php echo htmlspecialchars($annual_income); ?>" required>
            </div>
            <div class="mb-3">
                <label for="annual_expenditure" class="form-label">Annual Expenditure (£)</label>
                <input type="number" class="form-control" id="annual_expenditure" name="annual_expenditure" value="<?php echo htmlspecialchars($annual_expenditure); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger mt-4"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <?php if ($max_mortgage > 0): ?>
            <div class="mt-5 mb-3">
                <h3>Your Results</h3>
                <p><strong>Maximum Mortgage You Can Afford:</strong> £<?php echo number_format($max_mortgage, 2); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>