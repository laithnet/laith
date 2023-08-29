<?php
// استقبال بيانات تسجيل الدخول
$username = $_POST['username'];
$password = $_POST['password'];

if ($username === 'laith' && $password === 'net') {
    header('Location: admin_messages.php');
    exit();
} else {
    echo 'اسم المستخدم أو كلمة المرور غير صحيحة.';
}
?>