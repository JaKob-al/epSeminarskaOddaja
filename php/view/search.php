<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "search.css" ?>">
<meta charset="UTF-8" />
<title>Bookstore</title>

 <div class="topnav">
<!--    <a href="<?= BASE_URL . "book" ?>">All books</a> 
    <a href="<?= BASE_URL . "book/add" ?>">Add new</a> -->
    <a href="<?= BASE_URL . "store" ?>">Bookstore</a> 
    <a href="<?= BASE_URL . "zavarovano/customer" ?>">For customers</a>
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

<div id="main">
    <h1>Find book from database</h1>
    <form acton="" method="POST">
        <input type="text" name="searchString" placeholder="Find your desired book"/>
        <input type="submit" name="search" value="searchData"/>
    </form>
</div>