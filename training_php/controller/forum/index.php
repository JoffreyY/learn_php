<?php

// On demande les 5 derniers billets au modèle
include_once('model/forum/get_articles.php');
$articles = get_articles(0, 5);

// On effectue du traitement sur les données : on sécurise l'affichage
foreach($articles as $key => $article)
{
    $articles[$key]['title'] = htmlspecialchars($article['title']);
    $articles[$key]['content'] = nl2br(htmlspecialchars($article['content']));
    $articles[$key]['author'] = htmlspecialchars($article['author']);
}

// On affiche la page (vue)
include_once('view/forum/index.php');
