<h1 class="mb-4">إضافة تدوينة جديدة</h1>

<?php if(!empty($this->errors['general'])): ?>
    <div class="alert alert-danger"><?= $this->errors['general'] ?></div>
<?php endif; ?>

<form method="POST" action="index.php?action=create" novalidate>
    <div class="mb-3">
        <label for="title" class="form-label">عنوان التدوينة</label>
        <input type="text" id="title" name="title" class="form-control <?= isset($this->errors['title']) ? 'is-invalid' : '' ?>" 
            value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>" required maxlength="255">
        <?php if(isset($this->errors['title'])): ?>
            <div class="invalid-feedback"><?= $this->errors['title'] ?></div>
        <?php endif; ?>
    </div>

    <div class="mb-3">
        <label for="body" class="form-label">محتوى التدوينة</label>
        <textarea id="body" name="body" rows="6" class="form-control <?= isset($this->errors['body']) ? 'is-invalid' : '' ?>" required><?= isset($_POST['body']) ? htmlspecialchars($_POST['body']) : '' ?></textarea>
        <?php if(isset($this->errors['body'])): ?>
            <div class="invalid-feedback"><?= $this->errors['body'] ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">حفظ</button>
    <a href="index.php" class="btn btn-secondary">إلغاء</a>
</form>

