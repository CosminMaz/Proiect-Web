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
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/search-property.css">
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
    // Inject URL root for API calls
    window.urlRoot = '<?php echo URLROOT; ?>';
</script>
<script src="<?php echo URLROOT; ?>/public/assets/auth-utils.js"></script>
<script src="<?php echo URLROOT; ?>/public/assets/search-property.js"></script>
</body>
</html>
