<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
$page = 1;
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
    echo json_encode(['status' => "error", 'message' => $e->getMessage()]);
    
    die();
}
const PER_PAGE = 5;

$start = abs(($page - 1) * PER_PAGE);

if($page > 1 ) {
    $sql = "SELECT count(id) FROM article"; 
    $result = $pdo->query($sql); 
   
    $number_of_rows = $result->fetchColumn(); 

    if($start > $number_of_rows){
        echo json_encode(['status' => "error", 'message' => "cette page n'existe pas"]);
        die();
    }
    
}

if($page == 0){
    echo json_encode(['status' => "error", 'message' => "cet page n'existe pas"]);
    
    die();
}



try {
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
    $articles['status'] = 'success';
    $articles['message'] = 'opération réussi';
    echo json_encode($articles);
    die();
}catch(PDOException $e){
	echo json_encode(['status' => 'erreur', 'message' => $e->getMessage()]);
    die();

}








