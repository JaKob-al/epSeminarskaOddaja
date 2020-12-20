<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Edit entry</title>
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
<h1>Edit seller</h1>

<form action="<?=BASE_URL . "zavarovano/admin/seller-list/edit" ?>" method="post">
    <div class="container">
    <input type="hidden" name="id" value="<?= $seller["idSeller"] ?>"  />
    <p><label>name: <input type="text" name="name" value="<?= $seller["name"] ?>"/></label></p>
    <p><label>surname: <input type="text" name="surname" value="<?= $seller["surname"] ?>" /></label></p>
    <p><label>email: <input type="email" name="email" value="<?= $seller["email"] ?>" /></label></p>
    <p><label>password: <input type="password" name="password"/></label></p>
    <p><label>status: <label>active</label><input type="radio" name="active" value="1" checked><label>inactive</label><input type="radio" name="active" value="0"></label></p>
    <!--
    <p><label>active: <input type="text" name="active"  /></label></p>
    -->
    <p><button type="submit">Update</button></p>
</form>
