<?php
require_once('init.php');
require_once('functions.php');
require_once('data.php');
require_once('models.php');

// Проверка соединения с БД
if (!$connect_db) {
    $error = mysqli_connect_error();
} else {
    $sql = "SELECT character_code, name_category FROM categories";
    $result = mysqli_query($connect_db, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($connect_db);
    }
};

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