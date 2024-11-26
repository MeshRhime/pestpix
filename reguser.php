<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register as User</title>
    <link rel="stylesheet" href="assets/css/reguser.css"> <!-- External CSS -->
</head>
<body>
    <div class="header">
        <div class="logo">
            <img alt="Logo" src="assets/img/logo.png" />
            <div class="title">PESTPIX: Farmerce System</div>
        </div>
    </div>

    <div class="container">
        <h1>Register as User</h1>
        <form action="register_user.php" method="post">
            <input class="input-field" name="username" placeholder="Username" type="text" required />
            <input class="input-field" name="email" placeholder="Email" type="email" required />
            <input class="input-field" name="password" placeholder="Password" type="password" required />
            <input class="input-field" name="confirm_password" placeholder="Confirm Password" type="password" required />
            <button class="button" type="submit" name="register_user">Register</button>
        </form>
    </div>

    <div class="footer">
        <div class="logo">&copy; 2024 PESTPIX: Farmerce System</div>
    </div>
</body>
</html>
