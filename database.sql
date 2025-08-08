-- إنشاء قاعدة بيانات باسم crud_mvc
CREATE DATABASE IF NOT EXISTS crud_mvc CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE crud_mvc;

-- إنشاء جدول posts
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

