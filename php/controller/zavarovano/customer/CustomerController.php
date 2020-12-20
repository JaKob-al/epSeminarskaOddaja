<?php

require_once("model/CustomerDB.php");
require_once("ViewHelper.php");

class CustomerController {
    
    public static function showCustomerPage(){
        ViewHelper::render("view/customer/customerLogin.php");
    }

    public static function register() {
        $street = filter_input(INPUT_POST, "street", FILTER_SANITIZE_SPECIAL_CHARS);
        $houseNumber = filter_input(INPUT_POST, "houseNumber", FILTER_SANITIZE_SPECIAL_CHARS);
        $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_SPECIAL_CHARS);
        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
        
        
        $validData = isset($street) && !empty($street) &&
                isset($houseNumber) && !empty($houseNumber) &&
                isset($post) && !empty($post) &&
                isset($code) && !empty($code) &&
                isset($name) && !empty($name)&&
                isset($surname) && !empty($surname)&&
                isset($email) && !empty($email)&&
                isset($password) && !empty($password);
        
        if ($validData) {
            CustomerDB::createCustomer($name, $surname, $email, $password, $street, $houseNumber, $post, $code);
            ViewHelper::redirect(BASE_URL . "store");
        } else {
            echo "izpolnite vsa polja";
//            self::showCustomerPage(filter_input_array(INPUT_POST));
        }
    }
    
    public static function update() {
        $id = $_SESSION['Customer']['idCustomer'];
        $idAddress = $_SESSION['Customer']['address_idAddress'];
        $street = filter_input(INPUT_POST, "street", FILTER_SANITIZE_SPECIAL_CHARS);
        $houseNumber = filter_input(INPUT_POST, "houseNumber", FILTER_SANITIZE_SPECIAL_CHARS);
        $post = filter_input(INPUT_POST, "post", FILTER_SANITIZE_SPECIAL_CHARS);
        $code = filter_input(INPUT_POST, "code", FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        
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
        
        if ($validData) {
            CustomerDB::updateCustomer($id, $name, $surname, $email, $password, $idAddress, $street, $houseNumber, $post, $code, 1);
            $customer = CustomerDB::loginCustomer($email);
            unset($_SESSION['Customer']);
            $_SESSION['Customer'] = $customer[0];
            ViewHelper::render("view/customer/profile.php");
        } else {
            echo 'napaka izpolni vsa polja';
        }
    }

    public static function login(){
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = htmlspecialchars($_POST["password"]);
        
        $customer = CustomerDB::loginCustomer($email);
        $hash = $customer[0]["password"];
        if($customer[0]["active"] == 0) {
            echo 'Vaš račun je deaktiviran. Kontaktirajte prodajalca oz. administratorja';
            exit();
        }
        if(password_verify($password, $hash)){
//            echo "prijava uspešna";
            $_SESSION['Customer'] = $customer[0];
            ViewHelper::render("view/customer/profile.php");
        }
        else {
            echo "prijava neuspešna";
        }
    }
    
    public static function logout(){
        unset($_SESSION['Customer']);
        ViewHelper::redirect(BASE_URL . "store");
    }
    
    public static function showProfilePage() {
        
        if(array_key_exists("Customer", $_SESSION) ) {
            ViewHelper::render("view/customer/profile.php");
        }
        else {
            ViewHelper::redirect(BASE_URL . "store");
        }
    }
    
}
