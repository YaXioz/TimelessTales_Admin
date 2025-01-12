<?php
session_start();
require_once 'config/config.php';
require "vendor/autoload.php";
require_once 'Router.php';
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/TimelineController.php';
require_once 'controllers/PostController.php';
require_once 'controllers/LoginController.php';

// Buat koneksi database
// $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// if ($conn->connect_error) {
//     die("Koneksi gagal: " . $conn->connect_error);
// }

$conn = new PHPSupabase\Service(
    SUPABASE_KEY,
    SUPABASE_URL
);

// Inisialisasi router
$router = new Router();

// Definisikan rute
$router->addRoute('dashboard', 'DashboardController', 'index');
$router->addRoute('users', 'UserController', 'index');
$router->addRoute('users/add', 'UserController', 'add');
$router->addRoute('users/edit', 'UserController', 'edit');
$router->addRoute('users/delete', 'UserController', 'delete');
$router->addRoute('timelines', 'TimelineController', 'index');
$router->addRoute('timelines/add', 'TimelineController', 'add');
$router->addRoute('timelines/edit', 'TimelineController', 'edit');
$router->addRoute('timelines/delete', 'TimelineController', 'delete');
$router->addRoute('posts', 'PostController', 'index');
$router->addRoute('posts/add', 'PostController', 'add');
$router->addRoute('posts/edit', 'PostController', 'edit');
$router->addRoute('posts/delete', 'PostController', 'delete');
$router->addRoute('login', 'LoginController', 'login');
$router->addRoute('logout', 'LoginController', 'logout');

// Ambil URL dari query string
$url = isset($_GET['url']) ? $_GET['url'] : '';

// Route ke controller yang sesuai
$route = $router->route($url);
// return var_dump($_GET['url']);
// return var_dump($route);


if ($route) {
    $controllerName = $route['controller'];
    $methodName = $route['params'][0] ?? $route['method'];
    $params[0] = $route['params'][1] ?? [];

    $controller = new $controllerName($conn);

    // Periksa apakah user sudah login (kecuali untuk halaman login)
    if ($controllerName != 'LoginController' && $methodName != 'login' && !isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    call_user_func_array([$controller, $methodName], $params);
} else {
    // 404 Not Found
    echo "404 Not Found";
}

// Tutup koneksi database
// $conn->close();
