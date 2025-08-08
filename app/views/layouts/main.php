<?php include 'header.php'; ?>

<?php
// تضمين صفحة المحتوى حسب قيمة $view
if(isset($view) && file_exists($view)){
    include $view;
} else {
    echo "<p>صفحة غير موجودة.</p>";
}
?>

<?php include 'footer.php'; ?>

