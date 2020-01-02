<h2>Edit "<?= $post['title'] ?>"</h2>

<?= validation_errors() ?>

<?= form_open('posts/update') ?>
<div class="form-group">
  <label for="title">Title</label>
  <input type="text" class="form-control" placeholder="Title" name="title" value="<?= $post['title'] ?>">
</div>
<div class="form-group">
  <label for="body">Body</label>
  <textarea class="form-control" placeholder="Body" name="body" id="ck-editor-body">
    <?= $post['body'] ?>
  </textarea>
</div>
<div class="form-group">
  <input type="hidden" name="update_id" value="<?= $post['id'] ?>">
</div>
<div class="form-group">
  <label for="category_id">Category</label>
  <select name="category_id" id="category_id" class="form-control">
    <?php foreach ($categories as $category) : ?>
      <option value="<?= $category['id'] ?>">
        <?= $category['name'] ?>
      </option>
    <?php endforeach ?>
  </select>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?= form_close() ?>