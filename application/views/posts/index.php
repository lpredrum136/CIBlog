<h2><?= $title ?></h2>
<?php foreach ($posts as $post) : ?>
  <hr>
  <h3><?php echo $post['title'] ?></h3>
  <div class="row">
    <div class="col-md-3"><img src="<?= site_url('assets/images/posts/' . $post['post_image']) ?>" alt=""></div>
    <div class="col-md-9">
      <small class="post-date">
        Posted on <?php echo $post['created_at'] ?> in
        <span class="badge badge-secondary">
          <?= $post['name'] ?>
        </span>
      </small>

      <?= word_limiter($post['body'], 60) ?><br>

      <p>
        <a href="<?php echo site_url('posts/' . $post['slug']) ?>" class="btn btn-info">Read More</a>
      </p>
    </div>
  </div>

<?php endforeach ?>

<div class="pagination-link">
  <?= $this->pagination->create_links() ?>
</div>