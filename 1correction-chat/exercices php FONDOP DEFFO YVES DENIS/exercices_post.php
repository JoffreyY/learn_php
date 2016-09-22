<?php 
setcookie('auteur',$_POST['Auteur'] , time() + 365*24*3600, null, null, false, true);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Exercices</title> 
    </head>
        
    <body>
 
	    <?php
		// Connexion à la base de données
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
		        die('Erreur : '.$e->getMessage());
		}

		// Récupération des commentaires
		$req = $bdd->prepare('INSERT INTO table_exercices (Auteur, commentaire,date_commentaire) VALUES( ?, ?, ?)');
		$req->execute(array( $_POST['Auteur'],$_POST['commentaire'],$_GET['date']));


		header('Location: exercices.php?');
		?>

	</body>
</html>