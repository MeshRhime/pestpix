<!DOCTYPE html>
<html>
<head>
    <title>Register as Seller</title>
    <link rel="stylesheet" href="assets/css/regsel.css"> <!-- External CSS -->
</head>
<body>
    <div class="header">
        <div class="logo">
            <img alt="Logo" src="assets/img/logo.png"/>
            <div class="title">PESTPIX: Farmerce System</div>
        </div>
    </div>

    <div class="container">
        <h1>Register as Seller</h1>
        <form action="register_seller.php" method="post">
            <input class="input-field" name="username" placeholder="Username" type="text" required />
            <input class="input-field" name="email" placeholder="Email" type="email" required />
            <input class="input-field" name="password" placeholder="Password" type="password" required />
            <input class="input-field" name="confirm_password" placeholder="Confirm Password" type="password" required />
            <button class="button" type="submit" name="register_seller">Register</button>
        </form>
    </div>

    <div class="footer">
        <div class="logo">&copy; 2024 PESTPIX: Farmerce System</div>
    </div>
</body>
</html>
