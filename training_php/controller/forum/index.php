<?php

// On demande les 5 derniers billets au modèle
include_once('../../modele/blog/get_billets.php');
$articles = get_articles(0, 5);

// On effectue du traitement sur les données (contrôleur) : on sécurise l'affichage
foreach($articles as $key => $article)
{
    $articles[$key]['title'] = htmlspecialchars($article['title']);
    $articles[$key]['content'] = nl2br(htmlspecialchars($article['content']));
    $articles[$key]['author'] = htmlspecialchars($article['author']);
}

// On affiche la page (vue)
include_once('../../vue/blog/index.php');
