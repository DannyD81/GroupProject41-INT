<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous" defer></script>
</head>
<body>
    <div class="home">
        <?php include("navbar.php"); ?>

        <main class="form-updatedetails w-50 m-auto my-5">
            <form>
                <h1 class="h3 mb-4 fw-normal text-center">Update Details</h1>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="fullName" placeholder="Full Name" required>
                    <label for="fullName">Full Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="dateOfBirth" placeholder="DD/MM/YYYY" required>
                    <label for="dateOfBirth">Date of Birth</label>
                </div>

                <div class="mb-3">
                    <label for="employmentStatus" class="form-label">Employment Status</label>
                    <select class="form-select" id="employmentStatus" required>
                        <option selected disabled>Choose...</option>
                        <option value="1">Employed</option>
                        <option value="2">Unemployed</option>
                        <option value="3">Self-Employed</option>
                        <option value="4">Retired</option>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="annualIncome" placeholder="Annual Income" required>
                    <label for="annualIncome">Annual Income</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="monthlyOutgoings" placeholder="Monthly Outgoings" required>
                    <label for="monthlyOutgoings">Monthly Outgoings</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="number" class="form-control" id="creditScore" placeholder="Credit Score" required>
                    <label for="creditScore">Credit Score</label>
                </div>

                <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Save</button>
            </form>

            <a href="logged-in-home.php" class="btn btn-outline-secondary w-100 py-2">Back</a>
        </main>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
