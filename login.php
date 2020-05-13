<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION["userId"])) {
    header("Location: /");
}

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
                        <a class="nav-link active" href="/login.php">Aanmelden</a>
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
            <div class="col-sm-8 col-md-6 col-xl-4 offset-sm-2 offset-md-3 offset-xl-4">
                <div class="alert alert-danger" role="alert" id="alertBoxDanger" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>Fout</strong></span>
                    <span></span>
                </div>
                <div class="alert alert-success" role="alert" id="alertBoxSuccess" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <span><strong>Success</strong></span>
                    <span></span>
                </div>
                <form id="formLogin">
                    <div class="form-group">
                        <label for="username">Gebruikersnaam:</label>
                        <input class="form-control" type="text" name="username" placeholder="janmodaal">
                        <small class="form-text text-muted">Gelieve hier je gebruikersnaam in te vullen.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Wachtwoord:</label>
                        <input class="form-control" type="password" name="password">
                        <small class="form-text text-muted">Gelieve hier je wachtwoord in te vullen.</small>
                    </div>
                    <button class="btn btn-outline-primary btn-block" type="submit">Aanmelden</button>
                    <small>Nog geen account? Maak er een <a href="/register.php">hier</a>.</small>
                </form>
            </div>
        </div>
    </div>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        $("#formLogin").submit(async function (e) {
            e.preventDefault();

            const formElement = document.getElementById("formLogin");
            const formData = new FormData(formElement);
            
            const fetchResult = await fetch("/includes/doLogin.php", {
                method: "POST",
                body: formData
            });

            if (fetchResult.redirected) {
                $("#alertBoxDanger").hide();
                $("#alertBoxSuccess span:last").html("U bent nu aangemeld, omleiden...");
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

                $("#alertBoxDanger span:last").html(errorHtml);
                $("#alertBoxDanger").fadeIn("slow");
            }
        });
    </script>
</body>
</html>