<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "customer/login.css" ?>">
<body>

<h2>Login / registration</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="customer/login" method="post">
    <div class="container">
      <label for="email"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="email" required>

      <label for="password"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit">Login</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Registration</button>

<div id="id02" class="modal">
    
    <form action="customer/register" method="post" class="modal-content animate">
        <div class="container">
            <p><label>name: <input type="text" name="name" required /></label></p>
            <p><label>surname: <input type="text" name="surname" required /></label></p>
            <p><label>email: <input type="email" name="email" required /></label></p>
            <p><label>password: <input type="password" name="password" required /></label></p>
            <p><label>Street: <input type="text" name="street" required autofocus /></label></p>
            <p><label>house number: <input type="number" name="houseNumber" required /></label></p>
            <p><label>post: <input type="text" name="post" required /></label></p>
            <p><label>code: <input type="number" name="code" required /></label></p> 
            
            
            <div class="g-recaptcha" data-sitekey="6Ldc5w0aAAAAAMwSz0dzT7hRlU-1A3jv5iolo1bP"></div>
            <p><button type="submit" name="submit">Register</button></p>
            
            <div style="background-color:#f1f1f1">
        <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
</form>
<script src='https://www.google.com/recaptcha/api.js'></script>
</div>


</body>
</html>
