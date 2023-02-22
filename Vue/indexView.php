<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/style-1.css" />
    <title>E-musique</title>
  </head>
  <body>
    <!-- <div id="global"> -->
      <header>
        <a href="index.php"><h1 id="titreBlog">E-musique</h1></a>
        <div class="panier">
          <a href="panier.php"><i class="bi bi-cart4"></i></a>
        </div>
        <div class="paragraphe">
            <p>Je vous souhaite la bienvenue sur mon site de vente d'articles de musique</p>
        </div>
      </header>
      <?php if (isset($articles) && count($articles) > 0): ?>
      <?php foreach ($articles as $article): $imgData = base64_encode($article->getPhoto()); ?>
        <article class="card">
          <div class="image-container">
          <img src="data:image/jpeg;base64,<?= $imgData ?>" alt="<?= $article->getNom() ?>" />

          </div>
          <div class="description-container">
            <h2 class="catarticles"><?= $article->getCategorie() ?></h2>
            <h3 class="nomarticles"><?= $article->getNom() ?></h3>
            <h4 class="prixarticles"><?= $article->getPrix() ?> €</h4>
            <h4 class="stockarticles">Stocks : <?= $article->getStock() ?></h4>
            <h4 class="description"><?= $article->getDescription() ?></h4>
          </div>
        </article>
        <hr />
      <?php endforeach; ?>
    <?php else: ?>
      <p>Aucun article n'a été trouvé.</p>
    <?php endif; ?>
  
  </body>
</html>

