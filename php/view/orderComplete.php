<h1>Order preview</h1>
<table>
<?php foreach ($cart as $product): ?>
            <tr> 
                <td>Title: <?= $product["title"]?></td>
                <td>Author: <?= $product["author"]?></td>
                <td>Quantity: <?= $product["quantity"]?></td>
                <td>Price: <?= ($product["price"] * $product["quantity"])?></td>
                

            </tr>
        <?php endforeach; ?>
</table>
<br>
Total: <?= $total;?>
<br>
<a href="<?= BASE_URL . "store/send-order"?>">Send order</a>
