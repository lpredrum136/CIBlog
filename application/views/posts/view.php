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
<?php if ($post['user_id'] == $this->session->userdata('user_id')) : ?>
  <div class="row">
    <div class="col">
      <a href="<?= base_url() ?>posts/edit/<?= $post['id'] ?>" class="btn btn-info">Edit</a>
    </div>
    <div class="col">
      <?= form_open('posts/delete/' . $post['id']) ?>
      <input type="submit" value="Delete" class="btn btn-danger float-right">
      <?= form_close() ?>
    </div>
  </div>
  <hr>
<?php endif ?>

<h3>Add Comment</h3>
<?= validation_errors() ?>
<?= form_open('comments/create/' . $post['id']) ?>
<div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control">
</div>
<div class="form-group">
  <label for="email">Email</label>
  <input type="email" name="email" id="email" class="form-control">
</div>
<div class="form-group">
  <label for="body">Body</label>
  <textarea class="form-control" placeholder="Comment body..." name="body" id="body"></textarea>
</div>
<input type="hidden" name="slug" value="<?= $post['slug'] ?>">
<button type="submit" class="btn btn-primary">Submit</button>
<?= form_close() ?>

<hr>

<h3>Comments</h3>
<?php if (count($comments) > 0) : ?>
  <?php foreach ($comments as $comment) : ?>
    <div class="card my-2 bg-light">
      <div class="card-body">
        <h5>
          <?= $comment['body'] ?>
          [by <strong><?= $comment['name'] ?></strong>]
          at <?= $comment['email'] ?>
          on <?= $comment['created_at'] ?>
        </h5>
      </div>

    </div>

  <?php endforeach ?>
<?php else : ?>
  No comments
<?php endif ?>