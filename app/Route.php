<?php
namespace demoRoute;
class Route
{
    public array $routes;
    public function __construct()
    {
        $this->routes = [];
    }
    // pt thêm 1 địa chỉ path vs hàm handler xử lý
    public function addRoute($path,$handler){
        $this->routes[$path] = $handler;
    }
    // pt lấy ra hàm hanlder đã thêm trc đó qua địa chỉ path
    public function getRoute($path){
        return $this->routes[$path];
    }
}