<?php

    $username = $_SESSION["username"];

    $result = $mysqli->query("SELECT * FROM users WHERE username = '$username'");

    if ($result->num_rows === 0) {
        return;
    }

    $user = $result->fetch_assoc();

    echo $user["password"];