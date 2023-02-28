<?php
require_once('Modele/Cart.php');
require_once('Modele/Product.php');
require_once('Vue/indexView.php');

class Controller
{
    private $cart;

    public function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->cart = unserialize($_SESSION['cart']);
        } else {
            $this->cart = new Cart();
        }
    }

    public function getProducts()
    {
        return Product::getAllProducts();
    }

    public function getCartItems()
    {
        return $this->cart->getItems();
    }

    public function getCartTotal()
    {
        return $this->cart->getTotal();
    }

    public function addToCart($product_id, $product_name, $product_price, $product_qty, $product_image)
    {
        $this->cart->addItem($product_id, $product_name, $product_price, $product_qty, $product_image);
        $_SESSION['cart'] = serialize($this->cart);
    }

    public function removeFromCart($product_id)
    {
        $this->cart->removeItem($product_id);
        $_SESSION['cart'] = serialize($this->cart);
    }

    public function clearCart()
    {
        $this->cart->clearCart();
        $_SESSION['cart'] = serialize($this->cart);
    }

    public function checkout()
    {
        // Traitement du paiement
        $this->clearCart();
    }
}
