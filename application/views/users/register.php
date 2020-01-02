<h2><?= $title ?></h2>

<?= validation_errors() ?>

<?= form_open('users/register') ?>
<div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
</div>
<div class="form-group">
  <label for="username">Username</label>
  <input type="text" name="username" id="username" class="form-control" placeholder="Username">
</div>
<div class="form-group">
  <label for="zipcode">Zipcode</label>
  <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zipcode">
</div>
<div class="form-group">
  <label for="email">Email</label>
  <input type="email" name="email" id="email" class="form-control" placeholder="Email">
</div>
<div class="form-group">
  <label for="password">Password</label>
  <input type="password" name="password" id="password" class="form-control" placeholder="Password">
</div>
<div class="form-group">
  <label for="password2">Confirm Password</label>
  <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm Password">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
<?= form_close() ?>