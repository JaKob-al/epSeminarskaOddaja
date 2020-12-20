<?php

// enables sessions for the entire app
session_start();

require_once("controller/BookController.php");
require_once("controller/BookRESTController.php");
require_once("controller/StoreController.php");
require_once("controller/zavarovano/customer/CustomerController.php");
require_once("controller/zavarovano/admin/AdminController.php");
require_once("controller/zavarovano/seller/SellerController.php");
require_once("controller/OrderController.php");


define("BASE_URL", filter_input(INPUT_SERVER, "SCRIPT_NAME", FILTER_SANITIZE_SPECIAL_CHARS) . "/");
define("IMAGES_URL", rtrim(filter_input(INPUT_SERVER, "SCRIPT_NAME", FILTER_SANITIZE_SPECIAL_CHARS), "index.php") . "static/images/");
define("CSS_URL", rtrim(filter_input(INPUT_SERVER, "SCRIPT_NAME", FILTER_SANITIZE_SPECIAL_CHARS), "index.php") . "static/css/");

$path = null !== filter_input(INPUT_SERVER, "PATH_INFO", FILTER_SANITIZE_SPECIAL_CHARS) ? trim(filter_input(INPUT_SERVER, "PATH_INFO", FILTER_SANITIZE_SPECIAL_CHARS), "/") : "";

//Uncomment to see the contents of variables
//var_dump(BASE_URL);
//var_dump(IMAGES_URL);
//var_dump(CSS_URL);
//var_dump($path);
//exit(); 

$urls = [
    "/^search$/" => function ($method) {
        BookController::search();
    },
    "/^book$/" => function ($method) {
       BookController::index();
    },
    "/^book\/add$/" => function ($method) {
        if ($method == "POST") {
            BookController::add();
        } else {
            BookController::showAddForm();
        }
    },
    "/^book\/edit$/" => function ($method) {
        if ($method == "POST") {
            BookController::edit();
        } else {
            BookController::showEditForm();
        }
    },
    "/^book\/delete$/" => function ($method) {
        BookController::delete();
    },
    "/^store$/" => function ($method) {
        StoreController::index();
    },
    "/^store\/add-to-cart$/" => function ($method) {
        StoreController::addToCart();
    },
    "/^store\/update-cart$/" => function ($method) {
        StoreController::updateCart();
    },
    "/^store\/purge-cart$/" => function ($method) {
        StoreController::purgeCart();
    },
    "/^store\/send-order$/" => function ($method) {
        StoreController::sendOrder();
    },
    "/^store\/preview-order$/" => function ($method) {
        StoreController::orderPreview();
    },
      
    "/^zavarovano\/customer$/" => function () {
        CustomerController::showCustomerPage();
    },        
            
    "/^zavarovano\/customer\/profile$/" => function () {
        CustomerController::showProfilePage();
    },          

    "/^zavarovano\/customer\/register$/" => function () {
        if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
            $secretKey = "6Ldc5w0aAAAAAP5ZPfkO6FiOts223JvJxSy0NHfK";
            $responseKey = $_POST['g-recaptcha-response'];
            $userIP = $_SERVER['REMOTE_ADDR'];

            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
            $response = file_get_contents($url);
            $response = json_decode($response);
            if ($response->success) {
                echo "Verification success.";
                CustomerController::register();
            }
            else {
                echo "Verification failed!";
            }   
        } else {
            echo "napaka";
        }
    },
            
    "/^zavarovano\/customer\/login$/" => function () {
        if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
            CustomerController::login();
        } else if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "GET") {
            CustomerController::logout();
        } else {
            echo "napaka";
        }
    },
            
    "/^zavarovano\/customer\/update$/" => function () {
        if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
            CustomerController::update();
        } else {
            echo "napaka";
        }
    },
    "/^zavarovano\/customer\/order-history$/" => function () {
        OrderController::showOrderHistory();
    },
            
    "/^zavarovano\/admin$/" => function () {
        if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
            AdminController::login();
        } else {
            AdminController::showLoginAdmin();
        }
    },
    "/^zavarovano\/admin\/profile$/" => function () {
        AdminController::showAdminPage();
    },
    "/^zavarovano\/admin\/logout$/" => function () {
        AdminController::logout();
    },
    "/^zavarovano\/admin\/update$/" => function () {
        if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
            AdminController::update();
        } else {
            echo "napaka";
        }
    },
    "/^zavarovano\/admin\/seller-list$/" => function () {
        AdminController::sellerList();
    },
    "/^zavarovano\/admin\/seller-list\/edit$/" => function ($method) {
        if ($method == "POST") {
            AdminController::editSeller();
        } else {
            AdminController::showSellerEditForm();
        }
    },
    "/^zavarovano\/admin\/seller-list\/add$/" => function ($method) {
        if ($method == "POST") {
            AdminController::addSeller();
        } else {
            AdminController::showSellerAddForm();
        }
    },
//    USMERJANJE SELLER        
    "/^zavarovano\/seller$/" => function () {
       if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
           SellerController::login();
       } else {
           SellerController::showLoginSeller();
       }
    },
    "/^zavarovano\/seller\/profile$/" => function () {
        SellerController::showProfilePage();
    },
    "/^zavarovano\/seller\/logout$/" => function () {
        SellerController::logout();
    },
    "/^zavarovano\/seller\/update$/" => function () {
        if (htmlspecialchars($_SERVER["REQUEST_METHOD"]) == "POST") {
            SellerController::update();
        } else {
            echo "napaka";
        }
    },
    "/^zavarovano\/seller\/customer-list$/" => function () {
        SellerController::customerList();
    },
    "/^zavarovano\/seller\/customer-list\/edit$/" => function ($method) {
        if ($method == "POST") {
            SellerController::editCustomer();
        } else {
            SellerController::showCustomerEditForm();
        }
    },
    "/^zavarovano\/seller\/customer-list\/add$/" => function ($method) {
        if ($method == "POST") {
            SellerController::addCustomer();
        } else {
            SellerController::showCustomerAddForm();
        }
    },
    "/^zavarovano\/seller\/orders$/" => function () {
       OrderController::showNewOrders();
    },
    "/^zavarovano\/seller\/orders\/processed$/" => function () {
       OrderController::showProcessedOrders();
    },
    "/^zavarovano\/seller\/orders\/status$/" => function () {
       OrderController::changeStatus();
    },            
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "store");
    },
  
    # REST API
    "/^api\/book\/(\d+)$/" => function ($method, $id) {
        // TODO: izbris knjige z uporabo HTTP metode DELETE
        switch ($method) {
            case "PUT":
                BookRESTController::edit($id);
                break;
            case "DELETE":
                BookRESTController::delete($id);
                break;
            default: # GET
                BookRESTController::get($id);
                break;
        }
    },
    "/^api\/book$/" => function ($method) {
        switch ($method) {
            case "POST":
                BookRESTController::add();
                break;
            default: # GET
                BookRESTController::index();
                break;
        }
    },
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);
