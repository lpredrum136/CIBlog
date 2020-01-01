<h2><?= $title ?></h2>

<?php echo validation_errors() ?>

<?php echo form_open_multipart('posts/create') ?>
<div class="form-group">
  <label for="title">Title</label>
  <input type="text" class="form-control" placeholder="Title" name="title">
</div>
<div class="form-group">
  <label for="ck-editor-body">Body</label>
  <textarea class="form-control" placeholder="Body" name="body" id="ck-editor-body"></textarea>
</div>
<div class="form-group">
  <label for="">Category</label>
  <select name="category_id" class="form-control">
    <?php foreach ($categories as $category) : ?>
      <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
    <?php endforeach ?>
  </select>
</div>
<div class="form-group">
  <div class="custom-file">
    <input type="file" class="custom-file-input" name="userfile" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>