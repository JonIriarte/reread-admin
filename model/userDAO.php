<?php
class UserDao{
    private $pdo;

    public function __construct(){
        include 'connection.php';
        $this->pdo=$pdo;
    }

    public function login($email, $psswd){
        $query = "SELECT * FROM tbl_user WHERE email=? AND passwd=?";
        $sentencia=$this->pdo->prepare($query);
        $sentencia->bindParam(1,$email);
        $sentencia->bindParam(2,$psswd);
        $sentencia->execute();
        $result=$sentencia->fetch(PDO::FETCH_ASSOC);
        $numRow=$sentencia->rowCount();
        if(!empty($numRow) && $numRow==1){
            return true;
        }else {
            return false;
        }
    }
}

?>