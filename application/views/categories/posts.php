<!--All the posts have same category, i.e. see Controller and Category_model, 
so the first element 'name' field is enough to represent this category-->

<h2><?= $category_posts[0]['name'] ?></h2>

<?php foreach ($category_posts as $category_post) : ?>
  <hr>
  <h3><?php echo $category_post['title'] ?></h3>
  <div class="row">
    <div class="col-md-3"><img src="<?= site_url('assets/images/posts/' . $category_post['post_image']) ?>" alt=""></div>
    <div class="col-md-9">
      <small class="post-date">
        Posted on <?php echo $category_post['created_at'] ?> in
        <span class="badge badge-secondary">
          <?= $category_post['name'] ?>
        </span>
      </small>

      <?= word_limiter($category_post['body'], 60) ?><br>

      <p>
        <a href="<?php echo site_url('posts/' . $category_post['slug']) ?>" class="btn btn-info">Read More</a>
      </p>
    </div>
  </div>

<?php endforeach ?>