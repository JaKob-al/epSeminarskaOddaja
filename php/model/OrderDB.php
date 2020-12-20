<?php

require_once "DBInit.php";

class OrderDB {
    public static function getNew() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM finalorder WHERE "
                . "status = '0'");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function getProcessed() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM finalorder WHERE "
                . "status = '1' OR status = '2' OR status= '3'");
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function getHistory($customerId) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM finalorder WHERE "
                . "customer_idCustomer = :customerId");
        $statement->bindParam(":customerId", $customerId, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function getFullOrder($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM orders WHERE finalorder_orderID = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
    
    public static function changeStatus($id, $status) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("UPDATE finalorder SET status = :status WHERE orderID = :id");
        $statement->bindParam(":status", $status);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }
    
    public static function insertFinalOrder($status, $total, $customerID) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO finalorder (status, total, customer_idCustomer)
            VALUES (:status, :total, :customerID)");
        $statement->bindParam(":status", $status);
        $statement->bindParam(":total", $total);
        $statement->bindParam(":customerID", $customerID);
        $statement->execute();

        $test = $db->lastInsertId();
        return $test;
    }
    
    public static function insertDetails($book_id, $quantity, $finalorderID) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO orders (book_id, quantity, finalorder_orderID)
            VALUES (:book_id, :quantity, :finalorderID)");
        $statement->bindParam(":book_id", $book_id);
        $statement->bindParam(":quantity", $quantity);
        $statement->bindParam(":finalorderID", $finalorderID);
        $statement->execute();
    }
}

