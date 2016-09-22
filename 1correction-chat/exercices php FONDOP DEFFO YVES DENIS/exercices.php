<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Exercices</title>
	<link href="style4.css" rel="stylesheet" />
    </head>

    <body>
        <h2>Sens toi libre d'insérer ton pseudo et ton commentaire !!!!</h2>

			<div class = "yes">
				<form action="exercices_post.php?date=<?php echo date("Y-m-d H:i:s");?> "  method="post">
			        <p>
				        <label for="auteur">Auteur</label> : <input type="text" name="Auteur" id="Auteur" /><br />
				        <label for="commentaire">commentaire</label> :  <input type="text" name="commentaire" id="commentaire" /><br />
				        <div class = "yes2">
				        	<input type="submit" value="Envoyer" />
			        	</div>
				    </p>
			    </form>
		    </div>
	    <h3>Commentaires :</h3>
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

		// Récupération des commentaires
		$req = $bdd->query('SELECT Auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM table_exercices ORDER BY id DESC ');

		while ($donnees = $req->fetch())
		{

		?>

		<p>
			le <?php
					echo htmlspecialchars($donnees['date_commentaire_fr']); ?> <strong><?php echo htmlspecialchars($donnees['Auteur']); ?></strong>: <?php echo htmlspecialchars($donnees['commentaire']);
				?>

		</p>

		<?php
		}
		$req->closeCursor();
		?>

	</body>
</html>
