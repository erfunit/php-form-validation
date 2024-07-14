<?php

$errors = array();
$fields = array("name", "email", "password", "confirm_password");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Getting input data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Validate required fields
    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucwords(str_replace("_", " ", $field)) . " is required.";
        }
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password match
    if (!empty($password) && !empty($confirm_password) && $password != $confirm_password) {
        $errors[] = "Password and confirm password do not match.";
    }

    // Display errors
    foreach ($errors as $error) {
        echo "<div class=\"text-red-700 bg-red-100 border border-red-700 p-2 rounded-md\">$error</div>";
    }
}
?>
