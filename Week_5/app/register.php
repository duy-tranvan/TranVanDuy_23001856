<?php
require_once 'common/auth.php';
require_once 'model/user.php';
require_once 'common/helpers.php';

if (isLoggedIn()) {
    header('Location: product_list.php');
    exit;
}

$errors = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '') {
        $errors[] = 'Tên đăng nhập không được để trống.';
    } elseif (textLength($username) > 50) {
        $errors[] = 'Tên đăng nhập không được quá 50 ký tự.';
    }
    if ($password === '') {
        $errors[] = 'Mật khẩu không được để trống.';
    }

    // Kiểm tra tên đăng nhập chưa tồn tại
    if (!$errors && getUserByUsername($username)) {
        $errors[] = 'Tên đăng nhập đã tồn tại.';
    }

    if (!$errors) {
        if (addUser($username, $password)) {
            header('Location: login.php?registered=1');
            exit;
        }
        $errors[] = 'Đăng ký thất bại, vui lòng thử lại.';
    }
}

include 'view/header.php';
?>
<h2>Đăng ký</h2>

<?php foreach ($errors as $e): ?>
    <p class="error"><?= htmlspecialchars($e) ?></p>
<?php endforeach; ?>

<form method="post">
    <label>Tên đăng nhập</label>
    <input type="text" name="username" value="<?= htmlspecialchars($username) ?>">

    <label>Mật khẩu</label>
    <input type="password" name="password">

    <button type="submit">Đăng ký</button>
    <a href="login.php">Đã có tài khoản? Đăng nhập</a>
</form>
<?php include 'view/footer.php'; ?>