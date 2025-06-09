<!--
This is the register page.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            margin: 120px auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #1d3557;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #457b9d;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #457b9d;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #1d3557;
        }
        .form-container h2 {
            color: #1d3557;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-container p {
            text-align: center;
            margin-top: 20px;
            color: #1d3557;
        }
        .form-container a {
            color: #457b9d;
            text-decoration: none;
        }
        .form-container a:hover {
            text-decoration: underline;
        }
        .invalid-feedback {
            color: #e63946;
            font-size: 14px;
            margin-top: 5px;
        }
        .is-invalid {
            border-color: #e63946 !important;
        }
    </style>
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