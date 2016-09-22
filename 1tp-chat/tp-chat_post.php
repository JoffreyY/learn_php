<?php
// On se connecte à la base de donnée.
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
if (isset($_POST['message']))
{
    $texte = stripslashes($_POST['message']); // On enlève les slashs qui se seraient ajoutés automatiquement
    $texte = htmlspecialchars($texte); // On rend inoffensives les balises HTML que le visiteur a pu rentrer
    $texte = nl2br($texte); // On crée des <br /> pour conserver les retours à la ligne

    // On fait passer notre texte à la moulinette des regex
    $texte = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $texte);
    $texte = preg_replace('#\[i\](.+)\[/i\]#isU', '<em>$1</em>', $texte);
    $texte = preg_replace('#\[color=(red|green|blue|yellow|purple|olive)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $texte);
    $texte = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
}
?>
<?php
  // On insère le message dans le BDD pour qu'il soit enregistré puis affiché sous le formulaire html.
	$req = $bdd->prepare('INSERT INTO chat(pseudo, message, add_date) VALUES(:pseudo, :message, NOW())');
	$req->bindParam(':pseudo', $_POST['pseudo']);
	$req->bindParam(':message', $texte);
	$query = $req->execute();
?>
<?php
  //On insère la variable dans l'URL de redirection afin d'effectuer une auto complétion du champ "Pseudo"
  header('Location: tp-chat.php?pseudo='.$_POST['pseudo'].'');
  exit;
?>
