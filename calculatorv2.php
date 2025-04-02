<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <?php include("navbar.php"); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <head>

    <h1 style="text-align:center; font-weight:bold;">Affordability calculator</h1>
    
    

</head>
 
<body>


<main class="form-signin w-50 m-auto my-5">
    <form id="loanForm">
        <h1 class="h3 mb-4 fw-normal text-center">Please fill in details</h1>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="property_price" placeholder="Enter Property Price" required>
            <label for="property_price">Property Price</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="deposit_amount" placeholder="Enter Deposit Amount" required>
            <label for="deposit_amount">Deposit Amount</label>
        </div>

        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="loan_term" placeholder="Enter Loan Term (years)" required>
            <label for="loan_term">Term of Loan (Years)</label>
        </div>

        <div>
            <button type="submit" id="calculateBtn" class="btn btn-primary w-70 py-2 mb-3">Show Results</button>
        </div>

        <div class="loan-results" id="loanResults" style="display: none;">
            <h2>You can borrow up to..</h2>
            <div class="amount" id="borrowAmount">$0</div>
            <p class="description">This is the amount you can borrow up to.</p>

            <h2>Monthly Payment</h2>
            <div class="amount" id="monthlyPayment">$0</div>
            <p class="description">This is your estimated monthly repayment.</p>

            <h2>Total Amount Payable</h2>
            <div class="amount" id="totalPayable">$0</div>
            <p class="description">This is the total amount including interest.</p>
        </div>
    </form>
</main>
<script>
    document.getElementById("loanForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent form refresh

    // Get input values
    let propertyPrice = parseFloat(document.getElementById("property_price").value);
    let deposit = parseFloat(document.getElementById("deposit_amount").value);
    let loanTerm = parseFloat(document.getElementById("loan_term").value);

    if (isNaN(propertyPrice) || isNaN(deposit) || isNaN(loanTerm)) {
        alert("Please enter valid numbers in all fields.");
        return;
    }

    // Loan calculations
    let loanAmount = propertyPrice - deposit; // Amount borrowed
    let interestRate = 5 / 100 / 12; // 5% annual interest rate divided by 12 months
    let totalMonths = loanTerm * 12;

    // Monthly Payment Calculation (Formula for fixed monthly payments)
    let monthlyPayment = (loanAmount * interestRate) / (1 - Math.pow(1 + interestRate, -totalMonths));
    let totalPayable = monthlyPayment * totalMonths;

    // Display results
    document.getElementById("borrowAmount").textContent = `$${loanAmount.toFixed(2)}`;
    document.getElementById("monthlyPayment").textContent = `$${monthlyPayment.toFixed(2)}`;
    document.getElementById("totalPayable").textContent = `$${totalPayable.toFixed(2)}`;

    // Show the results section
    document.getElementById("loanResults").style.display = "block";
});
</script>

   
    <?php include("footer.php") ?>

</body>



</html>

