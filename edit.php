<?php

require_once('./connection.php');

$id = $_GET['id'];

if ( isset($_POST['action']) && $_POST['action'] == 'Salvesta' ) {

    $stmt = $pdo->prepare('UPDATE books SET title = :title, price = :price WHERE id = :id');
    $stmt->execute(['id' => $id, 'title' => $_POST['title'], 'price' => $_POST['price'] ]);

    header("Location: ./book.php?id={$id}");

}

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="./edit.php?id=<?= $id; ?>" method="post">
        <label for="title">Pealkiri:</label>
        <input type="text" name="title" value="<?= $book['title'];?>">
        <br>
        <label for="price">Hind:</label>
        <input type="text" name="price" value="<?= $book['price'];?>">
        <br><br>
        <input type="submit" name="action" value="Salvesta">
    </form>
   
</body>
</html>