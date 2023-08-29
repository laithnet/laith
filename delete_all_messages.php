<?php
// اتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laith";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// إعداد استعلام SQL لحذف جميع الرسائل
$sql = "DELETE FROM message";

// تنفيذ الاستعلام
if ($conn->query($sql) === TRUE) {
    echo "تم حذف جميع الرسائل بنجاح.";
} else {
    echo "حدث خطأ أثناء حذف الرسائل: " . $conn->error;
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>