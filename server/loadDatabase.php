<?php

$fichier = 'https://www.lemonde.fr/rss/en_continu.xml';
$dom = new DOMDocument();
$articles = [];
if (!$dom->load($fichier)) {
    echo json_encode(['status' => 'impossible de récuprer les articles, réessayez plus tard']);
    die;
}

$itemList = $dom->getElementsByTagName('item');
$pdo = null;

try {
    $host = 'localhost';
    $news = "news";
    $user = 'root';
    $password = '';
    $dsn = "mysql:host=$host;dbname=$news;charset=UTF8";
	$pdo = new PDO($dsn, $user, $password);
    
} catch (PDOException $e) {
	echo $e->getMessage();
}

foreach ($itemList as $item) {
    $article = [];
    
    $titre = $item->getElementsByTagName('title');
    if ($titre->length > 0) {
        $article['title'] = $titre->item(0)->nodeValue;
        echo $article["title"];
    } 
    
    $desc = $item->getElementsByTagName('description');
    if ($desc->length > 0) {
        $article['extrait'] = $desc->item(0)->nodeValue;
    }


    foreach($item->childNodes as $childNode) {
        if($childNode->tagName == 'media:content') {
            
            $article['image'] = $childNode->getAttribute('url');

        }
    }

    $sql = 'insert into article(title, extrait, img)
        values(?,?,?)';
    
    $statement = $pdo->prepare($sql);
    $statement->execute([$article['title'], $article['extrait'], $article['image']]);
    
    $articles['articles'] = $article;
    
}


$articles['status'] = 'success';

echo json_encode($articles);

