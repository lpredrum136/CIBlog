<h2><?= $title ?></h2>
<form action="/action_page.php">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" placeholder="Title" name="title">
  </div>
  <div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control" placeholder="Body" name="body"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>