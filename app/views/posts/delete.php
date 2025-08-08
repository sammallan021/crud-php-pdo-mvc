<h1 class="mb-4 text-danger">تأكيد حذف التدوينة</h1>

<p>هل أنت متأكد أنك تريد حذف التدوينة التالية؟</p>

<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($post_data['title']) ?></h5>
        <p class="card-text"><?= nl2br(htmlspecialchars($post_data['body'])) ?></p>
        <p class="text-muted">تاريخ الإنشاء: <?= $post_data['created_at'] ?></p>
    </div>
</div>

<form method="POST" action="index.php?action=delete&id=<?= $post_data['id'] ?>">
    <button type="submit" class="btn btn-danger">نعم، احذف التدوينة</button>
    <a href="index.php" class="btn btn-secondary">إلغاء</a>
</form>
