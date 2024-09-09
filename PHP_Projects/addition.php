<?php
if (isset($_GET['num1']) && isset($_GET['num2'])) {
    $num1 = (int)$_GET['num1'];
    $num2 = (int)$_GET['num2'];
    $result = $num1 + $num2;
    echo "<h2>Addition Result</h2>";
    echo "<p>The sum of {$num1} and {$num2} is: {$result}</p>";
} else {
    echo "<p>Invalid input.</p>";
}
?>