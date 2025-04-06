<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $productID = intval($_POST["id"]);
    $db = new SQLite3("MortgageSystem.db");

    $stmt = $db->prepare("DELETE FROM Products WHERE ProductsID = :id");
    $stmt->bindValue(":id", $productID, SQLITE3_INTEGER);

    if ($stmt->execute()) {
        $db->close();
        header("Location: broker-products.php?deleted=1");
        exit();
    } else {
        $db->close();
        header("Location: broker-products.php?error=1");
        exit();
    }
} else {
    header("Location: broker-products.php");
    exit();
}
