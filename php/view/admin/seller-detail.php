<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Book detail</title>
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
<h1>Details of: <?= $seller["name"], " ", $seller["surname"]?></h1>

<ul>
    <li>ID: <b><?= $seller["idSeller"] ?></b></li>
    <li>Name: <b><?= $seller["name"] ?></b></li>
    <li>Surname: <b><?= $seller["surname"] ?></b></li>
    <li>Email: <b><?= $seller["email"] ?></b></li>
    
    <li>Account status: <b>
        <?php 
            if($seller["active"]==1) {
                echo "ACTIVE";
            }
            else {
                echo "NOT ACTIVE";
            }
        ?>
              
</ul>

<p>[ <a href="<?= BASE_URL . "zavarovano/admin/seller-list/edit?id=" . $_GET["id"] ?>">Edit</a> |
<a href="<?= BASE_URL . "zavarovano/admin/seller-list" ?>">Seller list</a> ]</p>
