<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/admin-dashboard.css">
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
        <div class="greeting">Salutare, Admin <?php echo isset($data['user']->nume) ? htmlspecialchars($data['user']->nume) : 'Utilizator'; ?></div>
        
        <div class="dashboard-actions">
            <a href="<?php echo URLROOT; ?>/properties/add" class="action-button">
                <i class="fas fa-plus"></i> Adaugă Proprietate
            </a>
            <a href="<?php echo URLROOT; ?>/properties/search" class="action-button">
                <i class="fas fa-search"></i> Caută Proprietăți
            </a>
            <a href="<?php echo URLROOT; ?>/properties/export/xml" class="action-button">
                <i class="fas fa-file-export"></i> Exportă Proprietăți XML
            </a>
        </div>
        
        <!-- Admin Sections -->
        <div class="admin-section">
            <h2>Gestionează Proprietăți</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titlu</th>
                        <th>Descriere</th>
                        <th>Acțiune</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['properties'] as $property): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($property->id); ?></td>
                        <td><?php echo htmlspecialchars($property->title); ?></td>
                        <td><?php echo htmlspecialchars(substr($property->description, 0, 50)) . (strlen($property->description) > 50 ? '...' : ''); ?></td>
                        <td>
                            <button style="background:none; border:none; color:#ff0000; cursor:pointer; font-size:14px;" onclick="deleteProperty(<?php echo $property->id; ?>)">Șterge</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="admin-section">
            <h2>Utilizatori Înregistrați</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['users'] as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->id); ?></td>
                        <td><?php echo htmlspecialchars($user->nume . ' ' . $user->prenume); ?></td>
                        <td><?php echo htmlspecialchars($user->email); ?></td>
                        <td><?php echo htmlspecialchars($user->role); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="map" style="width: 100%; height: 400px; margin: 30px auto 0 auto; max-width: 900px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);;"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Inject properties data for use in external JS file
        window.propertiesData = <?php echo json_encode($data['properties']); ?>;
        // Inject URL root for API calls
        window.urlRoot = '<?php echo URLROOT; ?>';
    </script>
    <script src="<?php echo URLROOT; ?>/public/assets/admin-dashboard.js"></script>
</body>
</html>
