<?php
$loan_amount = 0;
$deposit = 0;
$loan_term = 0;
$interest_rate = 0;
$monthly_payment = 0;
$total_repay = 0;
$capital = 0;
$interest = 0;
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values
    $mortgage_amount = $_POST["mortgage_amount"];
    $mortgage_term_year = $_POST["mortgage_term_year"];
    $mortgage_term_month = $_POST["mortgage_term_month"];
    $interest_rate = $_POST["interest_rate"];

    // Ensure loan amount, deposit, term, and interest rate are valid
    if ($mortgage_amount <= 0 || $deposit < 0 || ($mortgage_term_year <= 0 && $mortgage_term_month <= 0) || $interest_rate <= 0) {
        $error_message = "Please enter valid values for all fields.";
    } else {
        // Calculate the loan amount after deposit
        $loan_amount_after_deposit = $mortgage_amount - $deposit;

        // Calculate the monthly interest rate
        $monthly_interest_rate = ($interest_rate / 100) / 12;

        // Calculate the loan term in months (consider both years and months input)
        $loan_term_months = ($mortgage_term_year * 12) + $mortgage_term_month;

        // Calculate the monthly payment
        if ($monthly_interest_rate > 0) {
            $monthly_payment = $loan_amount_after_deposit * ($monthly_interest_rate * pow(1 + $monthly_interest_rate, $loan_term_months)) / (pow(1 + $monthly_interest_rate, $loan_term_months) - 1);
        } else {
            // If interest rate is 0%, we can just divide the loan amount by the term in months
            $monthly_payment = $loan_amount_after_deposit / $loan_term_months;
        }

        // Calculate the total repayment over the loan term
        $total_repay = $monthly_payment * $loan_term_months;

        // Calculate capital and interest
        $capital = $loan_amount_after_deposit;
        $interest = $total_repay - $capital;
    }
}
?>
