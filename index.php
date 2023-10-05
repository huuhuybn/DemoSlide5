<html>
<head>
    <title>My Fpoly Page</title>
</head>
<body>
<h1>My Fpoly Page</h1>
<a href="index.php">Home</a>
<a href="index.php?url=news">News</a>
<a href="index.php?url=category">Category</a>
<a href="index.php?url=uploadForm">Upload Form</a>
<a href="index.php?url=showLogin">Login</a>
<a href="index.php?url=register">Register</a>
<a href="index.php?url=logout">Log Out</a>
<hr>
<?php
// viet dieu huong noi dung website bang cach kiem tra if else
require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Huuhuy\DemoSlide5\UserControllers;
use Huuhuy\DemoSlide5\HomeControllers;
use Huuhuy\DemoSlide5\NewControllers;
use Huuhuy\DemoSlide5\CatControllers;
use Huuhuy\DemoSlide5\UploadControllers;
use Huuhuy\DemoSlide5\Route;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load(); // nap file .env vao superglobal $_ENV!!
//var_dump($_ENV);

if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else $url = '/';

echo 'Address: ' . $url . '<br>'; // in ra tham so url
$route = new Route();
$route->addRoute('/', [HomeControllers::class, 'show']);
$route->addRoute('news', [NewControllers::class, 'show']);
$route->addRoute('category', [CatControllers::class, 'show']);
// khai báo 2 route xử lý hiển thị form upload
// và nhận file để lưu vào thư mục uploads
$route->addRoute('uploadForm', [UploadControllers::class, 'show']);
$route->addRoute('createFile', [UploadControllers::class, 'createFile']);
$route->addRoute('showLogin', [UserControllers::class, 'showLogin']);
$route->addRoute('login', [UserControllers::class, 'login']);
$route->addRoute('register', [UserControllers::class, 'showRegister']);
$route->addRoute('createUser', [UserControllers::class, 'register']);
$route->addRoute('logout', [UserControllers::class, 'logout']);
// lay ra hàm trc đó đã thêm trong route
$handler = $route->getRoute($url);
call_user_func($handler); // thuc thi handler bang call_user_func
?>
</body>
</html>
<?php
// Route trong php - mvc
// Route Là điều hướng trong website
// vnexpress.net/giai-tri
// vnexpress.net/xe-co
// 1. Thủ công , t tự xây dựng 1 code điều hướng cho website