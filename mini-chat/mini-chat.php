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
	<title>Mini-chat</title>
</head>

<body>
	<!-- On créé le formulaire pour envoyer le message dans la BDD -->
  <form action="mini-chat_post.php" method="post">
		<p>Entrez votre Pseudo</p>
		<input type="text" name="pseudo">
		<p>Votre Message</p>
		<input type="text" name="message"><br><br>
		<!-- On propose à l'utilisateur de trier les messages dans l'ordre décroissant-->
		<input type="submit">
	</form>
	<form action="mini-chat.php" method="get">
		<label><input name="order" checked type="radio" value="DESC">Décroissant</label>
		<label><input name="order" type="radio" value="ASC">Croissant</label>
		<select class="" name="by">
			<option value="id">Id</option>
			<option value="pseudo">Pseudo</option>
			<option value="message">Message</option>
		</select>
		<button type="sumbit">Envoyer</button>
	</form>
	<?php
	// On récupère le contenu de la BDD chat

		$sql = 'SELECT pseudo, message, id FROM chat';
		if (isset($_GET['order'])) {
			$sql .= ' ORDER BY '.$_GET['by'].' '.$_GET['order'];
		}
		$sql .= ' LIMIT 5';
		$responses = $bdd->query($sql);
	// On affiche chaque message un à un
	// while ($donnees = $reponse->fetch()){
	// 	echo '<p>' . $donnees['pseudo'] .' - '. $donnees['message'] . '</p>';
	// }

// $reponse->closeCursor(); // Termine le traitement de la requête
	?>
	<?php foreach ($responses->fetchAll() as $response): ?>
		<h2><?= $response['id'] . ' - ' . $response['pseudo'] ?></h2>
		<h3><?= $response['message'] ?></h3>
		<hr>
	<?php endforeach; ?>
</body>
</html>
