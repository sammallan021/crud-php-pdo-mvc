<?php
require_once '../app/controllers/PostController.php';

// إنشاء كائن الكنترولر
$controller = new PostController();

// جلب اسم الإجراء (action) من الرابط
$action = $_GET['action'] ?? 'index';
// جلب معرف التدوينة إن وجد
$id = $_GET['id'] ?? null;

// تنفيذ الإجراء المناسب
switch($action){
    case 'create':
        $controller->create();
        break;
    case 'edit':
        if($id) {
            $controller->edit($id);
        } else {
            header("Location: index.php");
        }
        break;
    case 'delete':
        if($id) {
            $controller->delete($id);
        } else {
            header("Location: index.php");
        }
        break;
    default:
        $controller->index();
}
