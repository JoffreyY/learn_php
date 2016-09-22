<?php
if(isset($_POST['pseudo']) AND $_POST['pseudo'] != '') {
setcookie('pseudo', $_POST['pseudo'], time()+365*24*3600, null, null, false, true);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mini Chat</title>
</head>
 <style>
    form
    {
        text-align:center;
    }
	.date
	{
		font-size:12px;
		color:#666;
		width:250px;
	}
	.message
	{
		width:500px;
		border-bottom:1px solid #000;
		padding:0 10px;
	}
    </style>
<body>
 <form action="chat.php" method="post">
        <p>
        <label for="pseudo">Pseudo</label> : <input type="text" name="pseudo" id="pseudo"
<?php
// affichage du pseudo
if(isset($_COOKIE['pseudo']) AND $_COOKIE['pseudo'] != '') {
	echo ' value="' . htmlspecialchars($_COOKIE['pseudo']) . '"';

}
?>
 /><br />
        <label for="message">Message</label> :  <input type="text" name="message" id="message" /><br />

        <input type="submit" value="Envoyer" />
	</p>
    </form>
<?php
// Affichage des 10 derniers messages
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=formation_php;charset=utf8', 'root', 'root');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, message, date FROM chat ORDER BY ID DESC LIMIT 0, 10');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch())
{
	echo '<div class="date">Le : ' . $donnees['date'] . '</div>';
	echo '<p class="message"><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
}

$reponse->closeCursor();


// Enregistrement d'un message dans la base de donnée

if(isset($_POST['pseudo']) AND isset($_POST['message'])) {

	if($_POST['message'] != '') {
		// Préparation des données
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$message = htmlspecialchars($_POST['message']);
		setlocale(LC_TIME, 'fra_fra');
		$date = strftime('%A %d %B %Y, %H:%M');

		$req = $bdd->prepare('INSERT INTO chat(pseudo, message, date) VALUES (:pseudo, :message, :date)');
		$req->execute(array(
							'pseudo'=>$pseudo,
							'message'=>$message,
							'date'=>$date
							));
	 	echo '<br /><br /> Votre message a bien été enregistré !';
	} else {
		echo '<strong>Tu n\'a pas écris de message !</strong>';
	}
}
?>
</body>
</html>
