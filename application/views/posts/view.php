<h2><?= $post['title'] ?></h2>
<span class="badge badge-secondary">
  <?= $post['name'] ?>
</span>
<br>
<img src="<?= site_url('assets/images/posts/' . $post['post_image']) ?>" alt="">

<div class="post-body">
  <?= $post['body'] ?>
  <small class="post-date">Posted on: <?= $post['created_at'] ?></small>
</div>

<hr>
<div class="row">
  <div class="col">
    <a href="<?= base_url() ?>posts/edit/<?= $post['id'] ?>" class="btn btn-info">Edit</a>
  </div>
  <div class="col">
    <?= form_open('posts/delete/' . $post['id']) ?>
    <input type="submit" value="Delete" class="btn btn-danger float-right">
    </form>
  </div>
</div>