<h2><?= $title ?></h2>
<?php foreach ($posts as $post) : ?>
  <hr>
  <h3><?php echo $post['title'] ?></h3>
  <?php echo $post['body'] ?><br>
  <small class="post-date">Posted on <?php echo $post['created_at'] ?></small>
  <p><a href="<?php echo site_url('/posts/' . $post['slug']) ?>" class="btn btn-info">Read More</a></p>
<?php endforeach ?>