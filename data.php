<?php
  // ассоциативный массив категорий 
$product_categories = array(
  "boards"=>"Доски и лыжи",
  "attachment"=>"Крепления",
  "boots"=>"Ботинки",
  "clothing"=>"Одежда",
  "tools"=>"Инструменты",
  "other"=>"Разное",
);

// двумерный массив объявлений 
$product_items = [
  [
    "title" => "2014 Rossignol District Snowboard",
    "category" => $product_categories["boards"],
    "price" => 10999,
    "photo" => "./img/lot-1.jpg",
  ],
  [
    "title" => "DC Ply Mens 2016/2017 Snowboard",
    "category" => $product_categories["boards"],
    "price" => 159999,
    "photo" => "./img/lot-2.jpg",
  ],
  [
    "title" => "Крепления Union Contact Pro 2015 года размер L/XL",
    "category" => $product_categories["attachment"],
    "price" => 8000,
    "photo" => "./img/lot-3.jpg",
  ],
  [
    "title" => "Ботинки для сноуборда DC Mutiny Charocal",
    "category" => $product_categories["boots"],
    "price" => 10999,
    "photo" => "./img/lot-4.jpg",
  ],
  [
    "title" => "Куртка для сноуборда DC Mutiny Charocal",
    "category" => $product_categories["clothing"],
    "price" => 7500,
    "photo" => "./img/lot-5.jpg",
  ],
  [
    "title" => "Маска Oakley Canopy",
    "category" => $product_categories["other"],
    "price" => 7500,
    "photo" => "./img/lot-6.jpg",
  ],
  
];
?>