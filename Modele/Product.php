<?php
require_once('Vue/indexView.php');
class Product
{
    private $id;
    private $nom;
    private $description;
    private $prix;
    private $image;

    public function __construct($id, $nom, $description, $prix, $image)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->image = $image;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getImage()
    {
        return $this->image;
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
}
