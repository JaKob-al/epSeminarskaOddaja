<!DOCTYPE html>    
<?php
require_once("model/AdminDB.php");
        # Avtorizirani uporabniki (to navadno pride iz podatkovne baze)
        $authorized_users = AdminDB::getAdminsEmail();
        $authorized_users = [$authorized_users];

        # preberemo odjemačev certifikat
        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");

        # in ga razčlenemo
        $cert_data = openssl_x509_parse($client_cert);
        
        # preberemo email uporabnika
        $commonname = $cert_data["subject"]["emailAddress"];

        # Če se ime nahaja na seznam avtoriziranih uporabnikov prikažemo čas.
        if (in_array($commonname, $authorized_users)) {
            echo "$commonname je avtoriziran uporabnik ";
        } else {
        # Sicer časa ne prikažemo.
            echo "$commonname ni avtoriziran uporabnik ";
            exit();
        }
//        echo $cert_data["subject"]["emailAddress"];
        
//        # Celotna vsebina certifikata.
//        echo "<p>Vsebina certifikata: ";
//        var_dump($cert_data);
?>
<html>    
<head>    
    <title>Login Form</title>    
    <link rel="stylesheet" type="text/css" href="css/style.css">    
</head>    
<body>    
    <h1>Admin login</h1>
        <form action="" method="post">
            <input type="text" name="email" placeholder="email">
            <input type="Password" name="password" placeholder="Password">
            <button type="submit">Log in</button>
        </form>
</body>    
</html>  