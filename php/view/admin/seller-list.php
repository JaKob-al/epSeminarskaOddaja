<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Sellers</title>
 <div class="topnav">
<!--    <a href="<?= BASE_URL . "book" ?>">All books</a> 
    <a href="<?= BASE_URL . "book/add" ?>">Add new</a> 
    <a href="<?= BASE_URL . "store" ?>">Bookstore</a> 
    <a href="<?= BASE_URL . "zavarovano/customer" ?>">For customers</a>
    <a href="<?= BASE_URL . "zavarovano/seller" ?>">For sellers</a>
    <a href="<?= BASE_URL . "search" ?>">Search books</a>-->
    
    <?php
  if(array_key_exists("Admin", $_SESSION) ) {
      ?>
    <a href="<?= BASE_URL . "zavarovano/admin/profile" ?>" style="float: right"> 
        <?php
      echo  "Admin " . $_SESSION["Admin"]["name"] . "</a>";
  ?>  
    <a href="<?= BASE_URL . "/zavarovano/admin/logout" ?>" style="float: right">Log out</a>  
  <?php    
  }
  ?> 
</div> 
<h1>Sellers</h1>

<ul>
    <?php foreach ($sellers as $seller): ?>
        <li><a href="<?= BASE_URL . "zavarovano/admin/seller-list?id=" . $seller["idSeller"] ?>">
                <?= $seller["idSeller"] ?>: 
        	<?= $seller["name"] ?> </a></li>
    <?php endforeach; ?>
</ul>

<a href="<?= BASE_URL . "zavarovano/admin/seller-list/add" ?>">Add new</a>

