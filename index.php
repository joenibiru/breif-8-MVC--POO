<?php
require_once('Controleur/Controller.php');
require_once('Modele/Cart.php');
require_once('Modele/Product.php');
require_once('Vue/indexView.php');

// Instancier un objet Controller
$controller = new Controller();

// Récupérer les éléments du panier
$cart_items = $controller->getCartItems();

// Récupérer le total du panier
$cart_total = $controller->getCartTotal();

?>

<div class="row mt-5">
    <div class="col-md-6">
        <h4>Panier</h4>
        <?php if (!empty($cart_items)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Produit</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $product_id => $product): ?>
                        <tr>
                            <td>
                                <?php echo $product['nom']; ?>
                            </td>
                            <td>
                                <?php echo $product['prix']; ?> €
                            </td>
                            <td>
                                <?php echo $product['qty']; ?>
                            </td>
                            <td>
                                <?php echo $product['prix'] * $product['qty']; ?> €
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                    <button type="submit" class="btn btn-danger" name="remove_from_cart">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Total :</strong></td>
                        <td colspan="2">
                            <?php echo $cart_total; ?> €
                        </td>
                    </tr>
                </tbody>
            </table>
            <form method="POST">
                <button type="submit" class="btn btn-primary" name="checkout">Payer</button>
            </form>
        <?php else: ?>
            <p>Votre panier est vide</p>
        <?php endif; ?>
    </div>
</div>

