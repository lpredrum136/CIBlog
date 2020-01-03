<?= validation_errors() ?>

<?= form_open('users/login') ?>
<div class="row text-center justify-content-center">
  <div class="col-md-4">
    <h1>
      <?= $title ?>
    </h1>
    <div class="form-group">
      <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>
    </div>
    <div class="form-group">
      <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </div>
</div>
<?= form_close() ?>