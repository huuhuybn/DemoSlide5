<?php

namespace demoRoute;
require './app/DBConnection.php';

class UserControllers
{
    public static function showLogin(){
        // hien thi form login
        echo '<form action="index.php?url=login" method="post" enctype="application/x-www-form-urlencoded">
<input name="username" placeholder="Nhap username..." type="text" required>
<input name="password" placeholder="Nhap password" type="password" required>
<button type="submit">Login</button>
</form>';
    }
    public static function login(){
        // xu ly viec login
        $username = $_POST['username'];
        $password = $_POST['password'];
        // mo ket noi , query username. ....
        $sql = 'Select * from users where username = ?';
        $db = new DBConnection();
        $connect = $db->connect();
        $stmp = $connect->prepare($sql);
        $stmp->bind_param('s',$username);// them gia tri username cho dau ?
        $stmp->execute(); // truy van
        // check ket qua tra ve
        $result = $stmp->get_result();
        if ($result->num_rows >0){
            $row = $result->fetch_assoc();
            if ($row['password'] == $password){
                echo 'Login Thanh Cong !!!!!';
            }
        }else {
            echo 'Username hoac password khong dung !!!!';
        }
    }
    public static function showRegister(){
       // hien thi form dang ki
    }
    public static function register(){
        // dang ki vao he thong, ket noi mySql
    }


}