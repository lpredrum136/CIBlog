<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <a class="navbar-brand" href="<?php echo base_url() ?>">CI Blog</a>
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?= base_url() ?>categories">Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>posts">Posts</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url() ?>about">About</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <?php if ($this->session->has_userdata('logged_in')) : ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>categories/create">Create Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>posts/create">Create Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>users/logout">Logout</a>
      </li>
    <?php else : ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>users/register">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>users/login">Login</a>
      </li>
    <?php endif ?>
  </ul>
</nav>