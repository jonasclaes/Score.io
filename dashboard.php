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
            <div class="alert alert-success" role="alert" id="alertBoxSuccess" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <span><strong>Success</strong></span>
                <span></span>
            </div>
            <div class="alert alert-danger" role="alert" id="alertBoxDanger" style="display: none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <span><strong>Fout</strong></span>
                <span></span>
            </div>
            <div class="col-sm-6 col-md-4" style="margin-bottom: 20px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Score toevoegen</h4>
                        <form id="formInsert">
                            <div class="form-group">
                                <label for="timestamp">Tijdstip:</label>
                                <input class="form-control" type="text" placeholder="2020-05-13 00:04" name="timestamp">
                                <small class="form-text text-muted">Vul hier het tijdstip in.</small>
                            </div>
                            <div class="form-group">
                                <label for="name">Naam:</label>
                                <input class="form-control" type="text" placeholder="Wiskunde" name="name">
                                <small class="form-text text-muted">Vul hier de naam in.</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Omschrijving:</label>
                                <input class="form-control" type="text" placeholder="Lettersoep." name="description">
                                <small class="form-text text-muted">Vul hier de omschrijving in.</small>
                            </div>
                            <div class="form-group">
                                <label for="score">Score:</label>
                                <input class="form-control" type="number" name="score" placeholder="0">
                                <small class="form-text text-muted">Vul hier de score in.</small>
                            </div>
                            <div class="form-group">
                                <label for="maxScore">Maximum score:</label>
                                <input class="form-control" type="number" name="maxScore" placeholder="10">
                                <small class="form-text text-muted">Vul hier de maximum score in.</small>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Toevoegen</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-md-4" style="margin-bottom: 20px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Score wijzigen</h4>
                        <form id="formUpdate">
                            <div class="form-group">
                                <label for="id">ID:</label>
                                <input class="form-control" type="number" name="id" placeholder="10">
                                <small class="form-text text-muted">Vul hier de id van de te bewerken score in.</small>
                            </div>
                            <div class="form-group">
                                <label for="timestamp">Tijdstip:</label>
                                <input class="form-control" type="text" placeholder="2020-05-13 00:04" name="timestamp">
                                <small class="form-text text-muted">Vul hier het tijdstip in.</small>
                            </div>
                            <div class="form-group">
                                <label for="name">Naam:</label>
                                <input class="form-control" type="text" placeholder="Wiskunde" name="name">
                                <small class="form-text text-muted">Vul hier de naam in.</small>
                            </div>
                            <div class="form-group">
                                <label for="description">Omschrijving:</label>
                                <input class="form-control" type="text" placeholder="Lettersoep." name="description">
                                <small class="form-text text-muted">Vul hier de omschrijving in.</small>
                            </div>
                            <div class="form-group">
                                <label for="score">Score:</label>
                                <input class="form-control" type="number" name="score" placeholder="0">
                                <small class="form-text text-muted">Vul hier de score in.</small>
                            </div>
                            <div class="form-group">
                                <label for="maxScore">Maximum score:</label>
                                <input class="form-control" type="number" name="maxScore" placeholder="10">
                                <small class="form-text text-muted">Vul hier de maximum score in.</small>
                            </div>
                            <button class="btn btn-warning btn-block" type="submit">Wijzigen</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 offset-lg-2" style="margin-bottom: 20px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Wachtwoord wijzigen</h4>
                        <form id="formUpdate">
                            <div class="form-group">
                                <label for="password">Wachtwoord:</label>
                                <input class="form-control" type="password" name="password">
                                <small class="form-text text-muted">Gelieve hier uw nieuw wachtwoord in te vullen.</small>
                            </div>
                            <div class="form-group">
                                <label for="passwordVerify">Wachtwoord verificatie:</label>
                                <input class="form-control" type="password" name="passwordVerify">
                                <small class="form-text text-muted">Gelieve hier uw nieuw wachtwoord opnieuw in te vullen.</small>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Wijzigen</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4" style="margin-bottom: 20px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Score verwijderen</h4>
                        <form id="formDelete">
                            <div class="form-group">
                                <label for="id">ID:</label>
                                <input class="form-control" type="number" name="id" placeholder="10">
                                <small class="form-text text-muted">Vul hier de id van de te verwijderen score in.</small>
                            </div>
                            <button class="btn btn-danger btn-block" type="submit">Verwijderen</button>
                        </form>
                    </div>
                </div>
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