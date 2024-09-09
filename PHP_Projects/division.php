<?php
if (isset($_GET['num1']) && isset($_GET['num2'])) {
    $num1 = (int)$_GET['num1'];
    $num2 = (int)$_GET['num2'];
    if ($num2 == 0) {
        echo "<h2>Division Result</h2>";
        echo "<p>Division by zero is not allowed.</p>";
    } else {
        $result = $num1 / $num2;
        echo "<h2>Division Result</h2>";
        echo "<p>The result of dividing {$num1} by {$num2} is: {$result}</p>";
    }
} else {
    echo "<p>Invalid input.</p>";
}
?>