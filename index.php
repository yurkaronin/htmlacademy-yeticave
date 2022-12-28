<?php
require_once('init.php');
require_once('functions.php');
require_once('data.php');
require_once('models.php');

// Проверка соединения с БД
// если соединения нет - показываем код ошибки 
if (!$connect_db) {
    $error = mysqli_connect_error();
} else {
    // если нет ошибок > делаем запрос на получение категорий из БД 
    $sql = "SELECT character_code, name_category FROM categories";
    // полученный результат сохраняем в переменную
    $result = mysqli_query($connect_db, $sql);
    // если данные получены без ошибок
    if ($result) {
        // преобразуем полученные данные в двумерный массив
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // а если получили ошибку, то показываем сообщение об ошибке
    } else {
        $error = mysqli_error($connect_db);
    }
};

// сохраняем в переменную результат работы функции 
// которая (Подключает шаблон, передает туда данные и возвращает итоговый HTML контент)
$page_content = include_template('main.php', [
    'product_categories' => $product_categories,
    'product_items' => $product_items,
]);


$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'product_categories' => $product_categories,
    'title' => 'Главная',

]);

print($layout_content);


?>