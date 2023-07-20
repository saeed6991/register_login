<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    $userData = [];
    if (file_exists('userdata.txt')) {
        $fileContents = file('userdata.txt', FILE_IGNORE_NEW_LINES);
        foreach ($fileContents as $line) {
            $data = explode("\t", $line);
            $userData[$data[0]] = $data[1];
        }
    }

    if (array_key_exists($enteredUsername, $userData)) {
        $storedPassword = $userData[$enteredUsername];
        if ($enteredPassword === $storedPassword) {
            header('Location: login_successful.html');
            exit;
        } else {
            echo '<script>alert("Falsche Passwort, Versuch es noch mal :)"); setTimeout(function() { window.location.href = "login.html"; }, 100);</script>';
            exit;
        }
    } else {
        echo '<script>alert("User nicht existiert"); setTimeout(function() { window.location.href = "login.html"; }, 100);</script>';
        exit;
    }
}
?>