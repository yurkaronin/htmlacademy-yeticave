<?php
// Вначале подключим все необходимые файлы, которые понадобятся на этой странице
require_once('config.php');
require_once('init.php');
require_once('functions.php');
require_once('data.php');
require_once('models.php');

// если сайт включён - подключаем шаблоны
if ($config['enable']) {
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
}
else {
  $error_msg = "Сайт на техническом обслуживании";
  require_once($config['tpl_path'] . 'off.php');
};



// сохраняем в переменную результат работы функции 
// которая (Подключает шаблон, передает туда данные и возвращает итоговый HTML контент)
$page_content = include_template('404.php', [

]);


$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'product_categories' => $product_categories,
  'title' => '404 ошибка',

]);

print($layout_content);


?>