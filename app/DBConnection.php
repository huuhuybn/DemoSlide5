<?php

namespace demoRoute;

class DBConnection
{
    private $connection;

    public function connect(){
        $host = 'sql.freedb.tech';
        $databasename ='freedb_fpolyhn';
        $username = 'freedb_underroot';
        $password = '26Ke2xWThh4R$WJ';
        $this->connection = new \mysqli($host,$username,$password,$databasename);
        if ($this->connection->connect_error){
            die('Loi ket noi co so du lieu');
        }
        return $this->connection;
    }
}