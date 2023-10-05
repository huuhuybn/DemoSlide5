<?php

namespace Huuhuy\DemoSlide5;
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
                // luu lai phien dang nhap cua username
                $_SESSION['username'] = $username;
                echo 'Login Thanh Cong !!!!! Xin chao :  '. $username;
            }
        }else {
            echo 'Username hoac password khong dung !!!!';
        }
    }
    public static function showRegister(){
       // hien thi form dang ki
        echo '<form action="index.php?url=createUser" method="post"
 enctype="application/x-www-form-urlencoded">
<input name="username" placeholder="Nhap username..." type="text" required>
<input name="password" placeholder="Nhap password" type="password" required>
<button type="submit">Register</button>
</form>';
    }
    public static function register(){
        // dang ki vao he thong, ket noi mySql
        // xu ly viec login
        $username = $_POST['username'];
        $password = $_POST['password'];
        // mo ket noi , query username. ....
        $sql = 'insert into users (username,password) values (? , ?)';
        $db = new DBConnection();
        $connect = $db->connect();
        $stmp = $connect->prepare($sql);
        $stmp->bind_param('ss',$username,$password);
        if ($stmp->execute()){
            echo 'Dang ki thanh cong!!';
            $stmp->close();
        }else{
            echo 'Co loi xay ra, vui long kiem tra lai. 
            hoac chon username khac!!! : '. $stmp->error;
        }
    }

    public static function logout(){
      // clear session
        unset($_SESSION['username']); // xoa username khoi phien
        session_destroy(); // destroy
        // ket thuc phien dang nhap
        echo 'Hen gap lai lan sau !!!!';
    }


}