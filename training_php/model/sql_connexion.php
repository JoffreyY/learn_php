<?php

// Connexion à la base de données
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=formation_php', 'root', 'root');
}
//Affichage des erreurs potentielles
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
