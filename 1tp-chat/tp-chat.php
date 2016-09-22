
<!DOCTYPE HTML>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>TP CHAT</title>
	<style media="screen">
		body{
			display: flex;
			flex-direction: column;
		}
		.form{
			align-self: center;
			display: flex;
			justify-content: center;
			margin: 50px;
		}
		.content{
			align-self: center;
			width:40%;
			background-color: #C1C1C1;
			padding:10px;
		}
	</style>
</head>

<body>
	<div class=form>
	<!-- On créé le formulaire pour envoyer le message dans la BDD -->
	  <form action="tp-chat_post.php" method="post">
			<p>Votre Pseudo :</p>
			<!-- On fait varier 'value' pour compléter automatiquement le champ lors de la redirection.-->
			<input type="text" name="pseudo" value="<?= htmlspecialchars($_GET['pseudo']) ?>">
	    <p>Votre message :</p>
			<!-- Textarea permet de créer un champ de texte plus grand qu'un simple input-->
			<textarea rows='10' cols='20' name="message" class="textarea"></textarea><br>
			<input type="submit" class="bouton">
		</form>
	</div>
	<?php
	// Connexion à la base de données
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=formation_php;charset=utf8', 'root', 'root');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}

	// Récupération des 10 derniers messages et on modifie le format de la date en un format francais et plus jolie.
	$responses = $bdd->query('SELECT pseudo, message, DATE_FORMAT(add_date, \'%d/%m/%Y à %H:%i:%s\') AS add_date_fr FROM chat ORDER BY ID DESC LIMIT 0, 10');
	// Affichage de chaque message grâce à une boucle foreach afin de pouvoir ciblé chaque paragraphe plus faiclement en CSS si besoin (toutes les données sont protégées par htmlspecialchars)
	foreach ($responses->fetchAll() as $response): ?>
		<div class='content'>
			<p class='date-pseudo-message'>[<?= $response['add_date_fr']?>] <strong> <?= htmlspecialchars($response['pseudo'])?></strong> : <?= $response['message']?></p>
			<hr>
		</div>
	<?php endforeach; ?>
</body>
</html>
