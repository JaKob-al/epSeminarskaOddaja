<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>Orders</title>



<div class="topnav">
    <a href="<?= BASE_URL . "book" ?>">All books</a> 
    <a href="<?= BASE_URL . "book/add" ?>">Add new</a> 
    <a href="<?= BASE_URL . "store" ?>">Bookstore</a> 
<!--    <a href="<?= BASE_URL . "customer" ?>">For customers</a>-->
    <a href="<?= BASE_URL . "zavarovano/seller/customer-list" ?>">Customer list</a>
    <a href="<?= BASE_URL . "zavarovano/seller/orders" ?>"> New Orders</a>
    <a href="<?= BASE_URL . "zavarovano/seller/orders/processed" ?>"> Processed Orders</a>
    <a href="<?= BASE_URL . "search" ?>">Search books</a>
    <a style="float: right">
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
  ?></a>
</div>

<h1>New orders</h1>

<ol>
    <?php foreach ($orders as $order): ?>
        <li><p>Order: </p></li>
        
        <table>  
        
        <?php foreach ($order["details"] as $product): ?>
            <tr> 
                <td>Product ID: <?= $product["book_id"]?></td>
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
    
    <form action="<?= BASE_URL . "zavarovano/seller/orders/status" ?>" method="post">
    <input type="hidden" name="id" value="<?= $order["orderID"] ?>"  />
    <input type="radio" id="accept" name="status" value="1">
    <label for="1">Accept</label><br>
    <input type="radio" id="decline" name="status" value="2">
    <label for="2">Decline</label><br>

<!--    <input type="hidden" name="id" value="<?= $book["id"] ?>"  />
        <label>Delete? <input type="checkbox" name="delete_confirmation" /></label>-->
    <button type="submit" class="important">Change status</button>
    </form>
    <?php endforeach; ?>
</ol>

<?php if($noNewOrders) {
    echo "No new orders.";
}
?>

