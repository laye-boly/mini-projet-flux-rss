<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: Content-Type');
$title = '';
$extrait = '';
$id = 0;
// echo json_encode([
//     'status' => 'erreur',
//     'message' => "le titre ou l'extrait ou l'id n'est pas correct"
// ]);

// die();
if (filter_has_var(INPUT_POST, 'title')) {

	$title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   
}

if (filter_has_var(INPUT_POST, 'extrait')) {

	$extrait = filter_var($_POST['extrait'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
	
}

if (filter_has_var(INPUT_POST, 'id')) {

	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	
}




if($title == false || $extrait == false || $id == false){
    echo json_encode([
        'status' => 'erreur',
        'message' => "le titre ou l'extrait ou l'id n'est pas correct"
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

    $sql = 'UPDATE article SET title = :title, extrait = :extrait WHERE id = :id';
    $req = $pdo->prepare($sql);
    $title = htmlspecialchars($_POST['title']);
    $id = htmlspecialchars($_POST['id']);
    $extrait = htmlspecialchars($_POST['extrait']);
    $req->execute(array(

       'title' => $title,

       'extrait' => $extrait,

       'id' => $id

       ));

    echo json_encode([
        'id' => $id,
        'title' => $title,
        'extrait' => $extrait,
        'status' => 'success'
    ]);
    die();
    
} catch (PDOException $e) {
	echo json_encode(['status' => 'erreur', 'message' => $e->getMessage()]);
}