<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Add entry</title>
 <div class="topnav">
     <a href="<?= BASE_URL . "zavarovano/admin/seller-list" ?>">Sellers</a>
    
<?php
  if(array_key_exists("Admin", $_SESSION) ) {
      ?>
    <a href="<?= BASE_URL . "/zavarovano/admin/profile" ?>" style="float: right">
        <?php
      echo  "Admin " . $_SESSION["Admin"]["name"] . "</a>";
  ?>  
    <a href="<?= BASE_URL . "/zavarovano/admin/logout" ?>" style="float: right">Log out</a>  
  <?php    
  }
  ?> 
</div> 
<h1>Add new seller</h1>

<form action="<?= BASE_URL . "/zavarovano/admin/seller-list/add" ?>" method="post">
    <div class="container">
    <p><label>name: <input type="text" name="name"  /></label></p>
    <p><label>surname: <input type="text" name="surname"  /></label></p>
    <p><label>email: <input type="email" name="email"  /></label></p>
    <p><label>password: <input type="password" name="password"  /></label></p>
    <p><button type="submit">Add</button></p>
</form>
