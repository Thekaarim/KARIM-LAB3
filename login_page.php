<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f1f1f1;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #00529b;
}

form label {
    display: block;
    font-weight: bold;
    margin-top: 10px;
}

form input[type="email"],
form input[type="password"] {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

form input[type="submit"] {
    background-color: #00529b;
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
}

form input[type="submit"]:hover {
    background-color: #00356b;
}

.error-message {
    color: red;
}
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="dashboard.php">
        <label for="login_email">Email:</label>
        <input type="email" name="login_email" required>
        <br><br>

        <label for="login_password">Password:</label>
        <input type="password" name="login_password" required>
        <br><br>

        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
