<?php
require_once('Modele/Cart.php');
require_once('Modele/Product.php');
require_once('Vue/indexView.php');
require_once('index.php');

class Controller
{
    private $cart;
    private $pdo;

    public function __construct()
    {
        if (isset($_SESSION['cart'])) {
            $this->cart = unserialize($_SESSION['cart']);
        } else {
            $this->cart = new Cart();
        }

        // Connexion à la base de données
        $host = 'localhost';
        $dbname = 'breif-8';
        $username = 'root';
        $password = '';
        $dsn = "mysql:host=$host;dbname=$dbname";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    public static function getAllProducts()
    {
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

        // Récupération des produits
        $stmt = $pdo->prepare('SELECT id, nom, description, prix, image FROM article');
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Création des objets Product
        $objects = [];
        foreach ($products as $product) {
            $objects[] = new Product($product['id'], $product['nom'], $product['description'], $product['prix'], $product['image']);
        }

        return $objects;
    }

    public function getProducts()
    {
        // Récupérer tous les produits
        $products = self::getAllProducts();

        // Retourner les produits
        return $products;
    }

 
    
    public function displayCart()
    {
        // Récupérer les articles dans le panier  
        $cart_items = $this->getCartItems(); 

        // Récupérer le total du panier
        $cart_total = $this->getCartTotal();

        include('Vue/indexView.php');
        $controller->displayCart(); 
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
        $cart_item = $this->cart->getItem($product_id);
        if ($cart_item !== null) {
            // Si l'article est déjà dans le panier,

            $product_qty += $cart_item['qty'];
            $this->cart->updateItem($product_id, $product_qty);
        } else {
            // Sinon, on ajoute le nouvel article au panier
            $this->cart->addItem($product_id, $product_name, $product_price, $product_qty, $product_image);
        }
        
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
