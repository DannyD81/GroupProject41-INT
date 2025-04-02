<?php
$result = isset($_GET['result']) ? $_GET['result'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Eligibility Results</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Affordability Calculator Result</h2>

    <div class="alert alert-success text-center mt-4">
        <h4>You are eligible for this loan.</h4>
        <p><strong>This Amount is calculated based on your income:</strong> £<?php echo number_format($result, 2); ?></p>
    </div>

    <div class="text-center">
        <a href="calculator.php" class="btn btn-secondary">Back to Calculator</a>
    </div>
</div>

<?php include("footer.php"); ?>

</body>
</html>












