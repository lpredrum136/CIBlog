<h2><?= $title ?></h2>

<?php echo validation_errors() ?>

<?php echo form_open('posts/create') ?>
<div class="form-group">
  <label for="title">Title</label>
  <input type="text" class="form-control" placeholder="Title" name="title">
</div>
<div class="form-group">
  <label for="body">Body</label>
  <textarea class="form-control" placeholder="Body" name="body" id="ck-editor-body"></textarea>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>