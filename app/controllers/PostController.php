<?php
require_once '../config/Database.php';
require_once '../app/models/Post.php';

class PostController {
    private $db;
    private $post;
    public $errors = [];  // مصفوفة لتخزين الأخطاء في التحقق

    public function __construct(){
        // إنشاء اتصال بقاعدة البيانات وإنشاء نموذج Post
        $database = new Database();
        $this->db = $database->getConnection();
        $this->post = new Post($this->db);
    }

    // صفحة عرض كل التدوينات
    public function index(){
        $posts = $this->post->read();
        $view = '../app/views/posts/index.php';
        include '../app/views/layouts/main.php';
    }

    // صفحة إنشاء تدوينة جديدة + معالجة POST
    public function create(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // جلب البيانات من الفورم
            $title = trim($_POST['title']);
            $body = trim($_POST['body']);

            // تحقق من صحة البيانات (Validation)
            if(empty($title)){
                $this->errors['title'] = 'عنوان التدوينة مطلوب.';
            } elseif(strlen($title) > 255){
                $this->errors['title'] = 'عنوان التدوينة يجب ألا يزيد عن 255 حرف.';
            }

            if(empty($body)){
                $this->errors['body'] = 'محتوى التدوينة مطلوب.';
            }

            // إذا لا توجد أخطاء، نحفظ التدوينة
            if(empty($this->errors)){
                $this->post->title = $title;
                $this->post->body = $body;
                if($this->post->create()){
                    header("Location: index.php");
                    exit;
                } else {
                    $this->errors['general'] = "حدث خطأ أثناء حفظ التدوينة.";
                }
            }
        }

        $view = '../app/views/posts/create.php';
        include '../app/views/layouts/main.php';
    }

    // صفحة تعديل تدوينة + معالجة POST
    public function edit($id){
        $this->post->id = $id;
        $post_data = $this->post->readOne();

        if(!$post_data){
            header("Location: index.php");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = trim($_POST['title']);
            $body = trim($_POST['body']);

            // تحقق من صحة البيانات
            if(empty($title)){
                $this->errors['title'] = 'عنوان التدوينة مطلوب.';
            } elseif(strlen($title) > 255){
                $this->errors['title'] = 'عنوان التدوينة يجب ألا يزيد عن 255 حرف.';
            }

            if(empty($body)){
                $this->errors['body'] = 'محتوى التدوينة مطلوب.';
            }

            if(empty($this->errors)){
                $this->post->title = $title;
                $this->post->body = $body;
                if($this->post->update()){
                    header("Location: index.php");
                    exit;
                } else {
                    $this->errors['general'] = "حدث خطأ أثناء تحديث التدوينة.";
                }
            }
        }

        $view = '../app/views/posts/edit.php';
        include '../app/views/layouts/main.php';
    }

    // حذف تدوينة (مع تأكيد عبر GET)
    public function delete($id){
        $this->post->id = $id;
        // لتأكيد الحذف، يفضل ارسال الطلب عبر POST وليس GET، لكن هنا للتبسيط نستخدم GET
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($this->post->delete()){
                header("Location: index.php");
                exit;
            } else {
                echo "حدث خطأ أثناء حذف التدوينة.";
            }
        } else {
            // عرض نموذج تأكيد الحذف
            $post_data = $this->post->readOne();
            if(!$post_data){
                header("Location: index.php");
                exit;
            }
            $view = '../app/views/posts/delete.php';
            include '../app/views/layouts/main.php';
        }
    }
}
