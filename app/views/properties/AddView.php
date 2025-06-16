<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Proprietate - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .add-container {
            max-width: 800px;
            margin: 100px auto 40px;
            padding: 20px;
        }

        .add-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .add-header h1 {
            color: white;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .add-form {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #1d3557;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #457b9d;
            outline: none;
        }

        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .invalid-feedback {
            color: #e63946;
            font-size: 0.9rem;
            margin-top: 5px;
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

        .submit-btn {
            background: #457b9d;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
        }

        .submit-btn:hover {
            background: #1d3557;
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

    <div class="add-container">
        <div class="add-header">
            <h1>Adaugă Proprietate</h1>
            <a href="<?php echo URLROOT; ?>/dashboard" class="back-button">
                <i class="fas fa-arrow-left"></i> Înapoi la Dashboard
            </a>
        </div>

        <form action="<?php echo URLROOT; ?>/properties/add" method="POST" class="add-form">
            <div class="form-group">
                <label for="title">Titlu</label>
                <input type="text" name="title" id="title" class="<?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="description">Descriere</label>
                <textarea name="description" id="description"><?php echo $data['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Preț (€)</label>
                <input type="number" step="0.01" name="price" id="price" class="<?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
                <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="suprafata">Suprafață (m²)</label>
                <input type="number" name="suprafata" id="suprafata" class="<?php echo (!empty($data['suprafata_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['suprafata']; ?>">
                <span class="invalid-feedback"><?php echo $data['suprafata_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="latitude">Latitudine</label>
                <input type="number" step="any" name="latitude" id="latitude" class="<?php echo (!empty($data['latitude_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['latitude']; ?>">
                <span class="invalid-feedback"><?php echo $data['latitude_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="longitude">Longitudine</label>
                <input type="number" step="any" name="longitude" id="longitude" class="<?php echo (!empty($data['longitude_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['longitude']; ?>">
                <span class="invalid-feedback"><?php echo $data['longitude_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="contact">Date de Contact</label>
                <input type="text" name="contact" id="contact" class="<?php echo (!empty($data['contact_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['contact']; ?>">
                <span class="invalid-feedback"><?php echo $data['contact_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="<?php echo (!empty($data['status_err'])) ? 'is-invalid' : ''; ?>">
                    <option value="">Selectează statusul</option>
                    <option value="vanzare" <?php echo ($data['status'] == 'vanzare') ? 'selected' : ''; ?>>Vânzare</option>
                    <option value="inchiriere" <?php echo ($data['status'] == 'inchiriere') ? 'selected' : ''; ?>>Închiriere</option>
                </select>
                <span class="invalid-feedback"><?php echo $data['status_err']; ?></span>
            </div>

            <div class="form-group">
                <label for="facilities">Facilități</label>
                <textarea name="facilities" id="facilities" placeholder="Introduceți facilitățile, separate prin virgulă"><?php echo $data['facilities']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="risks">Riscuri</label>
                <textarea name="risks" id="risks" placeholder="Introduceți riscurile, separate prin virgulă"><?php echo $data['risks']; ?></textarea>
            </div>

            <button type="submit" class="submit-btn">Adaugă Proprietate</button>
        </form>
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