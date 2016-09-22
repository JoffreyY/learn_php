<?php

// On demande les 5 derniers billets (mod�le)
include_once('modele/blog/get_billets.php');
$billets = get_billets(0, 5);

// On effectue du traitement sur les donn�es (contr�leur)
// Ici, on doit surtout s�curiser l'affichage
foreach($billets as $cle => $billet)
{
    $billets[$cle]['title'] = htmlspecialchars($billet['title']);
    $billets[$cle]['content'] = nl2br(htmlspecialchars($billet['content']));
}

// On affiche la page (vue)
include_once('vue/blog/index.php');
