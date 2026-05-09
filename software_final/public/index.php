<?php
require_once '../config/config.php';
require_once '../config/db.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/':
    case '/login':
        require_once '../app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
    case '/logout':
        require_once '../app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;
    case '/dashboard':
        require_once '../app/controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
    case '/donate':
        require_once '../app/controllers/DonationController.php';
        $controller = new DonationController();
        $controller->showForm();
        break;
    case '/activities':
        require_once '../app/controllers/ActivityController.php';
        $controller = new ActivityController();
        $controller->manage();
        break;
    default:
        echo '404 Not Found';
        break;
}
?>