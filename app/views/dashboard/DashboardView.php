<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
    <div id="map" style="width: 100%; height: 400px; margin: 30px auto 0 auto; max-width: 900px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inject properties data for use in external JS file
        window.propertiesData = <?php echo json_encode($data['properties']); ?>;
        // Inject URL root for API calls
        window.urlRoot = '<?php echo URLROOT; ?>';
    </script>
    <script src="<?php echo URLROOT; ?>/public/assets/js/auth-utils.js"></script>
    <script src="<?php echo URLROOT; ?>/public/assets/js/dashboard.js"></script>
</body>
</html>
