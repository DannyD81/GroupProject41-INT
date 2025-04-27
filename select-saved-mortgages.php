<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header('Location: login-page.php');
    exit();
}

$db = new SQLite3('MortgageSystem.db');

$userID = $_SESSION['UserID'];
$savedComparisons = [];

$stmt = $db->prepare('SELECT * FROM SavedComparisons WHERE UserID = :userID ORDER BY SavedAt DESC');
$stmt->bindValue(':userID', $userID, SQLITE3_INTEGER);
$results = $stmt->execute();

while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $savedComparisons[] = $row;
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Comparisons</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>

<?php include("navbar.php"); ?>

<main class="container my-5">
    <h1 class="h3 mb-4 fw-bold text-center">Your Saved Comparisons</h1>

    <?php if (isset($_GET['saved'])): ?>
        <div class="alert alert-success">Comparison saved successfully!</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Failed to save comparison.</div>
    <?php endif; ?>

    <?php if (count($savedComparisons) > 0): ?>
        <div class="list-group">
            <?php foreach ($savedComparisons as $comparison): ?>
                <a href="view-comparison.php?id=<?= $comparison['ID'] ?>" class="list-group-item list-group-item-action">
                    Comparison saved on <?= htmlspecialchars($comparison['SavedAt']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning text-center">No saved comparisons yet.</div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="logged-in-home.php" class="btn btn-secondary">Back Home</a>
    </div>
</main>

<?php include("footer.php"); ?>

</body>
</html>
