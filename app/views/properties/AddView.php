<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Proprietate - CAM Real Estate</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/css/add-property.css">
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
    // Inject URL root for API calls
    window.urlRoot = '<?php echo URLROOT; ?>';
</script>
<script src="<?php echo URLROOT; ?>/public/assets/js/auth-utils.js"></script>
<script src="<?php echo URLROOT; ?>/public/assets/js/add-property.js"></script>
</body>
</html>
