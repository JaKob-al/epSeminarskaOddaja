<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Bookstore</title>

 <div class="topnav">
<!--    <a href="<?= BASE_URL . "book" ?>">All books</a> 
    <a href="<?= BASE_URL . "book/add" ?>">Add new</a> 
    --><a href="<?= BASE_URL . "store" ?>">Bookstore</a> 
    <a href="<?= BASE_URL . "zavarovano/customer" ?>">For customers</a>
    <a href="<?= BASE_URL . "zavarovano/seller" ?>">For sellers</a>
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
    <?php foreach ($books as $book): ?>
    <?php if($book["activeBook"] == 1) { ?>
        <div class="book">
            <form action="<?= BASE_URL . "store/add-to-cart" ?>" method="post" />
                <input type="hidden" name="id" value="<?= $book["id"] ?>" />
                <p><?= $book["title"] ?></p>
                <p><?= $book["author"] ?>, <?= $book["year"] ?> </p>
                <p><?= number_format($book["price"], 2) ?> EUR<br/>
                <button>Add to cart</button>
            </form> 
        </div>
    <?php } ?>
    <?php endforeach; ?>

</div>

<?php if (!empty($cart)): ?>

    <div id="cart">
        <h3>Shopping cart</h3>
        <?php foreach ($cart as $book): ?>

            <form action="<?= BASE_URL . "store/update-cart" ?>" method="post">
                <input type="hidden" name="id" value="<?= $book["id"] ?>" />
                <input type="number" name="quantity" value="<?= $book["quantity"] ?>" class="update-cart" />
                &times; <?= $book["title"] ?> 
                <button>Update</button> 
            </form>

        <?php endforeach; ?>

        <p>Total: <b><?= number_format($total, 2) ?> EUR</b></p>

        <form action="<?= BASE_URL . "store/purge-cart" ?>" method="post">
            <p><button>Purge cart</button></p>
        </form>
     
        <form action="<?= BASE_URL . "store/preview-order" ?>" method="post">
            <p><button>Go to checkout</button></p>
        </form>
    </div>    

<?php endif; ?>
