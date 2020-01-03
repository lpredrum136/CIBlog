<?= validation_errors() ?>

<?= form_open('users/register') ?>

<div class="row text-center justify-content-center">
  <div class="col-md-4">
    <h2><?= $title ?></h2>

    <div class="form-group">
      <input type="text" name="name" id="name" class="form-control" placeholder="Name" autofocus>
    </div>
    <div class="form-group">
      <input type="text" name="username" id="username" class="form-control" placeholder="Username">
    </div>
    <div class="form-group">
      <input type="text" name="zipcode" id="zipcode" class="form-control" placeholder="Zipcode">
    </div>
    <div class="form-group">
      <input type="email" name="email" id="email" class="form-control" placeholder="Email">
    </div>
    <div class="form-group">
      <input type="password" name="password" id="password" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
      <input type="password" name="password2" id="password2" class="form-control" placeholder="Confirm Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

<?= form_close() ?>