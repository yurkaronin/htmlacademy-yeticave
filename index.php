<?php
  $is_auth = rand(0, 1);
  $user_name = 'Рональд Курочкин';

  require_once('helpers.php');
  require_once('functions.php');
  require_once('data.php');
  require_once('init.php');
  require_once('models.php');

  // Проверка соединения с БД 
  if (!$con) {
    $error = mysqli_connect_error();
} else {
    $sql = "SELECT character_code, name_category FROM categories";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($con);
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