<?php

require_once("model/AdminDB.php");
require_once("ViewHelper.php");


class AdminController {
    
public static function showLoginAdmin() {
    ViewHelper::render("view/admin/loginAdmin.php");
    
}
      
    public static function login(){
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = htmlspecialchars($_POST["password"]);
        $admin = AdminDB::loginAdmin($email); 
        
        if (empty($admin)) {
                echo "prijava neuspešna";
            }
            else {
               $hash = $admin[0]["password"];
               if(password_verify($password, $hash)){
                echo "prijava uspešna";
                session_regenerate_id();
                $_SESSION['Admin'] = $admin[0];
                ViewHelper::redirect(BASE_URL . "zavarovano/admin/profile");
                }
                else {
                    echo "prijava neuspešna";
                }     
            }  
    }
    
    public static function logout(){
        unset($_SESSION['Admin']);
        ViewHelper::redirect(BASE_URL . "store");
    }
    
    public static function showAdminPage() {
        if(array_key_exists("Admin", $_SESSION) ) {
            ViewHelper::render("view/admin/profile.php");
        }
        else {
            ViewHelper::redirect(BASE_URL . "store");
        }
    }
    
    public static function update() {
        $id = $_SESSION['Admin']['idAdmin'];
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
            AdminDB::updateAdmin($id, $name, $surname, $email, $password);
            $admin = AdminDB::loginAdmin($email);
            unset($_SESSION['Admin']);
            $_SESSION['Admin'] = $admin[0];
            ViewHelper::redirect(BASE_URL . "/zavarovano/admin/profile");
        } else {
            echo 'napaka, izpolni vsa polja';
        }
    }
    
    public static function sellerList() {
        if(array_key_exists("Admin", $_SESSION)) {
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS);
            if (isset($id)) {
                $seller = SellerDB::getSeller($id);
    //            var_dump($customer);
                ViewHelper::render("view/admin/seller-detail.php", ["seller" => $seller]);
            } else {
                $sellers = SellerDB::getAll();
                ViewHelper::render("view/admin/seller-list.php", ["sellers" => $sellers]);
            }
        }
        else {
            echo 'Nimate dostopa do te strani!';
        }
    }
    
    public static function showSellerAddForm() {
        if(array_key_exists("Admin", $_SESSION)) {
        ViewHelper::render("view/admin/seller-add.php");
        }
        else {
            echo 'Nimate dostopa do te strani!';
        }
    }
    
    public static function addSeller($customer = []) {
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
            SellerDB::insert($name, $surname, $email, $password, 1);
            ViewHelper::redirect(BASE_URL . "zavarovano/admin/seller-list");
        } else {
            echo 'napaka, izpolni vsa polja';
        }
    }
    
    public static function showSellerEditForm($customer = []) {
        if(array_key_exists("Admin", $_SESSION)) {
            if (empty($customer)) {
                $seller = SellerDB::getSeller(filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS));
            }
        ViewHelper::render("view/admin/seller-edit.php", ["seller" => $seller]);
        }
        else {
            echo 'Nimate dostopa do te strani!';
        }
    }
    
    public static function editSeller() {
        if(array_key_exists("Admin", $_SESSION)) {
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
            $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $active = filter_input(INPUT_POST, "active", FILTER_SANITIZE_SPECIAL_CHARS);


            $validData = isset($name) && !empty($name)&&
                    isset($surname) && !empty($surname)&&
                    isset($email) && !empty($email)&&
                    isset($password) && !empty($password)&&
                    isset($active);
            echo isset($active);
            if ($validData) {
                SellerDB::updateSeller($id, $name, $surname, $email, $password, $active);
                ViewHelper::redirect(BASE_URL . "/zavarovano/admin/seller-list");
            } else {
                echo ',         napaka izpolni vsa polja';
            }
        }
        else {
            echo 'Nimate dostopa do te strani!';
        }
        
    }
}
