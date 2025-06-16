<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caută Proprietăți - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .search-container {
            max-width: 1200px;
            margin: 100px auto 40px;
            padding: 20px;
        }

        .search-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .search-header h1 {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            padding: 20px;
        }

        .property-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .property-card:hover {
            transform: translateY(-5px);
        }

        .property-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .property-info {
            padding: 20px;
        }

        .property-info h3 {
            color: #1d3557;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }

        .property-info p {
            color: #457b9d;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .property-price {
            color: #1d3557;
            font-weight: bold;
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .property-type {
            display: inline-block;
            background: #457b9d;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8rem;
            margin-bottom: 10px;
        }

        .back-button {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 10px 20px;
            border: 2px solid white;
            border-radius: 10px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .back-button:hover {
            background: white;
            color: #1d3557;
        }
    </style>
</head>
<body>
    <header id="navbar">
        <div class="logo">CAM Real Estate</div>
        <nav>
            <ul>
                <li><a href="<?php echo URLROOT; ?>/dashboard">Dashboard</a></li>
                <li><a href="#" id="logoutBtn">Deconectare</a></li>
            </ul>
        </nav>
    </header>

    <div class="search-container">
        <div class="search-header">
            <h1>Caută Proprietăți</h1>
            <a href="<?php echo URLROOT; ?>/dashboard" class="back-button">
                <i class="fas fa-arrow-left"></i> Înapoi la Dashboard
            </a>
        </div>

        <div class="properties-grid">
            <?php if(isset($data['properties']) && !empty($data['properties'])) : ?>
                <?php foreach($data['properties'] as $property) : ?>
                    <div class="property-card">
                        <img src="<?php echo URLROOT; ?>/public/assets/photos/chirii/pexels-sami-aksu-48867324-10864449.jpg" alt="<?php echo htmlspecialchars($property->title); ?>" class="property-image">
                        <div class="property-info">
                            <span class="property-type"><?php echo htmlspecialchars($property->status); ?></span>
                            <h3><?php echo htmlspecialchars($property->title); ?></h3>
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($property->latitude . ', ' . $property->longitude); ?></p>
                            <p><i class="fas fa-ruler-combined"></i> <?php echo htmlspecialchars($property->suprafata); ?> m²</p>
                            <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($property->contact); ?></p>
                            <p class="property-price"><?php echo htmlspecialchars($property->price); ?> €</p>
                            <?php if(!empty($property->facilities)) : ?>
                                <p><i class="fas fa-check-circle"></i> Facilități: <?php echo htmlspecialchars($property->facilities); ?></p>
                            <?php endif; ?>
                            <?php if(!empty($property->risks)) : ?>
                                <p><i class="fas fa-exclamation-triangle"></i> Riscuri: <?php echo htmlspecialchars($property->risks); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p style="color: white; text-align: center; grid-column: 1 / -1;">Nu există proprietăți disponibile.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Handle logout
        document.getElementById('logoutBtn').addEventListener('click', async function(e) {
            e.preventDefault();
            
            try {
                const response = await fetch('<?php echo URLROOT; ?>/users/logout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                });

                const data = await response.json();
                
                if (data.status === 'success') {
                    // Clear local storage
                    localStorage.removeItem('token');
                    localStorage.removeItem('jwt_token');
                    
                    // Clear any cookies
                    document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                    
                    // Redirect to login page
                    window.location.href = data.redirect;
                } else {
                    console.error('Logout failed:', data.message);
                }
            } catch (error) {
                console.error('Error during logout:', error);
                // Even if there's an error, try to clear storage and redirect
                localStorage.removeItem('token');
                localStorage.removeItem('jwt_token');
                document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                window.location.href = '<?php echo URLROOT; ?>/users/login';
            }
        });
    </script>
</body>
</html> 