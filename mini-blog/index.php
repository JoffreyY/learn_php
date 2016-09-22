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
	<title>Blog</title>
</head>

<body>
	<!-- On créé le formulaire pour envoyer le message dans la BDD -->
  <form action="index.php" method="post">
		<p>Entrez votre Pseudo</p>
		<input type="text" name="author">
    <p>Entrez votre titre</p>
		<input type="text" name="title">
		<p>Votre Article</p>
		<textarea rows='10' cols='20' name="content" class="">Insérez le texte</textarea>
		<input type="submit">
	</form>
  <?php
    $req = $bdd->prepare('INSERT INTO ticket(title, author, content, add_date) VALUES(:title, :author, :content, NOW())');
    $req->execute(array(
      'author' => $_POST['author'],
      'title' => $_POST['title'],
      'content' => $_POST['content']
      ));
  ?>
	<?php
	// On récupère le contenu de la BDD ticket
  $responses = $bdd->query('SELECT * FROM ticket ORDER BY add_date DESC LIMIT 5');
  foreach ($responses->fetchAll() as $response): ?>
		<p><?= $response['author'] . ' - ' . $response['add_date'] . ' - ' . $response['title']?></h2>
		<p><?= $response['content'] ?></p>
    <a href='comment.php?id=<?= $response['id']?>'>COMMENTAIRE</a>
		<hr>
	<?php endforeach; ?>
  <?php $reponse->closeCursor();?>

</body>
</html>
