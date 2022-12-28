<?php
$is_auth = rand(0, 1);
$user_name = 'Рональд Курочкин';

// соединение с БД 
$connect_db = mysqli_connect("localhost", "root", "", "yeticave");
mysqli_set_charset($connect_db, "utf8");

?>