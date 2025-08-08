<h1 class="mb-4">قائمة التدوينات</h1>

<a href="index.php?action=create" class="btn btn-success mb-3">إضافة تدوينة جديدة</a>

<?php if($posts->rowCount() > 0): ?>
<table class="table table-bordered table-striped">
    <thead class="table-primary">
        <tr>
            <th>العنوان</th>
            <th>التاريخ</th>
            <th style="width: 180px;">إجراءات</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $posts->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?= htmlspecialchars($row['title']) ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">تعديل</a>
                <a href="index.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">حذف</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<?php else: ?>
<p>لا توجد تدوينات حتى الآن.</p>
<?php endif; ?>

