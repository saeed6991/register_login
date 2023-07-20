<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userData = [];
    if (file_exists('userdata.txt')) {
        $fileContents = file('userdata.txt', FILE_IGNORE_NEW_LINES);
        foreach ($fileContents as $line) {
            $data = explode("\t", $line);
            $userData[$data[0]] = $data[1];
        }
    }

    if (array_key_exists($username, $userData)) {
        echo '<script>alert("User schon da"); setTimeout(function() { window.location.href = "login.html"; }, 100);</script>';
        exit;
    } else {
        $data = "$username\t$password\n";
        file_put_contents('userdata.txt', $data, FILE_APPEND);
        header('Location: index.html');
        exit;
    }
}
?>
