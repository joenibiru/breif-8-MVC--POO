<?php
require_once('Modele/article.php');

class ArticleManager {
    // Propriété qui stocke la connexion à la base de données
    private $bdd;

    // Constructeur de la classe
    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=breif-8;charset=utf8', 'root', '');
    }

    public function getArticles() {
        // Préparer la requête
        $requete = $this->bdd->prepare('SELECT * FROM article');
    
        // Exécuter la requête
        $requete->execute();
    
        // Récupérer les résultats sous forme d'objets Article
        $articles = [];
        while ($donnees = $requete->fetch()) {
            $articleItem = new Article();
            $articleItem->setId($donnees['id']);
            $articleItem->setNom($donnees['nom']);
            $articleItem->setCategorie($donnees['categorie']);
            $articleItem->setPrix($donnees['prix']);
            $articleItem->setDescription($donnees['description']);
            $articleItem->setStock($donnees['stock']);
            $articleItem->setPhoto($donnees['image']);
            $articles[] = $articleItem;
        }
    
        // Retourner les articles
        return $articles;
    }
}    