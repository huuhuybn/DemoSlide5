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
use demoRoute\UserControllers;

require './app/Route.php';
require './app/Controllers/HomeControllers.php';
require './app/Controllers/NewControllers.php';
require './app/Controllers/CatControllers.php';
require './app/Controllers/UploadControllers.php';
require './app/Controllers/UserControllers.php';

if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else $url = '/';
echo 'Address: ' . $url . '<br>'; // in ra tham so url
$route = new demoRoute\Route();
$route->addRoute('/', [HomeControllers::class, 'show']);
$route->addRoute('news', [NewControllers::class, 'show']);
$route->addRoute('category', [demoRoute\CatControllers::class, 'show']);
// khai báo 2 route xử lý hiển thị form upload
// và nhận file để lưu vào thư mục uploads
$route->addRoute('uploadForm',[\demoRoute\UploadControllers::class,'show']);
$route->addRoute('createFile',[\demoRoute\UploadControllers::class,'createFile']);
$route->addRoute('showLogin',[UserControllers::class,'showLogin']);
$route->addRoute('login',[UserControllers::class,'login']);
$route->addRoute('register',[UserControllers::class,'showRegister']);
$route->addRoute('createUser',[UserControllers::class,'register']);
$route->addRoute('logout',[UserControllers::class,'logout']);
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