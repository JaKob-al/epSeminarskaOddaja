<?php

require_once "DBInit.php";

class CustomerDB {
    public static function createCustomer($name, $surname, $email, $password, $street, $houseNumber, $post, $code) {
        $db = DBInit::getInstance();

        $statement1 = $db->prepare("INSERT INTO address (street, houseNumber, post, code) VALUES (:street, :houseNumber, :post, :code)");
        $statement1->bindParam(":street", $street);
        $statement1->bindParam(":houseNumber", $houseNumber);
        $statement1->bindParam(":post", $post);
        $statement1->bindParam(":code", $code);
        $statement1->execute();
        $id = $db->lastInsertId();
        
        $statement2 = $db->prepare("INSERT INTO customer (name, surname, email, password, address_idAddress) VALUES (:name, :surname, :email, :password, :address_idAddress)");
        $statement2->bindParam(":name", $name);
        $statement2->bindParam(":surname", $surname);
        $statement2->bindParam(":email", $email);
        $statement2->bindParam(":password", $password);
        $statement2->bindParam(":address_idAddress", $id);
        $statement2->execute();
        
    }
    
    public static function loginCustomer($email) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM customer WHERE email = :email");
        $statement->bindParam(":email", $email);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function updateCustomer($id, $name, $surname, $email, $password, $idAddress, $street, $houseNumber, $post, $code, $active) {
        $db = DBInit::getInstance();

        $statement1 = $db->prepare("UPDATE address SET street = :street, houseNumber = :houseNumber, post = :post, code = :code WHERE idAddress = :idAddress");
        $statement1->bindParam(":street", $street);
        $statement1->bindParam(":houseNumber", $houseNumber);
        $statement1->bindParam(":post", $post);
        $statement1->bindParam(":code", $code);
        $statement1->bindParam(":idAddress", $idAddress);
        $statement1->execute();
        
        $statement2 = $db->prepare("UPDATE customer SET name = :name, surname = :surname, email = :email, password = :password, active = :active WHERE idCustomer = :id");
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
        $statement = $db->prepare("SELECT * FROM customer");
        $statement->execute();
        return $statement->fetchAll();
    }
    
    public static function getAddress($id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM address WHERE idAddress = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        return $statement->fetch();
       
    }
    
    public static function getCustomer($id) {
        $db = DBInit::getInstance();
        $statement = $db->prepare("SELECT * FROM customer WHERE idCustomer = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
        $customer = $statement->fetch();
        
        $address = self::getAddress($customer["address_idAddress"]);
        $customer["address"] = $address;
        return $customer;
    }
    
}