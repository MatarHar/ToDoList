<!--
 To-Do List 
 Piotr Tryfon
-->
<?php

require_once 'php/connect.php';

$itemsQuery = $db->prepare("
    SELECT id, name, done 
    FROM items
    WHERE user = :user
");

$itemsQuery->execute([
    'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo</title>
    <link href='http://fonts.googleapis.com/css?family=Advent+Pro&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <div class="main_container">
        <h1 class="header">To do.</h1>
        <?php if(!empty($items)): ?>
        <ul class="list_content">
        <?php foreach($items as $item): ?>
            <li>
                <span class="item<?php echo $item['done'] ? '_done' : '_not_done' ?>"><?php echo $item['name']; ?></span>
                <?php if($item['done']): ?>
                    <a href="mark.php?as=not_done&item=<?php echo $item['id']?>" class="done">Done</a>
                    <a href="mark.php?as=delete&item=<?php echo $item['id']?>" class="delete">DELETE</a>
                        <?php else: ?>
                    <a href="mark.php?as=done&item=<?php echo $item['id']?>" class="not_done">NotDone</a>
                    <a href="mark.php?as=delete&item=<?php echo $item['id']?>" class="delete">DELETE</a>
                    <?php endif ?>
            </li>
            <?php endforeach; ?>
        </ul>
            <?php else: ?>
                <p> You have not added any items yet.</p>
            <?php endif; ?>
        <form class="add_item" action="add.php" method="post">
            <input type="text" name="name" class="text_box" placeholder="Type something here">
            <input type="submit" value="Add to list" class="submit">
        </form>
    </div>
    <?php



    ?>
</body>
</html>