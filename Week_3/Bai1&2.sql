DROP DATABASE IF EXISTS shopping_cart;

CREATE DATABASE shopping_cart;

USE shopping_cart;

CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VarCHar(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL
);

INSERT INTO cart_items (name, price, quantity)
VALUES
    ('Oreo chocopie', 20000, 2),
    ('Vinamilk', 10000, 8),
    ('Xúc xích', 150000, 1),
    ('Dầu ăn', 80000, 1),
    ('Sữa rửa mặt', 120000, 2),
    ('Dầu gội đầu', 132000, 1),
    ('Gạo', 17000, 10);
    
SELECT * FROM cart_items;

SELECT * 
FROM cart_items 
where price > 100000;

SELECT *
From cart_items 
where quantity > 5;

SELECT * 
From cart_items 
ORDER by price DESC;

UPDATE cart_items
Set price = 25000
WHERE name = 'Oreo chocopie';


UPDATE cart_items
Set quantity = 5
WHERE name = 'Oreo chocopie';

DELETE FROM cart_items
WHERE name = 'Vinamilk';


SELECT name as 'Tên sản phẩm',
		price as 'Giá',
        quantity as 'Số lượng',
        price*quantity as 'Thành tiền'
From cart_items;


SELECT sum(price*quantity) as 'Tổng tiền'
FROM cart_items;







DROP DATABASE IF EXISTS movie_utils;

CREATE DATABASE movie_utils;

USE movie_utils;

CREATE TABLE movies(
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VarCHar(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    total_seats int not null,
    available_seats int not null
    );
INSERT INTO movies (title, price, total_seats, available_seats)
VALUES
    ('Avengers: Endgame', 120000, 100, 30),
    ('Spider-Man: No Way Home', 150000, 120, 40),
    ('Doraemon', 80000, 80, 60),
    ('Fast & Furious 10', 110000, 150, 50),
    ('The Batman', 130000, 100, 20),
    ('Interstellar', 100000, 90, 70);

SELECT * FROM movies;

SELECT *
FROM movies
WHERE price > 100000;

SELECT *
FROM movies
WHERE available_seats > 50;

SELECT *
FROM movies
ORDER BY price DESC;

UPDATE movies
SET available_seats = 45
WHERE title = 'Doraemon';

DELETE FROM movies
WHERE title = 'The Batman';

SELECT
    title AS 'Tên phim',
    total_seats - available_seats AS 'Vé đã bán'
FROM movies;

SELECT
    title AS 'Tên phim',
    (total_seats - available_seats) * price AS 'Doanh thu'
FROM movies;

SELECT
    SUM((total_seats - available_seats) * price) AS 'Tổng doanh thu'
FROM movies;

SELECT
    title AS 'Tên phim',
    total_seats - available_seats AS 'Vé đã bán'
FROM movies
ORDER BY (total_seats - available_seats) DESC
LIMIT 1;