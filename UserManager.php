<?php

class UserManager {
    private $userDataFile = 'userdata.txt';
    private $userData = [];

    public function __construct() {
        if (file_exists($this->userDataFile)) {
            $fileContents = file($this->userDataFile, FILE_IGNORE_NEW_LINES);
            foreach ($fileContents as $line) {
                $data = explode("\t", $line);
                $this->userData[$data[0]] = $data[1];
            }
        }
    }

    public function registerUser($username, $password) {
        if (array_key_exists($username, $this->userData)) {
            return false; 
        }

        $data = "$username\t$password\n";
        file_put_contents($this->userDataFile, $data, FILE_APPEND);
        return true;
    }

    public function checkLoginCredentials($enteredUsername, $enteredPassword) {
        if (array_key_exists($enteredUsername, $this->userData)) {
            $storedPassword = $this->userData[$enteredUsername];
            if ($enteredPassword === $storedPassword) {
                return true; 
            } else {
                return false; 
            }
        } else {
            return false; 
        }
    }
}
?>
