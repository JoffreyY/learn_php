<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Forum</title>
        <meta content="text/html" charset="utf-8" />
        <link href="view/forum/stylesheet.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <h1>Forum</h1>
        <p>Derniers articles du forum :</p>

<?php
foreach($articles as $article)
{
?>
<div class="articles">
    <h3 class="title">
        <?= $article['title']; ?> par <?= $article['author']?>, <em>le <?= $article['add_date_fr']; ?></em>
    </h3>
    <p class='content'>
      <?= $article['content']; ?>
      <br />
    </p>
</div>
<?php
}
?>
</body>
</html>
