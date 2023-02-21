<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <title>E-musique</title>
  </head>
  <body>
    <div id="global">
      <header>
        <a href="index.php"><h1 id="titreBlog">E-musique</h1></a>
        <div class="paragraphe">
            <p>Je vous souhaite la bienvenue sur mon site de vente d'article de vente d'articles de musique</p>
        </div>
      </header>
      <div id="contenu">
        <?php
        $bdd = new PDO('mysql:host=localhost;dbname=breif-8;charset=utf8', 
          'root', '');
        $article = $bdd->query('SELECT `id`, `nom`, `categorie`, `description`, `prix`, `image`, `stock` FROM `article` ');
        foreach ($article as $articles): 
        $imgData = base64_encode($articles['image']);
        ?>
<article class="card">
      <div class="image-container">
        <img src="data:image/jpeg;base64,<?= $imgData ?>" alt="<?= $articles['nom'] ?>" />
      </div>
      <div class="description-container">
        <header>
          <h2 class="catarticles"><?= $articles['categorie'] ?></h2>
          <h3 class="nomarticles"><?= $articles['nom'] ?></h3>
          <h4 class="prixarticles"><?= $articles['prix'] ?> €</h4>
          <h4 class="stockarticles">Stocks : <?= $articles['stock'] ?></h4>
        </header>
        <h4 class="description"><?= $articles['description'] ?></h4>
      </div>
    </article>
          <hr />
        <?php endforeach; ?>
      </div> <!-- #contenu -->
      <footer id="piedBlog">
        Blog réalisé avec PHP, HTML5 et CSS.
      </footer>
    </div> <!-- #global -->
  </body>
</html>