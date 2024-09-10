<?php
echo isset($_GET['num1'], $_GET['num2']) ?
    "<h2>Addition Result</h2><p>The sum of {$_GET['num1']} and {$_GET['num2']} is: " . ((int)$_GET['num1'] + (int)$_GET['num2']) . "</p>" : "<p>Invalid input.</p>";
?>

<!-- had to flex with the Ternary Operator ;) --->
