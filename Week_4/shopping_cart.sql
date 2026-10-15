CREATE DATABASE IF NOT EXISTS shopping_cart CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE shopping_cart;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL
);

INSERT INTO products (name, price, quantity) VALUES
('Oreo chocopie', 25000, 5),
('Xúc xích', 150000, 1),
('Dầu ăn', 80000, 1),
('Sữa rửa mặt', 120000, 2),
('Dầu gội đầu', 132000, 1),
('Gạo', 17000, 10);