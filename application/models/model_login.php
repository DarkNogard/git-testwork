<?php

class Model_Login extends Model
{
    private $empTable = 'users';
    private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){
            $conn = new mysqli('localhost', 'root', '12345', 'test_work');
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }

    public function successLogin(){
        $sqlQuery = "SELECT login, password FROM ".$this->empTable."  where login = '".$_POST["login"]."' AND password = '".$_POST['password']."' ";

        $success = mysqli_fetch_assoc(mysqli_query($this->dbConnect, $sqlQuery));

        if($success['login']) {
            session_start();
            $_SESSION['login'] = $success['login'];
            return true;
        }
    }


}
