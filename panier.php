<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'breif-8';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}

if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];
    
    // Ajoute le produit au panier
    $_SESSION['cart'][$product_id] = array(
        'name' => $product_name,
        'price' => $product_price,
        'qty' => $product_qty
    );
}

if (isset($_POST['update_cart'])) {
    $qty_array = $_POST['qty'];
    foreach ($qty_array as $product_id => $qty) {
        if ($qty == 0) {
            // Retire le produit du panier s'il a une quantité de 0
            unset($_SESSION['cart'][$product_id]);
        } else {
            // Met à jour la quantité du produit dans le panier
            $_SESSION['cart'][$product_id]['qty'] = $qty;
        }
    }
}

if (isset($_POST['checkout'])) {
    // Processus de paiement et confirmation de commande
}

// Récupère les informations des produits à partir de la base de données
$products = array();
if (!empty($_SESSION['cart'])) {
    $product_ids = array_keys($_SESSION['cart']);
    $product_ids_placeholder = implode(',', array_fill(0, count($product_ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM article WHERE id IN ($product_ids_placeholder)");
    $stmt->execute($product_ids);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Affiche le contenu du panier
$total = 0;
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Mon panier</title>
    <link rel="stylesheet" type="text/css" href="styles/panier.css"> 
</head>
<body>
    <h2>Mon panier</h2>
    <?php if (empty($products)): ?>
    <p>Votre panier est vide.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Prix total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <?php
                $product_id = $product['id'];
                $product_name = $product['nom'];
                $product_price = $product['prix'];
                $product_qty = $_SESSION['cart'][$product_id]['qty'];
                $product_total = $product_qty * $product_price;
                $total += $product_total;
            ?>
            <tr>
                <td><?php echo $product_name; ?></td>
                <td><?php echo $product_price; ?> €</td>
<td>
<form method="post" action="">
<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
<input type="number" name="product_qty" value="<?php echo $product_qty; ?>" min="0">
<input type="submit" name="update_qty" value="Mettre à jour">
</form>
</td>
<td><?php echo $product_total; ?> €</td>
</tr>
<?php endforeach; ?>
<tr>
<td colspan="3">Total</td>
<td><?php echo $total; ?> €</td>
</tr>
</tbody>
</table>
<form method="post" action="">
    <div class="payer">
        <input type="submit" name="checkout" value="Payer">
    </div>
</form>
<?php endif; ?>
</body>
</html>

