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
            <p class="p">Please enter your details!</p>
        </div>
        <div class="input__wrapper">
            <input type="email" id="email" name="email" class="input__field" placeholder="Your Email" required autocomplete="off">
            <label for="email" class="input__label">Email:</label>
            <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                <path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path>
            </svg>
        </div>
        <div class="input__wrapper">
            <input id="password" name="mot_de_passe" type="password" class="input__field" placeholder="Your Password"
                   title="Minimum 6 characters at least 1 Alphabet and 1 Number"
                   pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$" required autocomplete="off">
            <label for="password" class="input__label">Password</label>
            <svg class="input__icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
            </svg>
        </div>
        <button type="submit" class="my-form__button">Login</button>
    </form>
</body>
</html>
