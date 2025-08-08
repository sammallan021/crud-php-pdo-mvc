<?php
class Post {
    private $conn;           // اتصال قاعدة البيانات
    private $table_name = "posts";

    public $id;
    public $title;
    public $body;
    public $created_at;

    // استدعاء الاتصال عند إنشاء الكائن
    public function __construct($db){
        $this->conn = $db;
    }

    // قراءة كل التدوينات مرتبة حسب الأحدث أولاً
    public function read(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt; // إرجاع البيان لقراءته في الكونترولر
    }

    // قراءة تدوينة واحدة بواسطة ID
    public function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // إنشاء تدوينة جديدة
    public function create(){
        $query = "INSERT INTO " . $this->table_name . " (title, body) VALUES (:title, :body)";
        $stmt = $this->conn->prepare($query);

        // حماية البيانات من XSS بإزالة الوسوم الضارة (يمكن إضافة htmlspecialchars عند العرض)
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);

        return $stmt->execute();
    }

    // تحديث تدوينة
    public function update(){
        $query = "UPDATE " . $this->table_name . " SET title = :title, body = :body WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // حذف تدوينة
    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
