<?php
// Load the HTML template
$templatePath = __DIR__ . '/SearchPropertyTemplate.html';
$htmlContent = file_get_contents($templatePath);

// Replace placeholders with dynamic data
$htmlContent = str_replace('/TW/Proiect-Web', URLROOT, $htmlContent);

// Generate properties content
$propertiesContent = '';
if (isset($data['properties']) && !empty($data['properties'])) {
    foreach ($data['properties'] as $property) {
        $propertiesContent .= '<div class="property-card">';
        $propertiesContent .= '<img src="' . URLROOT . '/public/assets/photos/chirii/pexels-sami-aksu-48867324-10864449.jpg" alt="' . htmlspecialchars($property->title) . '" class="property-image">';
        $propertiesContent .= '<div class="property-info">';
        $propertiesContent .= '<span class="property-type">' . htmlspecialchars($property->status) . '</span>';
        $propertiesContent .= '<h3>' . htmlspecialchars($property->title) . '</h3>';
        $propertiesContent .= '<p><i class="fas fa-map-marker-alt"></i> ' . htmlspecialchars($property->latitude . ', ' . $property->longitude) . '</p>';
        $propertiesContent .= '<p><i class="fas fa-ruler-combined"></i> ' . htmlspecialchars($property->suprafata) . ' m²</p>';
        $propertiesContent .= '<p><i class="fas fa-phone"></i> ' . htmlspecialchars($property->contact) . '</p>';
        $propertiesContent .= '<p class="property-price">' . htmlspecialchars($property->price) . ' €</p>';
        if (!empty($property->facilities)) {
            $propertiesContent .= '<p><i class="fas fa-check-circle"></i> Facilități: ' . htmlspecialchars($property->facilities) . '</p>';
        }
        if (!empty($property->risks)) {
            $propertiesContent .= '<p><i class="fas fa-exclamation-triangle"></i> Riscuri: ' . htmlspecialchars($property->risks) . '</p>';
        }
        $propertiesContent .= '</div>';
        $propertiesContent .= '</div>';
    }
} else {
    $propertiesContent = '<p style="color: white; text-align: center; grid-column: 1 / -1;">Nu există proprietăți disponibile.</p>';
}
$htmlContent = str_replace('{PROPERTIES_CONTENT}', $propertiesContent, $htmlContent);

// Output the final HTML
echo $htmlContent;
?>
