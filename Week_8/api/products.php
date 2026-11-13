<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// ---------- Cấu hình kết nối (sửa theo máy của bạn) ----------
const DB_HOST = 'localhost';
const DB_NAME = 'shop';
const DB_USER = 'root';
const DB_PASS = '';

// ---------- Hàm tiện ích ----------
function respond(int $status, bool $success, ?string $message = null, $data = null): void
{
    http_response_code($status);
    $body = ['success' => $success];
    if ($message !== null) {
        $body['message'] = $message;
    }
    if ($data !== null) {
        $body['data'] = $data;
    }
    echo json_encode($body, JSON_UNESCAPED_UNICODE);
    exit;
}

function fail(int $status, string $message): void
{
    respond($status, false, $message);
}

// Chuyển giá trị thành số nguyên, trả về null nếu không hợp lệ
function toInt($value): ?int
{
    if (is_int($value)) {
        return $value;
    }
    if (is_string($value) && preg_match('/^-?\d+$/', trim($value))) {
        return (int) trim($value);
    }
    return null;
}

// Kiểm tra dữ liệu name, price, stock; trả về mảng đã chuẩn hóa
function validateProduct($input): array
{
    if (!is_array($input)) {
        fail(400, 'Dữ liệu gửi lên phải là một đối tượng JSON.');
    }
    foreach (['name', 'price', 'stock'] as $field) {
        if (!array_key_exists($field, $input)) {
            fail(400, "Thiếu trường $field.");
        }
    }

    if (!is_string($input['name'])) {
        fail(400, 'Tên sản phẩm phải là chuỗi.');
    }
    // Bỏ khoảng trắng hai đầu (kể cả khoảng trắng Unicode)
    $name = preg_replace('/^\s+|\s+$/u', '', $input['name']);
    $len = mb_strlen($name, 'UTF-8');
    if ($len < 1 || $len > 100) {
        fail(400, 'Tên sản phẩm phải có từ 1 đến 100 ký tự.');
    }

    $price = toInt($input['price']);
    if ($price === null || $price <= 0) {
        fail(400, 'Đơn giá phải là số nguyên lớn hơn 0.');
    }

    $stock = toInt($input['stock']);
    if ($stock === null || $stock < 0) {
        fail(400, 'Tồn kho phải là số nguyên không âm.');
    }

    return ['name' => $name, 'price' => $price, 'stock' => $stock];
}

function readJsonBody()
{
    $raw = file_get_contents('php://input');
    if ($raw === false || trim($raw) === '') {
        fail(400, 'Thiếu dữ liệu JSON.');
    }
    $data = json_decode($raw, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        fail(400, 'JSON không hợp lệ.');
    }
    return $data;
}

function getIdFromUrl(): int
{
    if (!isset($_GET['id'])) {
        fail(400, 'Thiếu tham số id trên URL.');
    }
    $id = toInt($_GET['id']);
    if ($id === null || $id <= 0) {
        fail(400, 'id không hợp lệ.');
    }
    return $id;
}

function findProduct(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare('SELECT id, name, price, stock FROM products WHERE id = :id');
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    return $row === false ? null : $row;
}

// ---------- Xử lý request ----------
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    http_response_code(204);
    exit;
}

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );

    switch ($method) {
        case 'GET':
            $rows = $pdo->query('SELECT id, name, price, stock FROM products ORDER BY id')->fetchAll();
            respond(200, true, null, $rows);
            break;

        case 'POST':
            $p = validateProduct(readJsonBody());
            $stmt = $pdo->prepare(
                'INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)'
            );
            $stmt->execute([':name' => $p['name'], ':price' => $p['price'], ':stock' => $p['stock']]);
            $id = (int) $pdo->lastInsertId();
            respond(201, true, 'Thêm sản phẩm thành công.', findProduct($pdo, $id));
            break;

        case 'PUT':
            $id = getIdFromUrl();
            $p = validateProduct(readJsonBody());
            if (findProduct($pdo, $id) === null) {
                fail(404, "Không tìm thấy sản phẩm có id = $id.");
            }
            $stmt = $pdo->prepare(
                'UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id'
            );
            $stmt->execute([
                ':name'  => $p['name'],
                ':price' => $p['price'],
                ':stock' => $p['stock'],
                ':id'    => $id,
            ]);
            respond(200, true, 'Cập nhật sản phẩm thành công.', findProduct($pdo, $id));
            break;

        case 'DELETE':
            $id = getIdFromUrl();
            if (findProduct($pdo, $id) === null) {
                fail(404, "Không tìm thấy sản phẩm có id = $id.");
            }
            $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
            $stmt->execute([':id' => $id]);
            respond(200, true, 'Xóa sản phẩm thành công.');
            break;

        default:
            header('Allow: GET, POST, PUT, DELETE, OPTIONS');
            fail(405, 'Phương thức không được hỗ trợ.');
    }
} catch (PDOException $e) {
    // Không trả chi tiết lỗi DB ra ngoài; ghi vào log của server
    error_log('products.php DB error: ' . $e->getMessage());
    fail(500, 'Lỗi cơ sở dữ liệu.');
}