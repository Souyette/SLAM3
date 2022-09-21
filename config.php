<?php

$DB_SERVER = "127.0.0.1";
$DB_DATABASE = "slam3colin";
$DB_USER = "root";
$DB_PASSWORD ="";
$bdd = new PDO('mysql:host=localhost;dbname=slam3colin', 'root', '');
    $reponse = $bdd->query('SELECT * FROM utilisateur');
    while ($donnees = $reponse->fetch())
    {
        echo '<p>' . $donnees['mdp'] . '</p>';
    } 
     
?>


