-- План работы
-- 1. Сперва напишите SQL-код для создания новой базы данных с именем вашего проекта.
-- 2. Напишите SQL-код для создания всех необходимых таблиц.
-- 3. Добавьте уникальные индексы полям, где должны быть только уникальные значения.
-- 4. Добавьте обычные индексы полям, по которым будет происходить поиск.

-- Если у нас уже есть БД с таким именем - удалить её
DROP DATABASE IF EXISTS yeticave;
-- создать новую БД 
CREATE DATABASE yeticave
-- задаём кодировку БД 
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
-- указываем к какой именно базе обращаемся для создания таблиц 
USE yeticave;

-- создаём таблицу Категорий 
CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  character_code VARCHAR(128) UNIQUE,
  name_category VARCHAR(128)
);
-- Таблица пользователей 
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_registration TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  email VARCHAR(128) NOT NULL UNIQUE,
  user_name VARCHAR(128),
  user_password CHAR(255),
  contacts TEXT
);
-- Таблица Лотов (товаров) 
CREATE TABLE lots (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  title VARCHAR(255),
  lot_description TEXT,
  img VARCHAR(255),
  start_price INT,
  date_finish DATE,
  step INT,
  user_id INT,
  winner_id INT,
  category_id INT,
  -- Прописываем связи (не обязательно)
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (winner_id) REFERENCES users(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)
);
-- Таблица ставок 
CREATE TABLE bets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_bet TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  price_bet INT,
  user_id INT,
  lot_id INT,
  -- Прописываем связи (не обязательно)
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (lot_id) REFERENCES lots(id)
);
