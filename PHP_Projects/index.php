<!-- HTML formatting that I added in for fun. Shoutout to ChatGPT for the help -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <h1>N8's Magical Calculator</h1>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9; /* Light gray background */
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #4CAF50; /* Green color */
            border-bottom: 2px solid #4CAF50; /* Green underline */
            padding: 10px;
            margin: 20px;
        }
    </style>
</head>
<body>

<!-- Task 1: Creating the two forms for addition and division -->
<h2>Addition Calculator</h2>
<form action="addition.php" method="get"> <!-- Task 2: Form submits to addition.php; Task 3: Method set to GET -->
    <label for="num1">Number 1:</label>
    <input type="number" id="num1" name="num1" required><br><br> <!-- Task 4: Unique name "num1" -->
    <label for="num2">Number 2:</label>
    <input type="number" id="num2" name="num2" required><br><br> <!-- Task 4: Unique name "num2" -->
    <input type="submit" value="Add">
</form>

<h2>Division Calculator</h2>
<form action="division.php" method="get"> <!-- Task 2: Form submits to division.php; Task 3: Method set to GET -->
    <label for="num1">Number 1:</label>
    <input type="number" id="num1" name="num1" required><br><br> <!-- Task 4: Unique name "num1" -->
    <label for="num2">Number 2:</label>
    <input type="number" id="num2" name="num2" required><br><br> <!-- Task 4: Unique name "num2" -->
    <input type="submit" value="Divide">
</form>

<!-- Task 9: Combine into 1 form -->
<h2>Unified Calculator</h2>
<form method="get">
    <label for="num1">Number 1:</label>
    <input type="number" id="num1" name="num1" required><br><br>

    <label for="num2">Number 2:</label>
    <input type="number" id="num2" name="num2" required><br><br>

    <label for="operation">Select Operation:</label>
    <select id="operation" name="operation" required>
        <option value="Add">Add</option>
        <option value="Divide">Divide</option>
        <option value="Pythagorean">Pythagorean</option>
    </select><br><br>

    <input type="submit" value="Calculate"><br>
</form>

<a href="index.php"><br>Reset</a>

<?php
// Task 5: Checking if the form has been submitted and processing accordingly
if (isset($_GET['operation']) && isset($_GET['num1']) && isset($_GET['num2'])) {
    $num1 = (int)$_GET['num1'];
    $num2 = (int)$_GET['num2'];
    $operation = $_GET['operation'];

    if ($operation === "Add") {
        // Task 6: Printing the correct result for addition
        $result = $num1 + $num2;
        // Task 7: Updating the message to include the numbers that were added
        echo "<h2>Addition Result</h2>";
        echo "<p>The sum of {$num1} and {$num2} is: {$result}</p>";
    } elseif ($operation === "Divide") {
        // Task 8: Implementing the back-end processing for division
        if ($num2 == 0) {
            echo "<h2>Division Result</h2>";
            echo "<p>Division by zero is not allowed.</p>";
        } else {
            $result = $num1 / $num2;
            echo "<h2>Division Result</h2>";
            echo "<p>The result of dividing {$num1} by {$num2} is: {$result}</p>";
        }
    } elseif ($operation === "Pythagorean") {
        // Pythagorean Theorem Operation (Task 9)
        $hypotenuse = sqrt(($num1 ** 2) + ($num2 ** 2));
        echo "<h2>Pythagorean Theorem Result</h2>";
        echo "<p>The length of the hypotenuse is: {$hypotenuse}</p>";
    }
}
?>
</body>
</html>