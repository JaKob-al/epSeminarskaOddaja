<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Book detail</title>
 <div class="topnav">
    <a href="<?= BASE_URL . "book" ?>">All books</a> 
    <a href="<?= BASE_URL . "book/add" ?>">Add new</a> 
    <a href="<?= BASE_URL . "store" ?>">Bookstore</a> 
<!--    <a href="<?= BASE_URL . "zavarovano/customer" ?>">For customers</a>
    <a href="<?= BASE_URL . "zavarovano/seller" ?>">For sellers</a>-->
    <a href="<?= BASE_URL . "zavarovano/seller/customer-list" ?>">Customer list</a>
    <a href="<?= BASE_URL . "zavarovano/seller/orders" ?>"> New Orders</a>
    <a href="<?= BASE_URL . "zavarovano/seller/orders/processed" ?>"> Processed Orders</a>
    <a href="<?= BASE_URL . "search" ?>">Search books</a>
    <?php
  if(array_key_exists("Seller", $_SESSION) ) {
      ?>
    <a href="<?= BASE_URL . "zavarovano/seller/profile" ?>" style="float: right"> 
        <?php
      echo  "Seller " . $_SESSION["Seller"]["name"] . "</a>";
  ?>  
    <a href="<?= BASE_URL . "zavarovano/seller/logout" ?>" style="float: right">Log out</a>  
  <?php    
  }
  ?> 
</div> 
<h1>Details of: <?= $customer["name"], " ", $customer["surname"]?></h1>

<ul>
    <li>ID: <b><?= $customer["idCustomer"] ?></b></li>
    <li>Name: <b><?= $customer["name"] ?></b></li>
    <li>Surname: <b><?= $customer["surname"] ?></b></li>
    <li>Email: <b><?= $customer["email"] ?></b></li>
    <li>Address:
        <ul>
            <li>Street: <b><?= $customer["address"]["street"] ?></b></li>
            <li>House number: <b><?= $customer["address"]["houseNumber"] ?></b></li>
            <li>Post office: <b><?= $customer["address"]["post"] ?></b></li>
            <li>Post code: <b><?= $customer["address"]["code"] ?></b></li>
        </ul>
    <li>Account status: <b>
        <?php 
            if($customer["active"]==1) {
                echo "ACTIVE";
            }
            else {
                echo "NOT ACTIVE";
            }
        ?>
</ul>

<p>[ <a href="<?= BASE_URL . "zavarovano/seller/customer-list/edit?id=" . $_GET["id"] ?>">Edit</a> |
<a href="<?= BASE_URL . "zavarovano/seller/customer-list" ?>">Customer list</a> ]</p>
