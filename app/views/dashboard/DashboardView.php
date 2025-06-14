<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header id="navbar">
        <div class="logo">CAM Real Estate</div>
        <nav>
            <ul>
                <li><a href="#" id="logoutBtn">Deconectare</a></li>
            </ul>
        </nav>
    </header>
        
    <div class="dashboard-container">
        <div class="greeting">Salutare, <?php echo isset($data['user']->nume) ? htmlspecialchars($data['user']->nume) : 'Utilizator'; ?></div>
        
        <div class="dashboard-actions">
            <a href="<?php echo URLROOT; ?>/properties/add" class="action-button">
                <i class="fas fa-plus"></i> Adaugă Proprietate
            </a>
            <a href="<?php echo URLROOT; ?>/properties/search" class="action-button">
                <i class="fas fa-search"></i> Caută Proprietăți
            </a>
        </div>
    </div>
 
    <script>
        // Ensure old token key is removed
        localStorage.removeItem('jwt_token');
        
        // Add token to all future requests
        const token = localStorage.getItem('token');
        if (token) {
            // Add token to all fetch requests
            const originalFetch = window.fetch;
            window.fetch = function() {
                let [resource, config] = arguments;
                if (config === undefined) {
                    config = {};
                }
                if (config.headers === undefined) {
                    config.headers = {};
                }
                config.headers['Authorization'] = 'Bearer ' + token;
                return originalFetch(resource, config);
            };
        }

        // Handle logout
        document.getElementById('logoutBtn').addEventListener('click', async function(e) {
            e.preventDefault();
            
            try {
                const response = await fetch('<?php echo URLROOT; ?>/users/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + token
                    }
                });

                const data = await response.json();
                
                if (data.status === 'success') {
                    // Clear local storage
                    localStorage.removeItem('token');
                    
                    // Redirect to login page
                    window.location.href = data.redirect;
                } else {
                    console.error('Logout failed:', data.message);
                }
            } catch (error) {
                console.error('Error during logout:', error);
            }
        });
    </script>
</body>
</html>
