<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Campus School Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class="my-form" method="post" action="login.php">
        <div class="login-welcome-row">
            <a href="#" title="Logo">
                <img src="../../assets/images/imelogos.png" alt="Logo" class="logo">
            </a>
            <h1>&#x1F393; IME - School &#127891;</h1>
            <p>Please enter your details!</p>
        </div>
        <div class="input__wrapper">
            <input type="email" id="email" name="email" class="input__field" placeholder="Your Email" required autocomplete="off">
            <label for="email" class="input__label">Email:</label>
        </div>
        <div class="input__wrapper">
            <input id="password" name="mot_de_passe" type="password" class="input__field" placeholder="Your Password"
                   title="Minimum 6 characters at least 1 Alphabet and 1 Number"
                   pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required autocomplete="off">
            <label for="password" class="input__label">Password</label>
        </div>
        <a href="hach.php"><h1>hach</h1></a>
        <button type="submit" class="my-form__button">Login</button>
    </form>
</body>
</html>
