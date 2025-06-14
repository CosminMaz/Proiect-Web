<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CAM Real Estate</title>
        <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/assets/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <header id="navbar">
            <div class="logo">CAM Real Estate</div>
            <nav>
                <ul>
                    <li><a href="<?php echo URLROOT; ?>/users/login">Loghează-te</a></li>
                </ul>
            </nav>
        </header>

        <section class="hero">
            <h1>Locuința ta de vis te așteaptă</h1>
            <p>Descoperă cele mai bune proprietăți din oraș, cu filtre inteligente și o hartă interactivă modernă.</p>
            <a href="<?php echo URLROOT; ?>/users/login">Explorează acum</a>
        </section>

        <section class="apartments">
            <h2 class="titlu-chirii">Chirii disponibile</h2>
            <div class="apartment-list">
                <div class="apartment-card">
                    <img src="<?php echo URLROOT; ?>/public/assets/photos/chirii/pexels-sami-aksu-48867324-10864449.jpg" alt="apartament">
                    <h3>Garsonieră Modernă</h3>
                    <p>Zona Centrală • 35 m² • 450 €/lună</p>
                    <button>Vezi detalii</button>
                </div>
                <div class="apartment-card">
                    <img src="<?php echo URLROOT; ?>/public/assets/photos/chirii/pexels-tima-miroshnichenko-6827340.jpg" alt="apartment">
                    <h3>2 Camere Luminoase</h3>
                    <p>Cartier Verde • 60 m² • 600 €/lună</p>
                    <button>Vezi detalii</button>
                </div>
                <div class="apartment-card">
                    <img src="<?php echo URLROOT; ?>/public/assets/photos/chirii/pexels-sami-aksu-48867324-10864449.jpg" alt="apartament">
                    <h3>Studio Elegant</h3>
                    <p>Zona Universitate • 28 m² • 400 €/lună</p>
                    <button>Vezi detalii</button>
                </div>

                <div class="apartment-card">
                    <img src="<?php echo URLROOT; ?>/public/assets/photos/chirii/pexels-tima-miroshnichenko-6827340.jpg" alt="apartament">
                    <h3>3 Camere Mobilate</h3>
                    <p>Tineretului • 80 m² • 750 €/lună</p>
                    <button>Vezi detalii</button>
                </div>

                <div class="apartment-card">
                    <img src="<?php echo URLROOT; ?>/public/assets/photos/chirii/pexels-andrew-7932264.jpg" alt="apartament">
                    <h3>Duplex Spațios</h3>
                    <p>Zona Nord • 120 m² • 1.200 €/lună</p>
                    <button>Vezi detalii</button>
                </div>

                <div class="apartment-card">
                    <img src="<?php echo URLROOT; ?>/public/assets/photos/chirii/pexels-arina-krasnikova-5712530.jpg" alt="apartament">
                    <h3>Loft cu Terasă</h3>
                    <p>Floreasca • 95 m² • 950 €/lună</p>
                    <button>Vezi detalii</button>
                </div>
            </div>
        </section>

        <footer class="site-footer">
            <div class="footer-container">
                <div class="footer-logo">
                    <h2>CAM Real Estate</h2>
                    <p>Găsește locuința ideală, rapid și sigur.</p>
                </div>
                <div class="footer-links">
                    <h3>Linkuri rapide</h3>
                    <ul>
                        <li><a href="<?php echo URLROOT; ?>">Acasă</a></li>
                        <li><a href="<?php echo URLROOT; ?>/properties/apartments">Apartamente</a></li>
                        <li><a href="<?php echo URLROOT; ?>/properties/houses">Case</a></li>
                        <li><a href="<?php echo URLROOT; ?>/pages/contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Contact</h3>
                    <p>📞 0784 265 890</p>
                    <p>📧 cosmin.mazilu15@gmail.com</p>
                </div>
                <div class="footer-social">
                    <h3>Urmărește-ne</h3>
                    <div class="social-icons">
                        <a href="#"><img src="<?php echo URLROOT; ?>/public/assets/icons/facebook-circle.svg" alt="Facebook"></a>
                        <a href="#"><img src="<?php echo URLROOT; ?>/public/assets/icons/iconmonstr-instagram-11.svg" alt="Instagram"></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 CAM Real Estate. Toate drepturile rezervate.</p>
            </div>
        </footer>

        <script src="<?php echo URLROOT; ?>/public/assets/script.js"></script>
    </body>
</html> 