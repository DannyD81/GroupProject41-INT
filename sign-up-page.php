<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="icon" href="logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <script src="script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous" defer></script>
</head>
<body>
    <main class="form-signin w-50 m-auto my-5">
        <form>
            <h1 class="h3 mb-4 fw-normal text-center">Please sign up</h1>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="email" placeholder="name@example.com" required>
                <label for="email">Email address</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" placeholder="user123" required>
                <label for="username">Username</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>

            <button class="btn btn-primary w-100 py-2 mb-3" type="submit">Sign up</button>

            <p class="text-center mb-0">Already got an account? <a href="login-page.php">Click here</a></p>
        </form>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>
