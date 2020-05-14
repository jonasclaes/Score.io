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
            <div class="col-12">
                <div class="alert alert-danger" role="alert" id="alertBoxDanger" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>Fout</strong></span>
                    <span></span>
                </div>
            </div>
            <div class="col-12">
                <div class="alert alert-success" role="alert" id="alertBoxSuccess" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>Success</strong></span>
                    <span></span>
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
            <div class="col-sm-6 col-lg-4" style="margin-bottom: 20px;">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Account verwijderen</h4>
                        <form id="formDelete">
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
        $("#formUpdate").submit(async function (e) {
            e.preventDefault();

            const formElement = document.getElementById("formUpdate");
            const formData = new FormData(formElement);
            
            const fetchResult = await fetch("/includes/doUpdateUserPassword.php", {
                method: "POST",
                body: formData
            });

            const fetchResultJSON = await fetchResult.json();

            if (fetchResultJSON.success === true) {
                $("#alertBoxDanger").hide();
                $("#alertBoxSuccess span:last").html("Uw wachtwoord is veranderd.");
                $("#alertBoxSuccess").fadeIn("slow");
            } else {
                let errorHtml = "";
                
                fetchResultJSON["errors"].forEach(element => {
                    errorHtml += "<br>" + element;
                });

                $("#alertBoxSuccess").hide();
                $("#alertBoxDanger span:last").html(errorHtml);
                $("#alertBoxDanger").fadeIn("slow");
            }
        });

        $("#formDelete").submit(async function (e) {
            e.preventDefault();

            const formElement = document.getElementById("formDelete");
            const formData = new FormData(formElement);
            
            const fetchResult = await fetch("/includes/doDeleteUser.php", {
                method: "POST",
                body: formData
            });

            if (fetchResult.redirected) {
                $("#alertBoxDanger").hide();
                $("#alertBoxSuccess span:last").html("Uw account is verwijderd, omleiden...");
                $("#alertBoxSuccess").fadeIn("slow");

                setTimeout(() => {
                    window.location.href = fetchResult.url;
                }, 2000);
            } else {
                const fetchResultJSON = await fetchResult.json();
                let errorHtml = "";
                
                fetchResultJSON["errors"].forEach(element => {
                    errorHtml += "<br>" + element;
                });

                $("#alertBoxSuccess").hide();
                $("#alertBoxDanger span:last").html(errorHtml);
                $("#alertBoxDanger").fadeIn("slow");
            }
        });
    </script>
</body>
</html>