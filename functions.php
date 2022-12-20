<?php

  function price_formatting($price) {
    // округляем
    $price = ceil($price);
    // Форматируем число со сгруппированными тысячами
    $price = number_format($price, 0, '', ' ');
    // объединяем со знаком рубля
    return "$price ₽";
  };
?>