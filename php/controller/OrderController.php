<?php

require_once("model/OrderDB.php");
require_once("ViewHelper.php");

class OrderController {
    
    public static function showNewOrders() {
        if (array_key_exists("Seller", $_SESSION)) {
            $allorders = OrderDB::getNew();
            if(!empty($allorders)) {
                foreach ($allorders as $key => $order) {
                    $details = OrderDB::getFullOrder($order["orderID"]);

                    foreach ($details as $keyDetail => $detail) {
    //                    var_dump($detail);
                        $bookDetails = BookDB::get($detail["book_id"]);

                        $detail["title"] = $bookDetails["title"];
                        $detail["author"] = $bookDetails["author"];
                        $detail["price"] = $bookDetails["price"] * $detail["quantity"];
    //                  
                      $details[$keyDetail] = $detail;
    //                    var_dump($detail);
                    }
    //                var_dump($details);
                    $allorders[$key]["details"] = $details;
                }
                ViewHelper::render("view/orders.php", ["orders" => $allorders, "noNewOrders" => false]);
            }
            else {
                ViewHelper::render("view/orders.php", ["orders" => [], "noNewOrders" => true]);
            }
        }
        else {
            echo 'Nimate dostopa do te strani!';
        }
    }
    
    public static function showProcessedOrders() {
        if (array_key_exists("Seller", $_SESSION)) {
            $allorders = OrderDB::getProcessed();
            if(!empty($allorders)) {
                foreach ($allorders as $key => $order) {
                    $details = OrderDB::getFullOrder($order["orderID"]);

                    foreach ($details as $keyDetail => $detail) {
    //                    var_dump($detail);
                        $bookDetails = BookDB::get($detail["book_id"]);

                        $detail["title"] = $bookDetails["title"];
                        $detail["author"] = $bookDetails["author"];
                        $detail["price"] = $bookDetails["price"] * $detail["quantity"];
    //                  
                      $details[$keyDetail] = $detail;
    //                    var_dump($detail);
                    }
    //                var_dump($details);
                    $allorders[$key]["details"] = $details;
                }
                ViewHelper::render("view/ordersProcessed.php", ["orders" => $allorders, "noNewOrders" => false]);
            }
            else {
                ViewHelper::render("view/ordersProcessed.php", ["orders" => [], "noNewOrders" => true]);
            }
        }
        
        else {
            echo 'Nimate dostopa do te strani!';
        }
    }
    
    public static function showOrderHistory() {
        if(array_key_exists("Customer", $_SESSION)) {
            $customerID = $_SESSION['Customer']['idCustomer'];

            $allorders = OrderDB::getHistory($customerID); 

            if(!empty($allorders)) {
                foreach ($allorders as $key => $order) {
                    $details = OrderDB::getFullOrder($order["orderID"]);

                    foreach ($details as $keyDetail => $detail) {
    //                    var_dump($detail);
                        $bookDetails = BookDB::get($detail["book_id"]);

                        $detail["title"] = $bookDetails["title"];
                        $detail["author"] = $bookDetails["author"];
                        $detail["price"] = $bookDetails["price"] * $detail["quantity"];
    //                  
                      $details[$keyDetail] = $detail;
    //                    var_dump($detail);
                    }
    //                var_dump($details);
                    $allorders[$key]["details"] = $details;
                }
                ViewHelper::render("view/order-history.php", ["orders" => $allorders, "noNewOrders" => false]);
            }
            else {
                ViewHelper::render("view/order-history.php", ["orders" => [], "noNewOrders" => true]);
            }
        }
        else {
            echo 'Nimate dostopa do te strani!';
        }
    }
    
    public static function changeStatus() {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
            $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_SPECIAL_CHARS);
            $validData = isset($id) && !empty($id) &&
                    isset($status) && !empty($status);
                    
            echo $id;
            if ($validData) {
                OrderDB::changeStatus($id, $status);
                if ($status == 3) {
                    ViewHelper::redirect(BASE_URL . "zavarovano/seller/orders/processed");
                }
                else {
                    ViewHelper::redirect(BASE_URL . "zavarovano/seller/orders");
                }
            } else {
                self::showOrders();
            }
        }

}


