<?php

//require_once './user.php';
//DAO=Data Access Object. En los DAO se hacen las querys. 
class UserDao{
    //PDO=PHP Data Objects. 
    private $pdo;

    public function __construct(){
        include 'connection.php';
        $this->pdo=$pdo;
    }
    public function login($user){
        $query = "SELECT * FROM users WHERE Email=? AND Pass=?";
        $sentencia=$this->pdo->prepare($query);
        $email=$user->getEmail(); 
        $psswd=$user->getPassword(); 
        $sentencia->bindParam(1,$email);
        $sentencia->bindParam(2,$psswd);
        $sentencia->execute();
        $result=$sentencia->fetch(PDO::FETCH_ASSOC);
        $numRow=$sentencia->rowCount();
        if(!empty($numRow) && $numRow==1){
            $user->setName($result['Name']);
            $user->setId_user($result['Id']);  
            //Creamos sesión
            session_start(); 
            //Se le asigna a
            $_SESSION['user']=$user;  
            return true;
        }else {
            return false;
        }
    }
}

?>