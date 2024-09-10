<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #4CAF50;
            border-bottom: 2px solid #4CAF50;
            padding: 10px;
            margin: 20px;
        }
        form {
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #fff;
            width: 300px;
            text-align: left;
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="password"] {
            padding: 8px;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Login Page</h1>

<form action="login.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <input type="submit" value="Login">
</form>

</body>
</html>