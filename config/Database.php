<?php
// قاعدة البيانات والاتصال باستخدام PDO
class Database {
    private $host = "localhost";       // اسم السيرفر
    private $db_name = "crud_mvc";     // اسم قاعدة البيانات
    private $username = "root";        // اسم المستخدم
    private $password = "";            // كلمة المرور
    public $conn;

    // دالة الاتصال وإرجاع كائن PDO
    public function getConnection(){
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name};charset=utf8",
                $this->username,
                $this->password
            );
            // ضبط خصائص PDO لتسهيل التعامل مع الأخطاء
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception){
            echo "خطأ في الاتصال بقاعدة البيانات: " . $exception->getMessage();
            exit;
        }
        return $this->conn;
    }
}
