<!--
This is the login page.
It is used to log the user in.
It is used to display the login page.
It is used to check if the user is authenticated and if the token is valid.
If the user is not authenticated or the token is invalid, it redirects to the login page.
If the user is authenticated and the token is valid, it displays the dashboard page.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/login.css">
</head>
<body>
    <header id="navbar">
        <div class="logo">CAM Real Estate</div>
        <nav>
            <ul>
                <li><a href="<?php echo URLROOT; ?>">Acasă</a></li>
                <li><a href="<?php echo URLROOT; ?>/users/register">Înregistrare</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h2>Loghează-te</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="email">Email: <sup>*</sup></label>
                <input type="email" name="email" id="email" class="<?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Parolă: <sup>*</sup></label>
                <input type="password" name="password" id="password" class="<?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Loghează-te</button>
            </div>
    <div id="error-message"></div>
    <p>Nu ai cont? <a href="<?php echo URLROOT; ?>/users/register">Înregistrează-te</a></p>
</form>
</div>

<script>
    // Inject URL root for API calls
    window.urlRoot = '<?php echo URLROOT; ?>';
</script>
<script src="<?php echo URLROOT; ?>/public/assets/js/login.js"></script>
</body>
</html>
