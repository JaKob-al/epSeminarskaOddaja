<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "header.css" ?>">
<meta charset="UTF-8" />
<title>My Profile</title>

 <div class="topnav">
<!--    <a href="<?= BASE_URL . "book" ?>">All books</a> 
    <a href="<?= BASE_URL . "book/add" ?>">Add new</a> -->
     <!--<a href="<?= BASE_URL . "search" ?>">Search books</a> -->
    <a href="seller-list">Sellers</a>
    <a style="float: right" href="profile"> 
  <?php
  if(array_key_exists("Admin", $_SESSION) ) {
      echo  "Admin " . $_SESSION["Admin"]["name"];
      ?> </a>
    <a href="<?= BASE_URL . "zavarovano/admin/logout" ?>" style="float: right">Log out</a>  
  <?php    
  }
  ?></a>
    
</div> 
<body>

<h1><?php echo  $_SESSION["Admin"]["name"];?>'s profile</h1>
<p>Update data</p>
<form action="update" method="post">
    <div class="container">
    <p><label>name: <input type="text" name="name"  /></label></p>
    <p><label>surname: <input type="text" name="surname"  /></label></p>
    <p><label>email: <input type="email" name="email"  /></label></p>
    <p><label>password: <input type="password" name="password"  /></label></p>
    <p><button type="submit">Update</button></p>
</form>


</body>
</html> 