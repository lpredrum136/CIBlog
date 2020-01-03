<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ciBlog</title>
  <!--Bootstrap CSS-->
  <link href="https://bootswatch.com/4/cosmo/bootstrap.min.css" rel="stylesheet">

  <!--Javascript sources-->
  <!--ALWAYS BEFORE MATERIALISE-->
  <script src="https://code.jquery.com/jquery-3.4.0.js" integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!--Own CSS-->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
</head>

<body>
  <?php include 'navbar.php' ?>
  <div class="container">
    <!--Flash messages-->
    <?php if ($this->session->flashdata('user_registered')) : ?>
      <div class="alert alert-success">
        <strong>Success!</strong>
        <?= $this->session->flashdata('user_registered') ?>
      </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('post_created')) : ?>
      <div class="alert alert-success">
        <strong>Success!</strong>
        <?= $this->session->flashdata('post_created') ?>
      </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('post_updated')) : ?>
      <div class="alert alert-success">
        <strong>Success!</strong>
        <?= $this->session->flashdata('post_updated') ?>
      </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('category_created')) : ?>
      <div class="alert alert-success">
        <strong>Success!</strong>
        <?= $this->session->flashdata('category_created') ?>
      </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('post_deleted')) : ?>
      <div class="alert alert-success">
        <strong>Success!</strong>
        <?= $this->session->flashdata('post_deleted') ?>
      </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('user_successful_logged_in')) : ?>
      <div class="alert alert-success">
        <strong>Success!</strong>
        <?= $this->session->flashdata('user_successful_logged_in') ?>
      </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('user_unsuccessful_logged_in')) : ?>
      <div class="alert alert-danger">
        <strong>Login fails!</strong>
        <?= $this->session->flashdata('user_unsuccessful_logged_in') ?>
      </div>
    <?php endif ?>

    <?php if ($this->session->flashdata('user_logged_out')) : ?>
      <div class="alert alert-info">
        <strong>Success!</strong>
        <?= $this->session->flashdata('user_logged_out') ?>
      </div>
    <?php endif ?>