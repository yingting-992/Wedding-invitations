# 邀請函專案

## 📌 專案介紹
這是一個 **婚禮邀請函** 網站，讓使用者填寫 RSVP（回覆邀請）表單，並將資料儲存至 MySQL 資料庫。支援 **表單資料去重**（根據 Email 更新或新增）。

## 🚀 功能列表
- **RSVP 表單**：
  - 使用者可以填寫姓名、Email、參加/不參加、過敏食物、留言。
  - Email 唯一，重新提交時會更新資料。
- **資料儲存到 MySQL**（phpMyAdmin）：
  - 透過 PHP 連接 MySQL，確保 Email 不重複。

## 📁 專案結構
```
📂 邀請函
 ├── 📄 index.html    # 前端邀請函頁面
 ├── 📄 index.php     # 處理表單並儲存 MySQL
 ├── 📄 style.css     # 網站樣式表
 ├── 📄 README.md     # 本說明文件
 ├── 📂 images        # 存放圖片資源
 ├── 📂 css           # 額外 CSS 樣式
 ├── 📂 js            # JavaScript 資料夾（未來擴展）
```

## 🔧 安裝與設定
### **1️⃣ 環境需求**
- XAMPP 或 WAMP 伺服器（提供 PHP & MySQL）
- 瀏覽器（Chrome / Edge / Firefox）
- Git（可選）

### **2️⃣ 設置資料庫（phpMyAdmin）**
1. 進入 `phpMyAdmin`，選擇你的資料庫 `marry`。
2. 執行以下 SQL 指令來建立 `rsvp` 表：
```sql
CREATE TABLE rsvp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    type VARCHAR(50),
    attend VARCHAR(20),
    allergy TEXT,
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```
3. 確保 `email` 欄位是 **UNIQUE**，避免重複提交。

### **3️⃣ 啟動本機伺服器**
1. 開啟 XAMPP（或 WAMP），啟動 `Apache` 和 `MySQL`。
2. 在瀏覽器輸入：
   ```
   http://localhost/邀請函/index.html
   ```
3. 填寫表單，測試提交資料。

## 🎯 測試方式
1. **首次提交** → 應新增一筆資料。
2. **相同 Email 再次提交** → 應更新該 Email 的資訊，而非新增。
3. **進入 phpMyAdmin 檢查 `rsvp` 表**，確保資料正確寫入。

## 🛠️ 技術細節
- **前端**：HTML、CSS、JavaScript。
- **後端**：PHP 處理表單，與 MySQL 互動。
- **資料庫**：MySQL（透過 phpMyAdmin 管理）。

## 📜 版權聲明
本專案僅供學習與示範使用，所有內容皆為示範用途。

---

📌 **開發者可根據需求進行修改與擴展，若有問題，歡迎提交 Issue！** 🎉

