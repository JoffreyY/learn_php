<?php
function get_article($offset, $limit)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;

    $req = $bdd->prepare('SELECT id, title, content, author DATE_FORMAT(add_date, \'%d/%m/%Y � %Hh%imin%ss\')
    AS add_date_fr FROM ticket ORDER BY date_creation DESC LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $articles = $req->fetchAll();


    return $articles;
}
