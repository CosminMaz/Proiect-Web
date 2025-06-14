<!--
This is the register page.
It is used to register a new user.
It is used to display the register page.
It is used to check if the user is authenticated and if the token is valid.
If the user is not authenticated or the token is invalid, it redirects to the login page.
If the user is authenticated and the token is valid, it displays the dashboard page.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/register.css">
</head>
<body>
    <header id="navbar">
        <div class="logo">CAM Real Estate</div>
        <nav>
            <ul>
                <li><a href="<?php echo URLROOT; ?>">Acasă</a></li>
                <li><a href="<?php echo URLROOT; ?>/users/login">Loghează-te</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h2>Creează un cont</h2>
        <form action="<?php echo URLROOT; ?>/users/register" method="post">
            <div class="form-group">
                <label for="name">Nume: <sup>*</sup></label>
                <input type="text" name="name" class="<?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email: <sup>*</sup></label>
                <input type="email" name="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Parolă: <sup>*</sup></label>
                <input type="password" name="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmă parola: <sup>*</sup></label>
                <input type="password" name="confirm_password" class="<?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Înregistrează-te</button>
            </div>
            <p>Ai deja cont? <a href="<?php echo URLROOT; ?>/users/login">Loghează-te</a></p>
        </form>
    </div>

    <script src="<?php echo URLROOT; ?>/public/assets/script.js"></script>
</body>
</html>
