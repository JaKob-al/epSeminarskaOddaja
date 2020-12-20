<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Orders</title>

<?php //var_dump($orders)?>

<div class="topnav"> 
    <a href="<?= BASE_URL . "store" ?>">Bookstore</a> 
    <a href="<?= BASE_URL . "zavarovano/customer/order-history" ?>">Order history</a>
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
  ?></a>
    
</div> 

<h1>Order history</h1>

<ol>
    <?php foreach ($orders as $order): ?>
        <li><p>Order: </p></li>
        
        <table>  
        
        <?php foreach ($order["details"] as $product): ?>
            <tr> 
                <td>Author: <?= $product["author"]?></td>
                <td>Title: <?= $product["title"]?></td>
                <td>Quantity: <?= $product["quantity"]?></td>
                <td>Price: <?= $product["price"]?></td>

            </tr>
        <?php endforeach; ?>
        </table>
        
        <p>Customer ID: <?= $order["customer_idCustomer"]?></p>
        <p>Total: <?= $order["total"]?></p>
        <p>Status: 
                <?php switch ($order["status"]) {
                    case 0:
                        echo "Unprocessed";
                        break;
                    case 1:
                        echo "Accepted";
                        break;
                    case 2:
                        echo "Declined";
                        break;
                    case 3:
                        echo "Canceled";
                        break;
                }?></p>
    <?php endforeach; ?>
</ol>

<?php //var_dump($all);

