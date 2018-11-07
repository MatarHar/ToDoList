<?php

require_once 'php/connect.php';

if(isset($_POST['name'])){
    $name = trim($_POST['name']);

    if(!empty($name)){
        $addedQuery = $db->prepare ("
        INSERT INTO items (name, user, done, created)
        VALUES (:name, :user, 1, 20-20-1000)
        ");

        $addedQuery -> execute([
            'name' => $name,
            'user' => $_SESSION['user_id']
        ]);
    }
}

header("Location: index.php");
?>