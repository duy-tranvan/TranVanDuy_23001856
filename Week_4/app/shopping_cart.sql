CREATE DATABASE IF NOT EXISTS shopping_cart CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE shopping_cart;

CREATE TABLE IF NOT EXISTS cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    price DECIMAL(12,2) NOT NULL DEFAULT 0
);

INSERT INTO cart_items (name, quantity, price) VALUES
('Oreo chocopie', 5, 25000),
('Xúc xích', 1, 150000),
('Dầu ăn', 1, 80000),
('Sữa rửa mặt', 2, 120000),
('Dầu gội đầu', 1, 132000),
('Gạo', 10, 17000);