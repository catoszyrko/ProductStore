<?php
    include_once('../inc/dbconfig.php');
    include_once('../inc/class.crud.article.php');

    $article = new ARTICLE;

    if($_REQUEST['action']=="read"){
        $results = $article->read($link);
        foreach($results as $result){
            $new_array[] = $result;
        }
        $result = json_encode($new_array);
    }

    if($_REQUEST['action']=="find"){
        $id = $_REQUEST['id'];
        $result = $article->find($link, $id);  
        $result = json_encode($result);
    }

    if($_GET['action']=="add"){
        $article->create($link,$_POST['nombre'],$_POST['sku'],$_POST['marca'], $_POST['costo'], $_POST['categoria'], $_POST['detail_1'], $_POST['detail_2']);
    }


?>
<?=$result?>


       
        
