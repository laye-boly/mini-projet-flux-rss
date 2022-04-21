<?php
$page = 1;
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
if (filter_has_var(INPUT_GET, 'page')) {

	$page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
	
} 
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
const PER_PAGE = 5;

$start = abs(($page - 1) * PER_PAGE);

if($page > 1 ) {
    $sql = "SELECT count(id) FROM article"; 
    $result = $pdo->query($sql); 
   
    $number_of_rows = $result->fetchColumn(); 

    if($start > $number_of_rows){
        echo json_encode(['satus' => "error", 'message' => "cet pas n'existe pas"]);
        die;
    }
    
}

if($page == 0){
    echo json_encode(['satus' => "error", 'message' => "cet pas n'existe pas"]);
    
    die;
}



// $lastIteration = 0
// if($start + PER_PAGE > $number_of_rows){
//     $lastIteration = 
// }
// $itemList = $dom->getElementsByTagName('item');

$sql = "SELECT * FROM article LIMIT ".PER_PAGE." OFFSET ".$start; 
$result = $pdo->query($sql);
$articles = [];
$articles['articles'] = [];
while (($row = $result->fetch()) !== false) {
    $article = [];
    $article ['id'] = $row['id'];
    $article ['title'] = $row['title'];
    $article ['extrait'] = $row['extrait'];
    $article ['img'] = $row['img'];
    $articles['articles'][]= $article;
}

// for ($i= $start; $i < $start + PER_PAGE; $i++) {
    
    
    // $titre = $itemList[$i]->getElementsByTagName('title');
    // if ($titre->length > 0) {
    //     $article['title'] = $titre->item(0)->nodeValue;
    // } 
    
    // $desc = $itemList[$i]->getElementsByTagName('description');
    // if ($desc->length > 0) {
    //     $article['extrait'] = $desc->item(0)->nodeValue;
    // }
    
    // $lien = $itemList[$i]->getElementsByTagName('link');
    // if ($lien->length >0) {
    //     $article['link'] = $lien->item(0)->nodeValue;
    // }


//     foreach($itemList[$i]->childNodes as $childNode) {
//         if($childNode->tagName == 'media:content') {
            
//             $article['image'] = $childNode->getAttribute('url');

//         }
//     }

//     $sql = 'insert into article(title, extrait, img)
//         values(?,?,?)';
    
//     $statement = $pdo->prepare($sql);
//     $statement->execute([$article['title'], $article['extrait'], $article['image']]);
    
//     $articles['articles'] = $article;
    
// }


$articles['status'] = 'success';
$articles['message'] = 'opération réussi';

echo json_encode($articles);

