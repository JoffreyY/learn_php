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
<?php
// Rediriger vers minichat.php
header('Location: mini-chat.php');
?>
  <?php
  // On insert le message dans le BDD pour qu'il soit afficher sur la page mini-chat.php
  $req = $bdd->prepare('INSERT INTO CHAT(pseudo, message) VALUES(:pseudo, :message)');
  $req->execute(array(
  	'pseudo' => $_POST['pseudo'],
  	'message' => $_POST['message']
  	));

    $reponse->closeCursor(); // Termine le traitement de la requête
  ?>
