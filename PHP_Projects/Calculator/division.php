<?php
if (isset($_GET['num1'], $_GET['num2'])) {
    $num1 = (int)$_GET['num1'];
    $num2 = (int)$_GET['num2'];

    if ($num2 !== 0) {
        $result = $num1 / $num2;
        echo "<h2>Division Result</h2>";
        echo "<p>The result of dividing {$num1} by {$num2} is: {$result}</p>";
    } else {
        echo "<h2>Division Result</h2>";
        echo "<p>Division by zero is not allowed.</p>";
    }
} else {
    echo "<p>Invalid input.</p>";
}
?>

<!-- Can I do this using a Ternary Operator? -->
<!-- No.... but ChatGPT Can:

$num1 = isset($_GET['num1']) ? (int)$_GET['num1'] : null;
$num2 = isset($_GET['num2']) ? (int)$_GET['num2'] : null;

echo $num1 !== null && $num2 !== null
    ? ($num2 !== 0
        ? "<h2>Division Result</h2><p>The result of dividing $num1 by $num2 is: " . ($num1 / $num2) . "</p>"
        : "<h2>Division Result</h2><p>Division by zero is not allowed.</p>"
    )
    : "<p>Invalid input.</p>";

-->
