<?php

require_once("model/SellerDB.php");
require_once("ViewHelper.php");


class SellerController {
    
public static function showLoginSeller() {
    ViewHelper::render("view/seller/loginSeller.php");   
}
    
    public static function login(){
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = htmlspecialchars($_POST["password"]);
        $seller = SellerDB::loginSeller($email); 
        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");
        $cert_data = openssl_x509_parse($client_cert);
        $commonname = $cert_data["subject"]["emailAddress"];
        if($commonname != $email) { // preveri da se prodajalec res prijavi s svojim računom
            echo "prijavite se s svojim računom ";
            exit();
        }
        if (empty($seller)) {
            echo "prijava neuspešna";
        }
        else {
            if($seller[0]['active'] == 0) {
                echo 'vaš račun je deaktiviran kontaktirajte administratorja';
                exit();
            }
            $hash = $seller[0]["password"];
            if(password_verify($password, $hash)){
//                    echo "prijava uspešna";
                $_SESSION['Seller'] = $seller[0];
                ViewHelper::render("view/seller/profile.php");
            }
            else {
                echo "prijava neuspešna";
            }     

        }
    }
    
    public static function logout(){
        unset($_SESSION['Seller']);
        ViewHelper::redirect(BASE_URL . "store");
    }    
    
    public static function showProfilePage() {
        
        if(array_key_exists("Seller", $_SESSION) ) {
            ViewHelper::render("view/seller/profile.php");
        }
        else {
            ViewHelper::redirect(BASE_URL . "store");
        }
    }
    
    public static function update() {
        $id = $_SESSION['Seller']['idSeller'];
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
//        print_r($_SESSION['Customer']);
//        echo $id;
        
        $validData = isset($name) && !empty($name)&&
                isset($surname) && !empty($surname)&&
                isset($email) && !empty($email)&&
                isset($password) && !empty($password);
        
        if ($validData) {
            SellerDB::updateSeller($id, $name, $surname, $email, $password, 1);
            $seller = SellerDB::loginSeller($email);
            unset($_SESSION['Seller']);
            $_SESSION['Seller'] = $seller[0];
            ViewHelper::redirect(BASE_URL . "zavarovano/seller/profile");
        } else {
            echo 'napaka, izpolni vsa polja';
        }
    }
    
    public static function customerList() { 
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS);
        if (isset($id)) {
            $customer = CustomerDB::getCustomer($id);
//            var_dump($customer);
            ViewHelper::render("view/seller/customer-detail.php", ["customer" => $customer]);
//            ViewHelper::render("seller/customer-detail.php", ["book" => BookDB::get($id)]);
        } else {
            $customers = CustomerDB::getAll();
            ViewHelper::render("view/seller/customer-list.php", ["customers" => $customers]);
        }
    
    
    }
    
    public static function showCustomerAddForm($customer = []) {
        if(array_key_exists("Seller", $_SESSION)) {
            ViewHelper::render("view/seller/customer-add.php");
        }
        else {
            echo 'Nimate dostopa do te strani!';
        }
    }
    
    public static function addCustomer() {
        if(array_key_exists("Seller", $_SESSION)) {
            $street = filter_input(INPUT_POST, "street", FILTER_SANITIZE_SPECIAL_CHARS);
            $houseNumber = filter_input(INPUT_POST, "houseNumber", FILTER_SANITIZE_SPECIAL_CHARS);
            $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_SPECIAL_CHARS);
            $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_SPECIAL_CHARS);
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
            $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    //        $active = filter_input(INPUT_POST, "active", FILTER_SANITIZE_SPECIAL_CHARS);

    //        print_r($_SESSION['Customer']);
    //        echo $id;

            $validData = isset($street) && !empty($street) &&
                    isset($houseNumber) && !empty($houseNumber) &&
                    isset($post) && !empty($post) &&
                    isset($code) && !empty($code) &&
                    isset($name) && !empty($name)&&
                    isset($surname) && !empty($surname)&&
                    isset($email) && !empty($email)&&
                    isset($password) && !empty($password);
    //                isset($active) && !empty($active);

            if ($validData) {
                CustomerDB::createCustomer($name, $surname, $email, $password, $street, $houseNumber, $post, $code);
                ViewHelper::redirect(BASE_URL . "/zavarovano/seller/customer-list");
            } else {
                echo 'napaka izpolni vsa polja';
            }
        }
        else {
            echo 'Nimate dostopa do te strani!';
        }
    }
    
    public static function showCustomerEditForm($customer = []) {
        if (empty($customer)) {
            $customer = CustomerDB::getCustomer(filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS));
        }

        ViewHelper::render("view/seller/customer-edit.php", ["customer" => $customer]);
    }
    
    public static function editCustomer() {
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
        $idAddress = filter_input(INPUT_POST, "idAddress", FILTER_SANITIZE_SPECIAL_CHARS);
        $street = filter_input(INPUT_POST, "street", FILTER_SANITIZE_SPECIAL_CHARS);
        $houseNumber = filter_input(INPUT_POST, "houseNumber", FILTER_SANITIZE_SPECIAL_CHARS);
        $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_SPECIAL_CHARS);
        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $active = filter_input(INPUT_POST, "active", FILTER_SANITIZE_SPECIAL_CHARS);
        
//        print_r($_SESSION['Customer']);
//        echo $id;
        
        $validData = isset($street) && !empty($street) &&
                isset($houseNumber) && !empty($houseNumber) &&
                isset($post) && !empty($post) &&
                isset($code) && !empty($code) &&
                isset($name) && !empty($name)&&
                isset($surname) && !empty($surname)&&
                isset($email) && !empty($email)&&
                isset($password) && !empty($password)&&
                isset($active);
        
        if ($validData) {
            CustomerDB::updateCustomer($id, $name, $surname, $email, $password, $idAddress, $street, $houseNumber, $post, $code, $active);
//            $customer = CustomerDB::loginCustomer($email);
//            unset($_SESSION['Customer']);
//            $_SESSION['Customer'] = $customer[0];
            ViewHelper::redirect(BASE_URL . "/zavarovano/seller/customer-list");
        } else {
            echo 'napaka izpolni vsa polja';
        }
    }
    
}
