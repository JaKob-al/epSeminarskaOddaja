<?php

require_once "DBInit.php";


class AdminDB {
    
    public static function loginAdmin($email) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM admin WHERE email = :email");
        $statement->bindParam(":email", $email);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function getAdminsEmail() {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM admin");
        $statement->execute();
        $admin = $statement->fetchAll();
        return $admin[0]["email"];
    }
    
    public static function updateAdmin($id, $name, $surname, $email, $password) {
        $db = DBInit::getInstance();
        
        $statement2 = $db->prepare("UPDATE admin SET name = :name, surname = :surname, email = :email, password = :password WHERE idAdmin = :id");
        $statement2->bindParam(":name", $name);
        $statement2->bindParam(":surname", $surname);
        $statement2->bindParam(":email", $email);
        $statement2->bindParam(":password", $password);
        $statement2->bindParam(":id", $id);
        $statement2->execute();
        
    }
}