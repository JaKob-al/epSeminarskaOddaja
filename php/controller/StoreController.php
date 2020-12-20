<?php

require_once("model/BookDB.php");
require_once("model/Cart.php");
require_once("ViewHelper.php");

class StoreController {

    public static function index() {
        $vars = [
            "books" => BookDB::getAll(),
            "cart" => Cart::getAll(),
            "total" => Cart::total()
        ];

        ViewHelper::render("view/store-index.php", $vars);
    }

    public static function addToCart() {
        $id = isset($_POST["id"]) ? intval($_POST["id"]) : null;

        if ($id !== null) {
            Cart::add($id);
        }

        ViewHelper::redirect(BASE_URL . "store");
    }

    public static function updateCart() {
        $id = (isset($_POST["id"])) ? intval($_POST["id"]) : null;
        $quantity = (isset($_POST["quantity"])) ? intval($_POST["quantity"]) : null;

        if ($id !== null && $quantity !== null) {
            Cart::update($id, $quantity);
        }

        ViewHelper::redirect(BASE_URL . "store");
    }

    public static function purgeCart() {
        Cart::purge();

        ViewHelper::redirect(BASE_URL . "store");
    }
    
    public static function orderPreview() {
        $cart = Cart::getAll();
        $total = Cart::total();
        
        ViewHelper::render("view/orderComplete.php", ["cart" => $cart, "total" => $total]);
    }
    
    public static function sendOrder() {
        if(array_key_exists("Customer", $_SESSION)) {
            $cart = Cart::getAll();
            $total = Cart::total();

            //get customer id from session
            $customerID = $_SESSION['Customer']['idCustomer'];

            $finalorderID = OrderDB::insertFinalOrder(0, $total, $customerID);

            foreach ($cart as &$element) {
                OrderDB::insertDetails($element["id"], $element["quantity"], $finalorderID);
            }
            unset($element);


    //        ViewHelper::render("view/orderComplete.php", ["cart" => $cart, "total" => $total]);
            Cart::purge();
            ViewHelper::redirect(BASE_URL . "/zavarovano/customer/order-history");
            //self::purgeCart();
    //        ViewHelper::redirect(BASE_URL . "store");
        }
        else {
            echo 'Nimate dostopa do te strani! Za oddajo naročila se prijavite ali registrirajte';
        }
    }

}
