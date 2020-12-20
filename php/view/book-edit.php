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
    <a href="<?= BASE_URL . "zavarovano/seller/orders" ?>">New Orders</a>
    <a href="<?= BASE_URL . "zavarovano/seller/orders/processed" ?>"> Processed Orders</a>
    <a href="<?= BASE_URL . "search" ?>">Search books</a>
    
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
  ?> 
</div> 
<h1>Edit book</h1>

<form action="<?= BASE_URL . "book/edit" ?>" method="post">
    <input type="hidden" name="id" value="<?= $book["id"] ?>"  />
    <p><label>Author: <input type="text" name="author" value="<?= $book["author"] ?>" autofocus /></label></p>
    <p><label>Title: <input type="text" name="title" value="<?= $book["title"] ?>" /></label></p>
    <p><label>Price: <input type="number" name="price" value="<?= $book["price"] ?>" /></label></p>
    <p><label>Year: <input type="number" name="year" value="<?= $book["year"] ?>" /></label></p>
    <p><label>status: <label>active</label><input type="radio" name="activeBook" value="1" checked><label>inactive</label><input type="radio" name="activeBook" value="0"></label></p>
    <p><button>Update record</button></p>
</form>

<form action="<?= BASE_URL . "book/delete" ?>" method="post">
    <input type="hidden" name="id" value="<?= $book["id"] ?>"  />
    <label>Delete? <input type="checkbox" name="delete_confirmation" /></label>
    <button type="submit" class="important">Delete record</button>
</form>
