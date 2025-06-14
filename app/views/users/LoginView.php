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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/login.css">
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
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            const loginForm = document.getElementById('loginForm');
            console.log('Login form:', loginForm);

            loginForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                console.log('Form submitted');
                
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                console.log('Email:', email);
                console.log('Password:', password);
                
                try {
                    const response = await fetch('<?php echo URLROOT; ?>/users/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            email: email,
                            password: password
                        })
                    });
                    
                    console.log('Response received:', response);
                    
                    const data = await response.json();
                    console.log('Data received:', data);
                    
                    if (data.status === 'success') {
                        console.log('Login successful, storing token and redirecting');
                        localStorage.removeItem('jwt_token'); // Remove old key if it exists
                        localStorage.setItem('token', data.token);
                        
                        // Redirect to dashboard
                        window.location.href = data.redirect;
                    } else {
                        console.log('Login failed:', data.message);
                        document.getElementById('error-message').textContent = data.message;
                        document.getElementById('error-message').style.display = 'block';
                    }
                } catch (error) {
                    console.error('Error during login:', error);
                    document.getElementById('error-message').textContent = 'A apărut o eroare. Vă rugăm să încercați din nou.';
                    document.getElementById('error-message').style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
