<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
if (filter_has_var(INPUT_GET, 'id')) {

	$id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    if($id == false){
        echo json_encode([
            'status' => 'erreur',
            'message' => "l'id n'est pas correct"
        ]);
    
        die();
    }

    try {
        $host = 'localhost';
        $news = "news";
        $user = 'root';
        $password = '';
        $dsn = "mysql:host=$host;dbname=$news;charset=UTF8";
        $pdo = new PDO($dsn, $user, $password);
        $sql = "SELECT * FROM article WHERE id = :id"; 
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);
        $data = [];
        $row = $statement->fetch();
        $article = [];
        $article ['id'] = $row['id'];
        $article ['title'] = $row['title'];
        $article ['extrait'] = $row['extrait'];
        $article ['img'] = $row['img'];
        $data['article'] = $article;
        $data['status'] = 'success';
        echo json_encode($data);
        die();
        
    } catch (PDOException $e) {
        echo json_encode(['satus' => "error", 'message' => $e->getMessage()]);
        die;
       
    }
	
} 


