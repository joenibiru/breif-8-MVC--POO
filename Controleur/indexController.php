<?php
require_once('Modele/ArticleManager.php');


class IndexController {
    public function index() {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getArticles();
        require('Vue/indexView.php');
    }
}

