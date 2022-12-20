<?php
  $is_auth = rand(0, 1);
  $user_name = 'Рональд Курочкин';

  require_once('helpers.php');
  require_once('functions.php');
  require_once('data.php');

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