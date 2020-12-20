<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>My Profile</title>

 <div class="topnav"> 
    <a href="<?= BASE_URL . "store" ?>">Bookstore</a> 
    <a href="<?= BASE_URL . "zavarovano/customer/order-history" ?>">Order history</a>
    <a href="<?= BASE_URL . "search" ?>">Search books</a>
    
    <a style="float: right">
  <?php
  if(array_key_exists("Customer", $_SESSION) ) {
      ?>
    <a href="<?= BASE_URL . "/zavarovano/customer/profile" ?>" style="float: right"> 
        <?php
      echo  "Customer " . $_SESSION["Customer"]["name"] . "</a>";
  ?>  
    <a href="<?= BASE_URL . "/zavarovano/customer/login" ?>" style="float: right">Log out</a>  
  <?php    
  }
  ?></a>
    
</div> 
<body>

<h1><?php echo  $_SESSION["Customer"]["name"];?>'s profile</h1>
<p>Update data</p>
<form action="update" method="post">
    <div class="container">
    <p><label>name: <input type="text" name="name"  /></label></p>
    <p><label>surname: <input type="text" name="surname"  /></label></p>
    <p><label>email: <input type="email" name="email"  /></label></p>
    <p><label>password: <input type="password" name="password"  /></label></p>
    <p><label>Street: <input type="text" name="street" autofocus /></label></p>
    <p><label>house number: <input type="number" name="houseNumber"/></label></p>
    <p><label>post: <input type="text" name="post" /></label></p>
    <p><label>code: <input type="number" name="code"/></label></p>
    <p><button type="submit">Update</button></p>
</form>


</body>
</html> 