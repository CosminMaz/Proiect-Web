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
    <style>
        .admin-section {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .admin-section h2 {
            margin-bottom: 15px;
            color: #000000;
            font-weight: bold;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table th, .admin-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #000000;
        }
        .admin-table th {
            background-color: #e9ecef;
            color: #000000;
            font-weight: bold;
        }
        .admin-table tr:hover {
            background-color: #f1f1f1;
        }
        .delete-btn {
            color: #ff0000;
            cursor: pointer;
            font-weight: bold;
        }
        .delete-btn:hover {
            color: #cc0000;
            text-decoration: underline;
        }
    </style>
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

        // OpenStreetMap + Leaflet map cu marcaje pentru proprietăți
        document.addEventListener('DOMContentLoaded', function() {
            var properties = <?php echo json_encode($data['properties']); ?>;
            var map;
            function addMarkers(map, properties) {
                properties.forEach(function(prop) {
                    if (prop.latitude && prop.longitude) {
                        L.marker([prop.latitude, prop.longitude]).addTo(map)
                            .bindPopup('<b>' + prop.title + '</b>');
                    }
                });
            }
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    map = L.map('map').setView([lat, lng], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);
                    L.marker([lat, lng]).addTo(map)
                        .bindPopup('Locația ta curentă').openPopup();
                    addMarkers(map, properties);
                }, function(error) {
                    map = L.map('map').setView([45.9432, 24.9668], 6); // România
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);
                    addMarkers(map, properties);
                });
            } else {
                map = L.map('map').setView([45.9432, 24.9668], 6); // România
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);
                addMarkers(map, properties);
            }
        });

        // Get users location when dashboard loads
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    console.log('%c Latitudine: ' + position.coords.latitude, 'color: #4CAF50; font-size: 14px; font-weight: bold;');
                    console.log('%c Longitudine: ' + position.coords.longitude, 'color: #4CAF50; font-size: 14px; font-weight: bold;');
                },
                function(error) {
                    console.error('Eroare la obținerea locației:', error.message);
                }
            );
        } else {
            console.log('Geolocation nu este suportat de acest browser.');
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
                localStorage.removeItem('token');
                localStorage.removeItem('jwt_token');
                document.cookie = 'token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                window.location.href = '<?php echo URLROOT; ?>/users/login';
            }
        });

        async function deleteProperty(propertyId) {
            if (confirm('Ești sigur că vrei să ștergi această proprietate?')) {
                try {
                    const response = await fetch('<?php echo URLROOT; ?>/properties/delete/' + propertyId, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer ' + token
                        }
                    });

                    const data = await response.json();
                    
                    if (data.status === 'success') {
                        alert('Proprietatea a fost ștersă cu succes.');
                        window.location.reload();
                    } else {
                        alert('Eroare la ștergerea proprietății: ' + data.message);
                    }
                } catch (error) {
                    console.error('Error deleting property:', error);
                    alert('Eroare la ștergerea proprietății. Verifică consola pentru detalii.');
                }
            }
        }
    </script>
</body>
</html>
