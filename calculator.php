<d?php
// Initialize variables
$Annual_income = 0;
$Annual_Expenditure = 0;
$result = 0;
$error_message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Annual_income = $_POST["Annual_income"];
    $Annual_Expenditure = $_POST["Annual_Expenditure"];
    

    
    if  ($Annual_income <= 0 || $Annual_Expenditure < 0) {
        $error_message = "Please enter valid values for all fields.";
    } else {
        
        $result = ($Annual_income - $Annual_Expenditure) * 4.5;

    
        
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
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>

    
    <header class="text-center mt-5">Affordability Calculator</header> 

    <class="container mt-5">
        <h2>Enter Annual income</h2>
        <form method="POST" action="calculator.php">
            <div class="mb-3">
                <label for="Annual_income" class="form-label">Annual_income (£)</label>
                <input type="number" class="form-control" id="Annual_income" name="Annual_income" value="<?php echo htmlspecialchars($Annual_income); ?>" required>
            </div>

            <div class="mb-3">
                <label for="deposit" class="form-label">Annual_Expenditure (£)</label>
                <input type="number" class="form-control" id="Annual_Expenditure" name="Annual_Expenditure" value="<?php echo htmlspecialchars($Annual_Expenditure); ?>" required>
            </div>





          

            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <?php if ($error_message): ?>
            <div class="alert alert-danger mt-4">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        
        <?php if ($result > 0): ?>
            <div class="mt-5">
                <h3>You are eligible for this loan.</h3>
                <p><strong>Amount based on your calculation:</strong> £<?php echo number_format($result, 2); ?></p>
            </div>
        <?php endif; ?>
        </div>
    
    <center>
            <div class="nav-buttons text-centre">
            <button onclick="location.href='index.php'">Back</button>
            </center>

    <?php include("footer.php"); ?> <!-- Include your footer here -->

</body>
</html>

