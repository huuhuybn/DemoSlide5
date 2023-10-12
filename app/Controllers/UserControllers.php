<?php

namespace Huuhuy\DemoSlide5;
require './app/DBConnection.php';

//require './app/BladeConfig.php';


class UserControllers
{
    public static function showLogin()
    {
//        if (isset($_GET['error'])) {
//            echo 'Vui long nhap Username hoac password';
//        }
        if (isset($_GET['error'])) {
            echo 'Vui long nhap Username hoac password';
        }
        //  data chua các cặp giá trị key và value
        // cần hiển thị trong file login.blade.php
        $arr = [3, 5, 6, 4, 3, 4, 6, 78, 5];
        $data = ['name' => 'Huy Nguyen',
            'address' => 'HN - TRUNG VAN',
            'diem' => 10,
            'isPass' => true,
            'arr' => $arr
        ];
        include './app/BladeConfig.php';

        echo $blade->run('login', $data);
        // cu phap bladeone : for, foreach, if else, switchcase

        //ob_start();
        //include './app/Views/login.blade.php';
        //echo ob_get_clean();
        // hien thi form login
//        echo '<form action="index.php?url=login" method="post" enctype="application/x-www-form-urlencoded">
//        <input name="username" placeholder="Nhap username..." type="text" >
//        <input name="password" placeholder="Nhap password" type="password" >
//        <button type="submit">Login</button>
//        </form>';

    }

    public static function login()
    {
        // xu ly viec login
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            // mở file index.php với tham số đi kèm
            header("location:index.php?url=showLogin&error=empty");
            return;
        }

//        if (empty($username) || empty($password)) {
//            header("location:index.php?url=showLogin&error=empty");
//            return;
//        }
        // mo ket noi , query username. ....
        $sql = 'Select * from users where username = :username';
        $db = new DBConnection();
        $conn = $db->connect();
        $stmp = $conn->prepare($sql);
        $stmp->bindParam(":username", $username);
        $stmp->execute();
        $row = $stmp->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            if ($password === $row['password']) {
                $_SESSION['username'] = $username;
                echo "Login Thanh Cong . " . " Xin chao " . $row['username'];
            }
        } else {
            echo "Login KHONG Thanh Cong . ";
        }

    }

    public static function showRegister()
    {
        // hien thi form dang ki
        echo '<form action="index.php?url=createUser" method="post"
 enctype="application/x-www-form-urlencoded">
<input name="username" placeholder="Nhap username..." type="text" >
<input name="password" placeholder="Nhap password" type="password" >
<button type="submit">Register</button>
</form>';
    }

    public static function register()
    {
        // dang ki vao he thong, ket noi mySql
        // xu ly viec login
        $username = $_POST['username'];
        $password = $_POST['password'];
        // mo ket noi , query username. ....
        $sql = 'insert into users (username,password) values (? , ?)';
        $db = new DBConnection();
        $connect = $db->connect();
        $stmp = $connect->prepare($sql);
        $stmp->bind_param('ss', $username, $password);
        if ($stmp->execute()) {
            echo 'Dang ki thanh cong!!';
            $stmp->close();
        } else {
            echo 'Co loi xay ra, vui long kiem tra lai. 
            hoac chon username khac!!! : ' . $stmp->error;
        }
    }

    public static function logout()
    {
        session_start();
        // clear session
        unset($_SESSION['username']); // xoa username khoi phien
        session_destroy(); // destroy
        // ket thuc phien dang nhap
        echo 'Hen gap lai lan sau !!!!';
    }


}