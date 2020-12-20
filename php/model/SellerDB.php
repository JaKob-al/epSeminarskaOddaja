<?php

require_once "DBInit.php";


class SellerDB {
    
    public static function loginSeller($email) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM seller WHERE email = :email");
        $statement->bindParam(":email", $email);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    
//  PRIDOBI VSE VELJAVNE EMAIL NASLOVE PRODAJALCEV ZA VERIFIKACIJO
    public static function getSellersEmail() {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM seller");
        $statement->execute();
        $sellers = $statement->fetchAll();
//        print_r($sellers);
        $emails = array();
        $nSellers =  count($sellers);
        for ($i = 0; $i<$nSellers; $i++) {
            array_push($emails, $sellers[$i]["email"]);
        }
//        print_r($emails);
        return $emails;
        
    }
    
    public static function insert($name, $surname, $email, $password, $active) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO seller (name, surname, email, password, active)
            VALUES (:name, :surname, :email, :password, :active)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":surname", $surname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":password", $password);
        $statement->bindParam(":active", $active);
        $statement->execute();
    }
    
    public static function updateSeller($id, $name, $surname, $email, $password, $active) {
        $db = DBInit::getInstance();
        
        $statement2 = $db->prepare("UPDATE seller SET name = :name, surname = :surname, email = :email, password = :password, active = :active WHERE idSeller = :id");
        $statement2->bindParam(":name", $name);
        $statement2->bindParam(":surname", $surname);
        $statement2->bindParam(":email", $email);
        $statement2->bindParam(":password", $password);
        $statement2->bindParam(":active", $active);
        $statement2->bindParam(":id", $id);
        $statement2->execute();
        
    }
    
    public static function getAll() {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM seller");
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function getSeller($id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM seller WHERE idSeller = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch();
    }
    
}