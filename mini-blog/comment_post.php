<?php
error_reporting(-1);

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=formation_php;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>
<?php
// Rediriger vers index.php
// header('Location: index.php');
?>
<?php
if (isset($_GET['id'])) {

	//On insère le commentaire dans la BDD 'comment' avec un 'id_ticket' == 'id' (de l'article) pour lier chaque commentaire à son article
	$req = $bdd->prepare('INSERT INTO comment(id_ticket, author, content, add_date) VALUES(:id_ticket, :author, :content, NOW())');
	$req->bindParam(':id_ticket', $_GET['id']);
	$req->bindParam(':author', $_POST['author']);
	$req->bindParam(':content', $_POST['content']);

	$query = $req->execute();

	header('Location: http://localhost:8888/mini-blog/comment.php?id='.$_GET['id'].'&comment='.$bdd->lastInsertId());
	exit;
}
?>
