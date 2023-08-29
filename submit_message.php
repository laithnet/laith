<?php
// Establish a database connection



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laith";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    echo "عذرا هنالك خلل في السيرفر رسالتك لم تصل ";
}

// Get the form data
$name = $_POST['name'];
$message = $_POST['message'];
$sql = "INSERT INTO `message`(`name`, `message`)  VALUES ('$name', '$message')";


// Insert the message into the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            font-size: large;

        }
    </style>
</head>
<body>
    
</body>
</html>
<?php 
if ($conn->query($sql) === TRUE) {
    echo "<p>" . "تم ارسال رسالتك بنجاح يمكنك الرجوع والتصفح" ."</p>";
} else {
    echo "عذرا هنالك خلل في السيرفر رسالتك لم تصل ";
}

$conn->close();
?>