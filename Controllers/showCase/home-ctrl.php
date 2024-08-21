<?php

$categories_articles = CategoryArticle::getAllCategoriesArticles();
$articles = Article::getRecentArticles(3);

renderView('showCase/home', compact('articles', 'categories_articles'));
