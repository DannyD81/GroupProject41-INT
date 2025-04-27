<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header("Location: login-page.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $UserID = $_SESSION['UserID'];  
    $comparisonName = trim($_POST['comparison_name']);
    $selectedProducts = $_POST['selected_products'] ?? [];

    if ($comparisonName && !empty($selectedProducts)) {
        $productIDs = implode(',', $selectedProducts);

        $db = new SQLite3('MortgageSystem.db');

        $stmt = $db->prepare("INSERT INTO Comparisons (UserID, ComparisonName, ProductIDs) 
                              VALUES (:UserID, :ComparisonName, :ProductIDs)");
        $stmt->bindValue(':UserID', $UserID, SQLITE3_INTEGER);  // ← Capitalized
        $stmt->bindValue(':ComparisonName', $comparisonName, SQLITE3_TEXT);
        $stmt->bindValue(':ProductIDs', $productIDs, SQLITE3_TEXT);

        if ($stmt->execute()) {
            header("Location: compare-saved-mortgages.php");
            exit();
        } else {
            echo "Failed to save comparison.";
        }
    } else {
        echo "Missing comparison name or selected products.";
    }
} else {
    header("Location: view-products-to-compare.php");
    exit();
}
?>
