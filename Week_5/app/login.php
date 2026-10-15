<?php
require_once 'common/auth.php';
require_once 'model/user.php';

// Đã đăng nhập thì không cần vào trang này nữa
if (isLoggedIn()) {
    header('Location: product_list.php');
    exit;
}

$errors = [];
$username = '';
$message = isset($_GET['registered']) ? 'Đăng ký thành công. Vui lòng đăng nhập.' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errors[] = 'Vui lòng nhập tên đăng nhập và mật khẩu.';
    } else {
        $user = getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);   // chống session fixation
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: product_list.php');
            exit;
        }
        // Dùng chung một thông báo để không lộ tên đăng nhập có tồn tại hay không
        $errors[] = 'Tên đăng nhập hoặc mật khẩu không đúng.';
    }
}

include 'view/header.php';
?>
<h2>Đăng nhập</h2>

<?php if ($message): ?>
    <p style="color:green"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php foreach ($errors as $e): ?>
    <p class="error"><?= htmlspecialchars($e) ?></p>
<?php endforeach; ?>

<form method="post">
    <label>Tên đăng nhập</label>
    <input type="text" name="username" value="<?= htmlspecialchars($username) ?>">

    <label>Mật khẩu</label>
    <input type="password" name="password">

    <button type="submit">Đăng nhập</button>
    <a href="register.php">Đăng ký tài khoản</a>
</form>
<?php include 'view/footer.php'; ?>