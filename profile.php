<?php
require_once "includes/db.php";

if (!isset($_SESSION)) {
    session_start();
}

// Hier komt jouw code.

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Score.io</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-md bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Score.io</a>
            <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <?php if (!empty($_SESSION["userId"])) { ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/scores.php">Punten</a>
                    </li>
                    <?php } ?>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <?php if (empty($_SESSION["userId"])) { ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/login.php">Aanmelden</a>
                    </li>
                    <?php } ?>
                    <?php if (!empty($_SESSION["userId"])) { ?>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="/includes/doLogout.php">Afmelden</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="/profile.php">Welcome back, <?php echo $_SESSION["username"] ?></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-sm-8 col-md-6 offset-sm-2 offset-md-3">
                <h1>Welkom, <?php echo $_SESSION["username"] ?>.</h1>
                <p>Uw gebruikersnaam is <?php echo $_SESSION["username"] ?>.<br>Uw wachtwoord is PASSWORD.</p>
                <a class="btn btn-outline-primary btn-block" role="button" href="/profile-edit.php">Aanpassen</a>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        // Hier komt jouw code.
    </script>
</body>
</html>