<?php

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=formation_php;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Commentaires</title>
	<style media="screen">
		.comment{
			background-color: #C1C1C1;
			padding:10px;
		}.comment:nth-child(2n) {
			background-color: green;
			text-align: right;
		}
		.current{
			background-color: red;
		}
	</style>
</head>

<body>
<?php
// On créé une variable qui récupère le contenu de la BDD ticket
	$sql = 'SELECT author, content, id, DATE_FORMAT(add_date, \'%d/%m/%Y à %Hh%imin%ss\') AS add_date_fr FROM ticket';

//si l'ID existe dans l'URL, on peut executer la commande SQL avec WHERE id=
	if (isset($_GET['id'])) {
		$sql .= ' WHERE id='.$_GET['id'];
	}
	$responses = $bdd->query($sql);
?>

<?php
//On affiche l'article associé à l'ID
foreach ($responses->fetchAll() as $response): ?>
	<h2><?= $response['author'] . ' - ' . $response['add_date_fr']  . ' - ' . $response['id']?></h2>
	<h3><?= $response['content'] ?></h3>
<?php endforeach; ?>

<h2>Commentaires :</h2>
<hr>

<?php

// On créé une variable qui récupère le contenu de la BDD 'comment'
	$sql = 'SELECT author, content, id, id_ticket, DATE_FORMAT(add_date, \'%d/%m/%Y à %Hh%imin%ss\') AS add_date_fr FROM comment';

//On execute la requête SQL en verifiant qu'il existe un ID d'un article afin d'afficher uniquement les commentaires associées à celui-ci
	if (isset($response['id'])) {
		$sql .= ' WHERE id_ticket='.$response['id'];
	}
//On limite les commentaires à 5
		$sql .= ' ORDER BY add_date DESC';
		$responses = $bdd->query($sql);

// On affiche les différents commentaire postés, associés à cet article
foreach ($responses->fetchAll() as $response): ?>
	<div class="comment <?= ($response['id'] === $_GET['comment']) ? 'current' : '' ?>" id="<?= $response['id'] ?>">
		<p><?= $response['author'] . ' - ' . $response['add_date_fr']?></h2>
		<p><?= $response['content'] ?></p>
	</div>
<?php endforeach; ?>

<!-- On créé un formulaire pour poster un commentaire-->
<form action="comment_post.php?id=<?= $_GET['id']?>" method="post">
	<p>Entrez votre pseudo</p>
	<input type="text" name="author">
	<p>Écrivez ici votre commentaire :</p>
	<textarea rows='5' cols='20' name="content" class="">Entrez votre commentaire</textarea>
	<input type="submit">
</form>
<a href="index.php" rel="forum">Retour au forum</a>
</body>
</html>
