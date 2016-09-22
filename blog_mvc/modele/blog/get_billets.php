<?php
function get_billets($offset, $limit)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;

    $req = $bdd->prepare('SELECT id, title, content, DATE_FORMAT(add_date, \'%d/%m/%Y � %Hh%imin%ss\')
    AS date_creation_fr FROM ticket ORDER BY date_creation DESC LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $billets = $req->fetchAll();


    return $billets;
}
