<?php
require_once('Controleur/Controller.php');
require_once('Modele/Cart.php');
require_once('Modele/Product.php');

$controller = new Controller();
$products = $controller->getProducts();
$cart_items = $controller->getCartItems();
$cart_total = $controller->getCartTotal();

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];
    $product_image = $_POST['product_image'];
    $controller->addToCart($product_id, $product_name, $product_price, $product_qty, $product_image);
}

if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    $controller->removeFromCart($product_id);
}

if (isset($_POST['checkout'])) {
    $controller->checkout();
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1SZ+bkGxRdBfYtuYRGnm+srSe00S5CzGWEa2w+4kIQq3q"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/style.css" />
    <title>E-musique</title>

</head>

<body>
    <header>
        <a href="index.php">
            <h1 id="titreBlog">E-musique</h1>
        </a>
        <div class="paragraphe">
            <p>Je vous souhaite la bienvenue sur mon site de vente d'articles de musique</p>
        </div>
        <div class="container my-5">
            <div class="row">
                <?php foreach ($products as $article): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?php echo $article->getImage(); ?>" class="card-img-top"
                                alt="<?php echo $article->getNom(); ?>">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $article->getNom(); ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $article->getDescription(); ?>
                                </p>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <?php echo $article->getPrix(); ?> €
                                </h6>
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $article->getId(); ?>">
                                    <input type="hidden" name="product_name" value="<?php echo $article->getNom(); ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $article->getPrix(); ?>">
                                    <input type="hidden" name="product_qty" value="1">
                                    <input type="hidden" name="product_image" value="<?php echo $article->getImage(); ?>">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="product_qty">Quantité</label>
                                        <input type="number" class="form-control" id="product_qty" name="product_qty"
                                            value="1" min="1">
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="add_to_cart">Ajouter au
                                        panier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </header>
</body>


</html>