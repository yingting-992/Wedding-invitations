<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1️⃣ 連接資料庫
$host = "localhost"; 
$user = "root";      
$pass = "";          
$dbname = "marry"; 
$conn = new mysqli($host, $user, $pass, $dbname);

// 檢查連線
if ($conn->connect_error) {
    die("資料庫連線失敗：" . $conn->connect_error);
}

// 2️⃣ 接收表單資料
$name = $_POST["user_name"];
$email = $_POST["user_mail"];
$type = $_POST["user_type"];
$attend = isset($_POST["attend"]) ? $_POST["attend"] : "未選擇"; 
$message = $_POST["message"];
$allergy = isset($_POST["allergy"]) ? implode(", ", $_POST["allergy"]) : "無";

// 3️⃣ 檢查 Email 是否已存在
$checkEmail = $conn->prepare("SELECT email FROM rsvp WHERE email = ?");
$checkEmail->bind_param("s", $email);
$checkEmail->execute();
$checkEmail->store_result();

if ($checkEmail->num_rows > 0) {
    // 4️⃣ 如果 Email 已存在 -> 更新資料
    $stmt = $conn->prepare("UPDATE rsvp SET name=?, type=?, attend=?, allergy=?, message=? WHERE email=?");
    $stmt->bind_param("ssssss", $name, $type, $attend, $allergy, $message, $email); # s 代表字串（string），將 $email 安全綁定 到查詢中。
    $stmt->execute(); # 執行 SQL 查詢。
    echo "<script>alert('資料已更新！'); window.location.href='index.html';</script>"; # store_result(); 暫存查詢結果，用來檢查 Email 是否存在。

} else {
    // 5️⃣ 如果 Email 不存在 -> 新增資料
    $stmt = $conn->prepare("INSERT INTO rsvp (name, email, type, attend, allergy, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $type, $attend, $allergy, $message);
    $stmt->execute();
    echo "<script>alert('資料已新增！'); window.location.href='index.html';</script>";
}

#關閉 MySQL 連線
$checkEmail->close();
$stmt->close();
$conn->close();