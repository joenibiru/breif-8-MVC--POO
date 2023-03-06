<?php
session_start();

require_once ('Controleur/Controller.php');
require_once ('Modele/Cart.php');
require_once ('Modele/Product.php'); 
require_once('Vue/indexView.php'); 

$controller = new Controller();

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

if (isset($_POST['clear_cart'])) {
    $controller->clearCart();
}

if (isset($_POST['checkout'])) {
    $controller->checkout();
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'index';
}

switch ($action) {
    case 'index':
        $products = $controller->getAllProducts();
        require_once 'Vue/indexView.php';
        break;
    case 'cart':
        $cart_items = $controller->getCartItems();
        $cart_total = $controller->getCartTotal();
        require_once 'Vue/indexView.php';
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        echo 'Page not found';
        break;
}

