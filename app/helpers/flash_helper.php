<?php
// Această funcție nu mai folosește sesiuni. Recomandare: gestionează flash messages pe frontend sau cu query params.
function flash($name = '', $message = '', $class = 'alert alert-success') {
    // Poți elimina această funcție sau o poți adapta pentru a returna direct mesajul, fără sesiuni.
    if (!empty($name) && !empty($message)) {
        echo '<div class="' . $class . '" id="msg-flash">' . $message . '</div>';
    }
}