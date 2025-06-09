<!--
This is the entry point of the application.
It loads the configuration, helpers, core classes, and initializes the application.
-->
<?php
require_once 'app/config/config.php';
require_once 'app/helpers/session_helper.php';
require_once 'app/core/App.php';
require_once 'app/core/Controller.php';
require_once 'app/core/Database.php';

// Initialize the application
$app = new App(); 