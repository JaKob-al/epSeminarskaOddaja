<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Edit entry</title>
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
    <a style="float: right">
  <?php
  if(array_key_exists("Customer", $_SESSION) ) {
      ?>
    <a href="<?= BASE_URL . "zavarovano/customer/profile" ?>" style="float: right"> 
        <?php
      echo  "Customer " . $_SESSION["Customer"]["name"] . "</a>";
  ?>  
    <a href="<?= BASE_URL . "zavarovano/customer/login" ?>" style="float: right">Log out</a>  
  <?php    
  }
  ?>
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
//  var_dump($customer);
  ?> 
</div> 
<h1>Edit customer</h1>

<form action="<?=BASE_URL . "/zavarovano/seller/customer-list/edit" ?>" method="post">
    <div class="container">
    <input type="hidden" name="id" value="<?= $customer["idCustomer"] ?>"  />
    <input type="hidden" name="idAddress" value="<?= $customer["address_idAddress"] ?>"  />
    <p><label>name: <input type="text" name="name" value="<?= $customer["name"] ?>" /></label></p>
    <p><label>surname: <input type="text" name="surname" value="<?= $customer["surname"] ?>" /></label></p>
    <p><label>email: <input type="email" name="email" value="<?= $customer["email"] ?>" /></label></p>
    <p><label>password: <input type="password" name="password"  /></label></p>
    <p><label>Street: <input type="text" name="street" autofocus /></label></p>
    <p><label>house number: <input type="number" name="houseNumber"/></label></p>
    <p><label>post: <input type="text" name="post" /></label></p>
    <p><label>code: <input type="number" name="code"/></label></p>
    <p><label>status: <label>active</label><input type="radio" name="active" value="1" checked><label>inactive</label><input type="radio" name="active" value="0"></label></p>
    <p><button type="submit">Update</button></p>
    </div>
</form>
