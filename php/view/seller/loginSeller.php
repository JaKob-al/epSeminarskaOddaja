<!DOCTYPE html>    
<?php
require_once("model/SellerDB.php");
        $authorized_users = SellerDB::getSellersEmail();
//        $authorized_users = [$authorized_users];  ČE JE PRODAJALEC SAMO EDEN
//        print_r($authorized_users);
        # preberemo odjemačev certifikat        
        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");

        # in ga razčlenemo
        $cert_data = openssl_x509_parse($client_cert);
        
        # preberemo email uporabnika
        $commonname = $cert_data["subject"]["emailAddress"];

        # TODO treba je še preveriti, da se prodajalec prijavlja res v svoj račun
        if (in_array($commonname, $authorized_users)) {
            echo "$commonname je avtoriziran prodajalec ";
        } else {
        # Sicer časa ne prikažemo.
            echo  "$commonname ni avtoriziran prodajalec ";
            exit();
        }
//        echo $cert_data["subject"]["emailAddress"];      
//        # Celotna vsebina certifikata.
//        echo "<p>Vsebina certifikata: ";
//        var_dump($cert_data);
?>
<h1>Seller login</h1>
    <form action="seller" method="post">
        <input type="text" name="email" placeholder="email">
        <input type="Password" name="password" placeholder="Password">
        <button type="submit">Log in</button>
    </form>