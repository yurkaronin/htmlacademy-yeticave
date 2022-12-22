<?php

/**
 * Проверяет переданную дату на соответствие формату 'ГГГГ-ММ-ДД'
 *
 * Примеры использования:
 * is_date_valid('2019-01-01'); // true
 * is_date_valid('2016-02-29'); // true
 * is_date_valid('2019-04-31'); // false
 * is_date_valid('10.10.2010'); // false
 * is_date_valid('10/10/2010'); // false
 *
 * @param string $date Дата в виде строки
 *
 * @return bool true при совпадении с форматом 'ГГГГ-ММ-ДД', иначе false
 */
function is_date_valid(string $date) : bool {
  $format_to_check = 'Y-m-d';
  $dateTimeObj = date_create_from_format($format_to_check, $date);

  return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = []) {
  $stmt = mysqli_prepare($link, $sql);

  if($stmt === false) {
    $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
    die($errorMsg);
  }

  if($data) {
    $types = '';
    $stmt_data = [];

    foreach($data as $value) {
      $type = 's';

      if(is_int($value)) {
        $type = 'i';
      } else if(is_string($value)) {
        $type = 's';
      } else if(is_double($value)) {
        $type = 'd';
      }

      if($type) {
        $types .= $type;
        $stmt_data[] = $value;
      }
    }

    $values = array_merge([$stmt, $types], $stmt_data);

    $func = 'mysqli_stmt_bind_param';
    $func(...$values);

    if(mysqli_errno($link) > 0) {
      $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
      die($errorMsg);
    }
  }

  return $stmt;
}

/**
 * Возвращает корректную форму множественного числа
 * Ограничения: только для целых чисел
 *
 * Пример использования:
 * $remaining_minutes = 5;
 * echo "Я поставил таймер на {$remaining_minutes} " .
 *     get_noun_plural_form(
 *         $remaining_minutes,
 *         'минута',
 *         'минуты',
 *         'минут'
 *     );
 * Результат: "Я поставил таймер на 5 минут"
 *
 * @param int $number Число, по которому вычисляем форму множественного числа
 * @param string $one Форма единственного числа: яблоко, час, минута
 * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
 * @param string $many Форма множественного числа для остальных чисел
 *
 * @return string Рассчитанная форма множественнго числа
 */
function get_noun_plural_form(int $number, string $one, string $two, string $many) : string {
  $number = (int)$number;
  $mod10 = $number % 10;
  $mod100 = $number % 100;

  switch(true) {
    case ($mod100 >= 11 && $mod100 <= 20):
      return $many;

    case ($mod10 > 5):
      return $many;

    case ($mod10 === 1):
      return $one;

    case ($mod10 >= 2 && $mod10 <= 4):
      return $two;

    default:
      return $many;
  }
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template($name, array $data = []) {
  $name = 'templates/' . $name;
  $result = '';

  if(!is_readable($name)) {
    return $result;
  }

  ob_start();
  extract($data);
  require $name;

  $result = ob_get_clean();

  return $result;
}

function price_formatting($price) {
  // округляем
  $price = ceil($price);
  // Форматируем число со сгруппированными тысячами
  $price = number_format($price, 0, '', ' ');
  // объединяем со знаком рубля
  return "$price ₽";
}

// $date - дата закрытия торгов по лоту
// $res - функция возвращает массив

function get_dt_range($date) {
  // указываем в каком часовом поясе работает сервер
  date_default_timezone_set('Europe/Moscow');
  // финальная дата - принимает значение из нашей переменной и Создаёт новый объект DateTime
  $final_date = date_create($date);
  // print_r($final_date);
  // текущая дата - принимает значение из нашей переменной и Создаёт новый объект DateTime
  $cur_date = date_create("now");
  // print_r($cur_date );
  // находит разницу между двумя датами. Даты при этом должны быть объектами, созданными функцией date_create.

  if($final_date < $cur_date) {
    return ['00', '00'];

  } else {
    $diff = date_diff($final_date, $cur_date);
    // print_r($diff );
    // Форматирует интервал
    // d	День месяца, 2 цифры с ведущим нулём
    // H	Часы в 24-часовом формате с ведущим нулём
    // i	Минуты с ведущим нулём
    // I (заглавная i)	Признак летнего времени
    $format_diff = date_interval_format($diff, "%d %H %i");

    // Разбивает строку с помощью разделителя в нашем случае - пробел
    $arr = explode(" ", $format_diff);

    // работаем с полученным массивом
    // первый элемент массива - дни - умножаем на 24, получаем кол-во часов и прибавляем второй элемент массива -часы - получаем общее кол-во часов
    $hours = $arr[0] * 24 + $arr[1];
    // третий элемент массива - минуты
    // intval - Возвращает целое значение переменной
    $minutes = intval($arr[2]);

    // форматируем полученные данные

    // возвращает строку string, дополненную слева, справа или с обеих сторон до заданной длины.
    // Если необязательный аргумент pad_string не передан, то string будет дополнен пробелами, иначе он будет дополнен символами из pad_string до нужной длины.
    $hours = str_pad($hours, 2, "0", STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, "0", STR_PAD_LEFT);

    $res[] = $hours;
    $res[] = $minutes;
  }

  // сохраняем в массив $res полученные и обработанные данные
  return $res;
}


?>