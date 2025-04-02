<?php
session_start();

$likeFile = 'likes.txt'; // Файл для хранения количества лайков

// Функция для получения количества лайков
function getLikes($file) {
    if (file_exists($file)) {
        return (int)file_get_contents($file);
    }
    return 0;
}

// Функция для сохранения количества лайков
function saveLikes($file, $likes) {
    file_put_contents($file, $likes);
}

// Получаем текущее количество лайков
$likes = getLikes($likeFile);

// Обработка запроса на лайк или анлайк
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['like'])) {
        // Постановка лайка
        $likes++;
    } elseif (isset($_POST['unlike'])) {
        // Снятие лайка
        if ($likes > 0) {
            $likes--;
        }
    }

    // Сохраняем обновленное количество лайков
    saveLikes($likeFile, $likes);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лайки</title>
</head>
<body>
    <h1>Количество лайков: <?= $likes ?></h1>

    <form method="post">
        <button type="submit" name="like">Поставить лайк</button>
        <button type="submit" name="unlike">Снять лайк</button>
    </form>
</body>
</html>